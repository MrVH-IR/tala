<?php

namespace App\Classes;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GoldApi
{
    public function __invoke()
    {
        try {

            $currency = Cache::remember(
                'currency_cache',
                now()->addHour(),
                function () {

                    $client = new Client([
                        'timeout' => 10,
                        'verify'  => true,
                    ]);

                    $response = $client->get(
                        'https://brsapi.ir/Api/Market/Gold_Currency.php',
                        [
                            'query' => [
                                'key' => config('services.bprsapi.key'),
                            ],
                            'headers' => [
                                'Accept' => 'application/json',
                            ],
                        ]
                    );

                    return json_decode(
                        $response->getBody()->getContents(),
                        true
                    );
                }
            );
            $currency['gold'] = array_map(function ($gold) {
                $gold['price'] = (float) $gold['price'] * 1.01;
                return $gold;
            }, $currency['gold']);

            return response()->json($currency);

        } catch (\Throwable $e) {

            if (Cache::has('currency_cache')) {
                return response()->json(
                    Cache::get('currency_cache')
                );
            }

            $errorID = now()->format('YmdHis') . rand(1000, 9999);

            Log::error(
                "Exception {$errorID}: {$e->getMessage()}",
                [
                    'trace' => $e->getTraceAsString(),
                ]
            );

            return response()->json([
                'success' => false,
                'error_id' => $errorID,
                'message' => 'Failed to fetch currency data',
            ], 500);
        }
    }
}
