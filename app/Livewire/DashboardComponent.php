<?php

namespace App\Livewire;

use App\Models\Accounter\Wallet;
use App\Models\Accounter\WalletTransaction;
use App\Models\Accounter\Asset;
use App\Models\Accounter\MarketPrice;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DashboardComponent extends Component
{
    public function render()
    {
        $user = Auth::user();

        // Fetch all wallets for the user
        $wallets = Wallet::with('asset')
            ->where('user_id', $user->id)
            ->get();

        // Calculate total portfolio value in Toman
        $totalValueToman = 0;
        foreach ($wallets as $wallet) {
            $latestPrice = MarketPrice::where('asset_id', $wallet->asset_id)
                ->latest('priced_at')
                ->first();

            if ($latestPrice) {
                $totalValueToman += $wallet->balance * $latestPrice->price;
            }
        }

        // Fetch recent transactions
        $transactions = WalletTransaction::with(['wallet.asset'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.dashboard', [
            'wallets' => $wallets,
            'transactions' => $transactions,
            'user' => $user,
            'totalValueToman' => $totalValueToman,
        ])->layout('layouts.app');
    }
}

