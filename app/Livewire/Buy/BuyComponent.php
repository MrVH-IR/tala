<?php

namespace App\Livewire\Buy;

use App\Classes\GoldApi;
use App\Models\Accounter\Asset;
use Livewire\Component;

class BuyComponent extends Component
{
    public string $category = 'gold';

    public string $selectedSymbol = '';

    public string $amount = '';

    public string $unit = 'gram';

    public array $items = [];

    public float $selectedPrice = 0;

    public float $total = 0;

    // Map categories to their allowed units
    protected function categoryUnits(): array
    {
        return [
            'gold' => ['gram', 'piece', 'toman'],
            'currency' => ['piece', 'toman'],
            'crypto' => ['piece', 'toman'],
        ];
    }

    public function mount(GoldApi $goldApi)
    {
        $this->loadItems($goldApi);
    }

    public function updatedCategory(GoldApi $goldApi, $value)
    {
        $this->category = $value;
        $this->loadItems($goldApi);

        $this->selectedSymbol = '';
        $this->selectedPrice = 0;
        $this->amount = '';
        $this->total = 0;

        $allowedUnits = $this->categoryUnits()[$this->category] ?? [];
        $this->unit = $allowedUnits[0] ?? 'piece';
    }

    private function loadItems(GoldApi $goldApi): void
    {
        $response = ($goldApi)();
        $data = $response->getData(true);

        $this->items = match ($this->category) {
            'gold' => $data['gold'] ?? [],
            'currency' => $data['currency'] ?? [],
            'crypto' => $data['cryptocurrency'] ?? [],
            default => [],
        };
    }

    public function selectItem($symbol): void
    {
        $item = collect($this->items)->firstWhere('symbol', $symbol);

        if (! $item) {
            return;
        }

        $this->selectedSymbol = $symbol;
        $this->selectedPrice = (float) ($item['price'] ?? 0);

        $this->calculateTotal();
    }

    public function updatedAmount()
    {
        $this->calculateTotal();
    }

    public function updatedUnit()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $numericAmount = is_numeric($this->amount) ? (float) $this->amount : 0;
        $price = $this->selectedPrice;

        if ($this->unit === 'toman') {
            $this->total = $numericAmount;

            return;
        }

        if ($price <= 0) {
            $this->total = 0;

            return;
        }

        $this->total = $numericAmount * $price;
    }

    public function getAvailableUnitsProperty()
    {
        return $this->categoryUnits()[$this->category] ?? [];
    }

    public function processPurchase()
    {
        if (empty($this->selectedSymbol) || empty($this->amount) || $this->total <= 0) {
            session()->flash('error', 'لطفاً تمامی موارد را به درستی انتخاب کنید.');

            return;
        }

        $asset = Asset::where('symbol', $this->selectedSymbol)->first();
        if (! $asset) {
            session()->flash('error', 'دارایی انتخاب شده یافت نشد.');

            return;
        }

        // We calculate the actual asset amount based on the unit
        // If user buys in Toman, the amount of asset is Total / Price
        $finalAssetAmount = ($this->unit === 'toman')
            ? $this->total / ($this->selectedPrice ?: 1)
            : (float) $this->amount;

        // Redirect to PaymentController using a POST request (via a temporary route or just passing data)
        // Since we are in Livewire, we can't easily do a POST to a controller.
        // The best way is to use a session-based temporary store or a hidden form.
        // However, for the sake of this flow, we will redirect to a route that takes parameters.

        // We use a redirect to a route that will then handle the PaymentController logic.
        return redirect()->route('payment.order', [
            'user' => auth()->id(),
            'source_id' => $asset->id,
            'amount' => $this->total,
            'price' => $this->selectedPrice,
            'asset_amount' => $finalAssetAmount,
            'description' => "Purchase of {$asset->name}",
            'source_type' => 'CREDIT', // As per OrderEnum
        ]);
    }

    public function render()
    {
        return view('livewire.buy.buy-component');
    }
}
