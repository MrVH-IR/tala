<?php

namespace App\Order;

enum OrderStatusEnum: string
{
    case REQUESTED = 'REQUESTED';
    case PENDING = 'PENDING';
    case PAID = 'PAID';
    case REJECTED = 'REJECTED';
    case CANCELLED = 'CANCELLED';
    case COMPLETED = 'COMPLETED';
}
