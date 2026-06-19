<?php

namespace App\Order;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

enum OrderExceptionCase
{
    case RequestException;
    case ConnectionException;
}
