<?php

namespace App\Jobs\Order;

use App\Models\Accounter\Asset;
use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SellJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $sell) {}

    /**
     * Execute the job.
     *
     * @throws Throwable
     */
    public function handle(): void
    {
        try {
            DB::transaction(function () {
                DB::beginTransaction();
                if (Order::where('idempotency_key', $this->sell['idempotency_key'])->exists()) {
                    throw new Exception('This transaction already processed');
                }

                $wallet = Wallet::where('id', $this->sell['wallet']['wallet_id'])
                    ->where('user_id', $this->sell['user'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $amount = (string) $this->sell['amount'];

                $available = bcsub(
                    (string) $wallet->balance,
                    (string) $wallet->locked_balance,
                    18
                );

                if (bccomp($available, $amount, 18) === -1) {
                    throw new Exception('Not enough available balance');
                }

                $asset = Asset::where('symbol', $this->sell['symbol'])
                    ->firstOrFail();

                Order::create([
                    'idempotency_key' => $this->sell['idempotency_key'],
                    'user_id' => $this->sell['user'],
                    'asset_id' => $asset->id,
                    'type' => 'SELL',
                    'amount' => $amount,
                    'price' => $this->sell['price'],
                    'total_money' => bcmul((string) $this->sell['price'], $amount, 18),
                    'status' => 'REQUESTED',
                ]);

                $wallet->update([
                    'locked_balance' => bcadd((string) $wallet->locked_balance, $amount, 18),
                ]);
                DB::commit();
            });

        } catch (Exception $e) {
            DB::rollBack();
            $errorID = now()->format('YmdHis').rand(1000, 9999);
            Log::error("Sell order failed: $errorID ".$e->getMessage());
        }
    }
}
