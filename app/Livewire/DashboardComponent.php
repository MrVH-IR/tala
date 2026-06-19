<?php

namespace App\Livewire;

use App\Classes\GoldApi;
use App\Models\Accounter\Wallet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $user = Auth::user();

        if (! session()->has('welcome_notified')) {
            $this->dispatch('app-notification', 'خوش آمدید');
            session()->put('welcome_notified', true);
        }

        // Fetch all wallets for the user
        $wallets = Wallet::with('asset')
            ->where('user_id', $user->id)
            ->get();

        // Calculate total portfolio value in Toman
        $totalValueToman = 0;

        // Fetch recent transactions
        $transactions = Wallet::with('asset')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $goldApi = (new GoldApi)();

        $userProfileStatus = $user->userCreditCardInformation()->first('verified_at');

        return view('livewire.dashboard', [
            'wallets' => $wallets,
            'transactions' => $transactions,
            'user' => $user,
            'userProfileStatus' => $userProfileStatus,
            'totalValueToman' => $totalValueToman,
        ])->layout('layouts.app');
    }
}
