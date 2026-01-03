<?php

namespace App\Classes;

use GuzzleHttp\Client;

class GoldApi
{
    public function __invoke()
    {
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

        return response()->json(json_decode($response->getBody()->getContents() , true));
    }
}
