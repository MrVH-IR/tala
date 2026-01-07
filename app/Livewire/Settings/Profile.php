<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $mobile;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->mobile = auth()->user()->mobile ?? null;
    }

    protected function rules()
    {
        return [
            'name' => 'nullable|string|min:3|max:150',
            'mobile' => [
                'nullable',
                'string',
                'regex:/^09\d{9}$/',
                'unique:users,mobile,' . auth()->id(),
            ],
        ];
    }

    public function save()
    {
        $this->validate();
        auth()->user()->update([
            'name'   => $this->name,
            'mobile' => $this->mobile,
        ]);

        $this->dispatch('notify' , '✅ پروفایل شما با موفقیت بروزرسانی شد');
    }

    public function render()
    {
        return view('livewire.settings.profile')->layout('layouts.app');
    }
}
