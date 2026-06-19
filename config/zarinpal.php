<?php

return [
    'zarinpal' => [
        'merchant_id' => env('ZARINPAL_MERCHANT'),
        'referrer_id' => env('ZARINPAL_REFERRER') ?? '',
    ],
];
