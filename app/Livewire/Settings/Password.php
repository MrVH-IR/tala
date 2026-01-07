<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Password extends Component
{
    public $current_password;
    public $password;
    public $confirm_password;

    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ];

    public function save()
    {
        $this->validate();

        if (!Hash::check($this->current_password , $this->password)) {
            $this->addError('current_password' , 'پسورد شما اشتباه می باشد');
            return;
        }

        auth()->user()->update([
            'password'=> Hash::make($this->password)
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);

        $this->dispatch('notify', '🔐 پسورد تغییر کرد');
    }
    public function render()
    {
        return view('livewire.settings.password')->layout('layouts.app');
    }
}
