<?php

namespace App\Http\Controllers\Payment;

use App\Models\PaymentGateway;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\Deprecated;

#[Deprecated(reason: 'This app uses a Request - Admin approve system. Not a payment gateway', since: '8.4')]
class ZarinpalService
{
    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function requestPayment(
        int $amount,
        string $description,
        array $metadata = []
    ): array {
        return Http::acceptJson()
            ->asJson()
            ->timeout(10)
            ->retry(2, 1000)
            ->post(
                'https://sandbox.zarinpal.com/pg/v4/payment/request.json',
                [
                    'merchant_id' => config('zarinpal.zarinpal.merchant_id'),
                    'amount' => $amount,
                    'callback_url' => route('dashboard.payment.callback'),
                    'referrer_id' => config('zarinpal.zarinpal.referrer_id'),
                    'description' => $description,
                    'metadata' => $metadata,
                ]
            )
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function verify(
        string $authority,
        int $amount
    ): array {
        return Http::acceptJson()
            ->asJson()
            ->timeout(10)
            ->retry(2, 1000)
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

    public function save(
        User $user,
        array $data,
        $status = 'PENDING')
    {
        return $paymentGateway = PaymentGateway::updateOrCreate([
            'data' => json_encode($data),
            'user_id' => $user->id,
            'status' => $status,
        ]);
    }

    public function read(
        User $user,
        $status = 'PENDING')
    {
        return PaymentGateway::where('user_id', $user->id)
            ->where('status', $status)
            ->latest()
            ->first();
    }
}
