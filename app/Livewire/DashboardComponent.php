<?php

namespace App\Livewire;

use App\Classes\GoldApi;
use App\Models\Accounter\Wallet;
use App\Models\Accounter\WalletTransaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $user = Auth::user();

        if (! session('welcome-notification')) {
            $this->dispatch('notification', [
                'type' => 'success',
                'message' => 'خوش آمدید',
            ]);
            session()->put('welcome-notification', true);
        }

        $wallets = Wallet::with('asset')
            ->where('user_id', $user->id)
            ->get();

        $transactions = WalletTransaction::with([
            'wallet.asset',
        ])
            ->whereHas('wallet', fn ($q) => $q->where('user_id', $user->id)
            )
            ->latest()
            ->paginate(5);

        $apiResource = (new GoldApi)();
        $api = $apiResource->getData(true);

        $map = collect()
            ->merge($api['gold'] ?? [])
            ->merge($api['currency'] ?? [])
            ->merge($api['cryptocurrency'] ?? [])
            ->keyBy('symbol');

        $wallets->transform(function ($wallet) use ($map) {
            $symbol = $wallet->asset->symbol ?? null;
            $wallet->market_data = $map[$symbol] ?? null;

            return $wallet;
        });

        $userProfileStatus = $user->userCreditCardInformation()->first('verified_at');

        $totalValueToman = $wallets->sum(function ($wallet) use ($map) {

            $symbol = $wallet->asset->symbol ?? null;

            $market = $map[$symbol] ?? null;

            $price = $market['price'] ?? 0;

            return (float) $wallet->balance * $price;
        });

        return view('livewire.dashboard', [
            'wallets' => $wallets,
            'transactions' => $transactions,
            'user' => $user,
            'userProfileStatus' => $userProfileStatus,
            'totalValueToman' => $totalValueToman,
        ])->layout('layouts.app');
    }
}
