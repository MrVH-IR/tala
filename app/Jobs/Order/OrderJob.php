<?php

namespace App\Jobs\Order;

use App\Models\Accounter\Order;
use App\Models\Accounter\ZarinpalResponse;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use JetBrains\PhpStorm\Deprecated;

#[Deprecated(reason: 'This app uses a Request - Admin approve system. Not a payment gateway', since: '8.4')]
class OrderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $authority,
        private User $user,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $zarinpal = ZarinpalResponse::where('user_id', $this->user->id)->where('authority', $this->authority)->first();
        $order = Order::where('authority', $this->authority)
            ->where('user_id', $zarinpal->user_id)
            ->where('amount', $zarinpal->amount)
            ->latest()
            ->update([
                'status' => 'PAID',
            ]);
    }
}
