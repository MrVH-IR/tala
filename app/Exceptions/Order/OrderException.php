<?php

namespace App\Exceptions\Order;

use App\Order\OrderExceptionCase;
use Exception;

class OrderException extends Exception
{
    /**
     * @throws Exception
     */
    public function __construct(OrderExceptionCase $case)
    {
        $message = match ($case) {
            OrderExceptionCase::RequestException => 'Bad Request Exception Happened',
            OrderExceptionCase::ConnectionException => 'Connection Request Exception Happened',
        };

        parent::__construct($message);
    }
}
