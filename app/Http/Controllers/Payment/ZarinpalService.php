<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Support\Facades\Http;

class ZarinpalService
{
    public function requestPayment(
        int $amount,
        string $description,
        array $metadata = []
    ): array
    {
        return Http::acceptJson()
            ->asJson()
            ->timeout(10)
            ->retry(2, 500)
            ->post(
                'https://payment.zarinpal.com/pg/v4/payment/request.json',
                [
                    'merchant_id' => config('payment.zarinpal.merchant_id'),
                    'amount' => $amount,
                    'callback_url' => config('payment.zarinpal.callback_url'),
                    'referrer_id' => config('payment.zarinpal.referrer_id'),
                    'description' => $description,
                    'metadata' => $metadata,
                ]
            )
            ->throw()
            ->json();
    }

    public function verify(
        string $authority,
        int $amount
    ): array
    {
        return Http::acceptJson()
            ->asJson()
            ->timeout(10)
            ->retry(2, 500)
            ->post(
                'https://payment.zarinpal.com/pg/v4/payment/verify.json',
                [
                    'merchant_id' => config('payment.zarinpal.merchant_id'),
                    'amount' => $amount,
                    'authority' => $authority,
                ]
            )
            ->throw()
            ->json();
    }
}
