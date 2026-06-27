<?php

namespace App\Classes;

use Deprecated;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AdminGoldApi
{
    private const CURRENCY = 'USD';

    #[Deprecated('Requires a paid Plan', '8.4')]
    public static function getPrice()
    {
        return Http::withHeaders([
            'x-access-token' => config('services.admin_gold_api.key'),
        ])->get(
            'https://www.goldapi.io/api/XAU/USD/'
        )->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public static function goldPrice(): array
    {
        return Cache::remember('gold_price', now()->addMinutes(2), function () {
            $symbols = [
                'Silver' => 'XAG',
                'Gold' => 'XAU',
                'Bitcoin' => 'BTC',
                'Palladium' => 'XPD',
                'Copper' => 'HG',
                'Platinum' => 'XPT',
            ];

            $gold = [];

            foreach ($symbols as $name => $symbol) {
                $gold[$name] = Http::acceptJson()
                    ->get("https://api.gold-api.com/price/{$symbol}/".self::CURRENCY)
                    ->throw()
                    ->json();
            }

            return $gold;
        });
    }
}
