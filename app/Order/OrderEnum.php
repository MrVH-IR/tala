<?php

namespace App\Order;

enum OrderEnum: string
{
    case CREDIT = 'CREDIT';
    case DEBIT = 'DEBIT';
}
