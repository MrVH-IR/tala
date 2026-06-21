<?php

namespace App\Notifications\Order;

use App\Models\User;
use App\Models\Accounter\Order as OrderModel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Order extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public User $user,
        public OrderModel $order,
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $assetName = $this->order->asset->name;

        return (new MailMessage)
            ->subject('ثبت خرید جدید در گلدینا')
            ->view('emails.admin.new-purchase', [
                'user' => $this->user,
                'order' => $this->order,
                'assetName' => $assetName,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
