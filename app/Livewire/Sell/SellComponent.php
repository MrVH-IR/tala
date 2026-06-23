<?php

namespace App\Livewire\Sell;

use App\Classes\GoldApi;
use App\Models\Accounter\Asset;
use App\Models\Accounter\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SellComponent extends Component
{
    public string $selectedSymbol = '';

    public string $amount = '';

    public float $selectedPrice = 0;

    public float $total = 0;

    public float $availableBalance = 0;

    public array $wallets = [];

    protected function rules(): array
    {
        return [
            'selectedSymbol' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:0.000001'],
        ];
    }

    public function mount(GoldApi $goldApi)
    {
        $this->loadUserWallets($goldApi);
    }

    private function loadUserWallets(GoldApi $goldApi): void
    {
        $userId = Auth::id();
        $apiResponse = ($goldApi)();
        $prices = $apiResponse->getData(true);

        // Flatten API prices for easy lookup
        $allPrices = [];
        foreach (['gold', 'currency', 'cryptocurrency'] as $cat) {
            if (isset($prices[$cat])) {
                foreach ($prices[$cat] as $item) {
                    $allPrices[$item['symbol']] = (float) $item['price'];
                }
            }
        }

        // Get user wallets joined with assets
        $this->wallets = DB::table('wallets')
            ->join('assets', 'wallets.asset_id', '=', 'assets.id')
            ->where('wallets.user_id', $userId)
            ->select(
                'assets.symbol',
                'assets.name',
                'assets.category',
                'wallets.balance',
                'wallets.locked_balance'
            )
            ->get()
            ->map(function ($wallet) use ($allPrices) {
                $symbol = $wallet->symbol;

                return [
                    'symbol' => $symbol,
                    'name' => $wallet->name,
                    'category' => $wallet->category,
                    'balance' => (float) $wallet->balance,
                    'locked_balance' => (float) $wallet->locked_balance,
                    'available' => (float) $wallet->balance - (float) $wallet->locked_balance,
                    'price' => $allPrices[$symbol] ?? 0,
                ];
            })
            ->filter(fn ($w) => $w['available'] > 0)
            ->values()
            ->toArray();
    }

    public function selectItem($symbol): void
    {
        $item = collect($this->wallets)->firstWhere('symbol', $symbol);

        if (! $item) {
            return;
        }

        $this->selectedSymbol = $symbol;
        $this->selectedPrice = $item['price'];
        $this->availableBalance = $item['available'];
        $this->amount = '';
        $this->total = 0;
    }

    public function updatedAmount()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $numericAmount = is_numeric($this->amount) ? (float) $this->amount : 0;
        $this->total = $numericAmount * $this->selectedPrice;
    }

    /**
     * @throws \Throwable
     */
    public function processSale()
    {
        $user_id = Auth::id();

        $this->validate();

        if ((float) $this->amount > $this->availableBalance) {
            $this->addError('amount', 'موجودی شما برای این تراکنش کافی نیست.');

            return false;
        }

        $asset = Asset::where('symbol', $this->selectedSymbol)
            ->firstOrFail();

        $walletSnapshot = null;

        DB::transaction(function () use ($user_id, $asset, &$walletSnapshot) {

            $wallet = Wallet::where('user_id', $user_id)
                ->where('asset_id', $asset->id)
                ->firstOrFail();

            $walletSnapshot = [
                'wallet_id' => $wallet->id,
                'balance' => (float) $wallet->balance,
                'locked_balance' => (float) $wallet->locked_balance,
            ];
        });

        session()->put('sale', [
            'symbol' => $this->selectedSymbol,
            'amount' => $this->amount,
            'price' => $this->selectedPrice,
            'total' => $this->total,
            'user' => $user_id,
            'wallet' => $walletSnapshot,
        ]);

        $this->dispatch('app-notification', 'درخواست فروش شما با موفقیت ثبت شد.');

        $this->reset([
            'selectedSymbol',
            'amount',
            'selectedPrice',
            'total',
            'availableBalance',
        ]);

        return redirect()->route('dashboard.payment.sell');
    }

    public function render()
    {
        return view('livewire.sell.sell-component');
    }
}
