<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountSecurityUpdated extends Notification
{
    use Queueable;

    protected string $changeType;

    public function __construct(string $changeType)
    {
        $this->changeType = $changeType;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('هشدار امنیتی حساب - تغییرات حساس')
            ->view('emails.security.account-change', [
                'user' => $notifiable,
                'changeType' => $this->changeType,
                'date' => now(),
            ]);
    }
}
