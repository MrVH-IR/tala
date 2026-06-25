<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Notification extends Component
{
    public ?array $notification = null;
    public bool $show = false;

    public function mount()
    {
        if (session()->has('notification')) {
            $this->notification = session('notification');
            $this->show = true;

            session()->forget('notification');
        }
    }

    #[On('notification')]
    public function showNotification($payload)
    {
        $this->notification = $payload;
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.components.notification');
    }
}
