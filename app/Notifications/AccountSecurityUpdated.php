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
        $title = $this->changeType === 'password' ? 'تغییر رمز عبور' : 'به‌روزرسانی اطلاعات پروفایل';
        $message = $this->changeType === 'password'
            ? 'رمز عبور حساب شما با موفقیت تغییر کرد. اگر این تغییر توسط شما انجام نشده است، لطفاً سریعاً با پشتیبانی تماس بگیرید.'
            : 'اطلاعات پروفایل شما با موفقیت به‌روزرسانی شد. اگر شما این تغییرات را ایجاد نکرده‌اید، لطفاً امنیت حساب خود را بررسی کنید.';

        return (new MailMessage)
            ->subject('هشدار امنیتی حساب - '.$title)
            ->greeting('سلام '.$notifiable->name.' عزیز،')
            ->line($message)
            ->line('تاریخ تغییر: '.now()->toDateTimeString())
            ->line('با احترام، تیم امنیتی گلدینا');
    }
}
