<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;

//ZarinPal
class PaymentController extends Controller
{

    public function pay()
    {
        $zarinpal = new ZarinpalService();
    }

}
