<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Rule;
use Livewire\Component;

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
        $key = sprintf(
            'contact-form:%s',
            request()->ip()
        );

        RateLimiter::hit($key, 3600);

        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);
            $this->dispatch('notification', [
                'type' => 'error',
                'message' => "تا {$seconds} ثانیه دیگر دوباره تلاش کنید.",
            ]);

            return;
        }
        RateLimiter::hit($key, 3600);
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
