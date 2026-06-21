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

    protected function rules(): array
    {
        return [
            'category' => ['required', 'in:gold,currency,crypto'],
            'selectedSymbol' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:0.000001'],
            'unit' => ['required', 'string'],
        ];
    }

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
        if (session()->has('error')) {
            $this->dispatch('app-notification', 'مشکلی پیش آمده است');
        }
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
        $this->validate();

        $allowedUnits = $this->availableUnits;

        if (! in_array($this->unit, $allowedUnits, true)) {
            abort(403);
        }

        $asset = Asset::query()
            ->where('symbol', $this->selectedSymbol)
            ->first();

        if (! $asset) {

            $this->addError(
                'selectedSymbol',
                'دارایی انتخاب شده معتبر نیست.'
            );

            return;
        }

        $item = collect($this->items)
            ->firstWhere('symbol', $this->selectedSymbol);

        if (! $item) {
            abort(403);
        }

        $realPrice = (float) $item['price'];

        if ($realPrice <= 0) {
            abort(403);
        }

        $enteredAmount = (float) $this->amount;

        if ($this->unit === 'toman') {

            $payableAmount = $enteredAmount;

            $assetAmount = round(
                $payableAmount / $realPrice,
                8
            );

        } else {

            $assetAmount = round(
                $enteredAmount,
                8
            );

            $payableAmount = round(
                $assetAmount * $realPrice,
                0
            );
        }

        session()->put('purchase', [
            'asset_id' => $asset->id,
            'asset_amount' => $assetAmount,
            'payable_amount' => $payableAmount,
            'price' => $realPrice,
        ]);

        return redirect()->route('dashboard.payment.requestAsset');
    }

    public function render()
    {
        return view('livewire.buy.buy-component');
    }
}
