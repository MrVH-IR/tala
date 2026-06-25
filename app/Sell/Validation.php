<?php

namespace App\Sell;

use App\Models\Accounter\Asset;
use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;

trait Validation
{
    public function validateSell(array $sale): ?string
    {
        $checks = [
            'symbol' => [
                'status' => Asset::where('symbol', $sale['symbol'])->exists(),
                'message' => 'دارایی مورد نظر پیدا نشد.',
            ],

            'amount' => [
                'status' => Wallet::where('user_id', $sale['user'])
                    ->where('balance', '>=', $sale['amount'])
                    ->where('locked_balance', '<=', $sale['amount'])
                    ->exists(),
                'message' => 'موجودی کیف پول برای فروش کافی نیست.',
            ],

            'duplicateRequest' => [
                'status' => ! Order::where('user_id', $sale['user'])
                    ->where('asset_id', $sale['asset_id'])
                    ->where('type', 'SELL')
                    ->whereIn('status', ['REQUESTED', 'PENDING'])
                    ->exists(),
                'message' => 'شما قبلا یک درخواست فروش برای این دارایی ثبت کرده اید.',
            ],
        ];

        foreach ($checks as $check) {
            if (! $check['status']) {
                return $check['message'];
            }
        }

        return null;
    }
}
