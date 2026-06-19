<?php

namespace App\Livewire;

use Livewire\Component;

class InfoPage extends Component
{
    public $type;

    public function mount()
    {
        $path = request()->path();
        if (str_contains($path, 'resources')) {
            $this->type = 'resources';
        } elseif (str_contains($path, 'rules')) {
            $this->type = 'rules';
        } elseif (str_contains($path, 'privacy')) {
            $this->type = 'privacy';
        } else {
            $this->type = 'info';
        }
    }

    public function render()
    {
        return view('livewire.info-page')
            ->layout('livewire.layout.home.master');
    }
}
