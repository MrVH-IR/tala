<?php

namespace App\Livewire\Buy;

use App\Classes\GoldApi;
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

    public function mount(GoldApi $goldApi)
    {
        $data = ($goldApi)()->getData(true);

        $this->items = $data['gold'] ?? [];
    }

    public function updatedCategory(GoldApi $goldApi, $value)
    {
        $data = ($goldApi)()->getData(true);

        $this->items = match ($value) {
            'gold' => $data['gold'] ?? [],
            'currency' => $data['currency'] ?? [],
            'crypto' => $data['cryptocurrency'] ?? [],
            default => [],
        };

        $this->selectedSymbol = '';
        $this->selectedPrice = 0;
        $this->total = 0;
    }

    public function selectItem($symbol)
    {
        $item = collect($this->items)
            ->firstWhere('symbol', $symbol);

        if (!$item) {
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

    public function calculateTotal()
    {
        $amount = is_numeric($this->amount) ? (float) $this->amount : 0;
        $price = (float) $this->selectedPrice;

        if ($price <= 0) {
            $this->total = 0;
            return;
        }

        match ($this->unit) {
            'toman' => $this->total = $amount, // مستقیم پول
            'gram', 'piece' => $this->total = $amount * $price,
            default => $this->total = $amount * $price,
        };
    }

    public function render()
    {
        return view('livewire.buy.buy-component');
    }
}
