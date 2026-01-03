<?php

namespace App\Livewire;

use App\Classes\GoldApi;
use Livewire\Component;

class HomeComponent extends Component
{

    public $gold = [];
    public $currency = [];

    public function mount(GoldApi $goldApi)
    {
        $response = $goldApi();

        $this->gold = $response->getData(true)['gold'] ?? [];
        $this->currency = $response->getData(true)['currency'] ?? [];
    }
    public function render()
    {
        return view('livewire.home')
        ->layout('livewire.layout.master');
    }
}
