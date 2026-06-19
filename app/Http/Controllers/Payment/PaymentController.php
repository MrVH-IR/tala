<?php

namespace App\Http\Controllers\Payment;

use App\Exceptions\Order\OrderException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Models\User;
use App\Order\OrderExceptionCase;
use App\OrderService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

// Zarinpal
class PaymentController extends Controller
{
    public function __construct(
        private readonly ZarinpalService $zarinpalService,
        private readonly OrderService $orderService
    ) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws OrderException
     */
    public function pay(User $user, OrderRequest $request)
    {
        $validated = $request->validated();

        try {
            // 1. Create the Order in the database first (Status: REQUESTED)
            $order = $this->orderService->createPurchaseOrder($user, [
                'asset_id' => $request->source_id,
                'amount'   => $request->amount,
                'price'    => $request->price ?? 0, // Optional since total is provided
                'total'    => $request->amount, // In OrderRequest, amount is the total money
            ]);

            // 2. Request payment from Zarinpal
            return $this->zarinpalService->requestPayment(
                (int) $request->amount,
                "Payment for Order #{$order->id} - {$request->description}",
                [
                    'order_id' => $order->id,
                    'mobile'   => $user->mobile,
                    'email'    => $user->email,
                ]
            );
        } catch (RequestException $e) {
            Log::error($e);
            throw new OrderException(OrderExceptionCase::RequestException);
        } catch (ConnectionException $e) {
            Log::error($e);
            throw new OrderException(OrderExceptionCase::ConnectionException);
        }
    }

    public function callback(User $user) 
    {
        // Logic for verification will be implemented here
    }
}

