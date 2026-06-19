<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Livewire\Component;
use Livewire\Attributes\Rule;

class ContactForm extends Component
{
    #[Rule('required|string|min:3|max:255')]
    public $name = '';

    #[Rule('required|email|max:255')]
    public $email = '';

    #[Rule('nullable|string|max:255')]
    public $subject = '';

    #[Rule('required|string|min:10|max:5000')]
    public $message = '';

    public $successMessage = '';

    public function submit()
    {
        $this->validate();

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'subject', 'message']);
        $this->successMessage = 'پیام شما با موفقیت ارسال شد. ما به زودی با شما تماس خواهیم گرفت.';
    }

    public function render()
    {
        return view('livewire.contact-form')
            ->layout('livewire.layout.home.master');
    }
}
