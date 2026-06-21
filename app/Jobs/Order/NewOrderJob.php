<?php

namespace App\Jobs\Order;

use App\Models\Accounter\Order;
use App\Models\Admin\Admin;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NewOrderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user,
        public Order $order
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $admins = Admin::all();
        $this->user->notify(
            new \App\Notifications\Order\Order($this->user, $this->order)
        );

        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\Order\Order($this->user, $this->order));
            sleep(1);
        }
    }
}
