<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $gold = $this->getGoldPrice();

        return view('admin.home', [
            'gold' => $gold,
            'orderStats' => $this->chart(),
            'walletStats' => $this->walletChart(),
        ]);
    }

    public function getGoldPrice()
    {
        return Http::withHeaders([
            'x-access-token' => config('services.admin_gold_api.key'),
        ])->get(
            'https://www.goldapi.io/api/XAU/USD/'
        )->json();
    }

    public function chart()
    {
        return Cache::remember('chart_stats_'.now()->format('Y-m-d'), 60, function () {

            $days = collect(range(6, 0))
                ->map(fn ($i) => now()->subDays($i)->format('Y-m-d'));

            $buyData = Order::selectRaw('DATE(created_at) as date, SUM(amount) as total')
                ->where('type', 'BUY')
                ->where('status', 'COMPLETED')
                ->groupBy('date')
                ->pluck('total', 'date');

            $sellData = Order::selectRaw('DATE(created_at) as date, SUM(amount) as total')
                ->where('type', 'SELL')
                ->where('status', 'COMPLETED')
                ->groupBy('date')
                ->pluck('total', 'date');

            return [
                'labels' => $days->values()->toArray(),

                'buy' => $days->map(fn ($d) => (float) ($buyData[$d] ?? 0))->values()->toArray(),

                'sell' => $days->map(fn ($d) => (float) ($sellData[$d] ?? 0))->values()->toArray(),
            ];
        });
    }

    public function walletChart()
    {
        return Cache::remember('wallet_stats_'.now()->format('Y-m-d'), 60, function () {

            $wallets = Wallet::with('asset')->get();

            return [
                'labels' => $wallets->pluck('asset.symbol')->toArray(),

                'balances' => $wallets->pluck('balance')->map(fn ($v) => (float) $v)->toArray(),

                'locked' => $wallets->pluck('locked_balance')->map(fn ($v) => (float) $v)->toArray(),
            ];
        });
    }
}
