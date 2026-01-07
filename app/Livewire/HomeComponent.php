<?php

namespace App\Livewire;

use App\Classes\GoldApi;
use Livewire\Component;

class HomeComponent extends Component
{

    public $gold = [];
    public $currency = [];
    public string $amount = '';
    public float $weight = 0;
    public float $gold18Price = 0;

    public function calcGold(GoldApi $goldApi)
    {
        $response = $goldApi();
        $goldList = $response->getData(true)['gold'] ?? [];

        $gold18 = collect($goldList)
            ->firstWhere('symbol', 'IR_GOLD_18K');

        $this->gold18Price = $gold18['price'] * 1.007 ?? 0;
    }

    public function updatedAmount($value)
    {
        $cleanAmount = (float) str_replace(',', '', $value);

        if ($this->gold18Price > 0 && $cleanAmount > 0) {
            $this->weight = round($cleanAmount / $this->gold18Price, 3);
        } else {
            $this->weight = 0;
        }
    }

    public function mount(GoldApi $goldApi)
    {
        $response = $goldApi();

        $this->gold = $response->getData(true)['gold'] ?? [];
        $this->currency = $response->getData(true)['currency'] ?? [];
        $this->calcGold($goldApi);
    }
    public function render()
    {
        return view('livewire.home')
        ->layout('livewire.layout.home.master');
    }
}
