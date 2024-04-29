<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use App\Notifications\EventUpdateNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateEventSentMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /**
         * Get the Event id from the cunstructor 
         * Get the user id from order table
         * Get the user id from the user table by Order data
         */
        $user_id = Order::where('event_id', $this->id)->pluck('user_id');
        $user_ids = User::whereIn('id', $user_id)->pluck('id')->unique();

        /**
         * Get the user info from user table
         * Send the notification to the user 
         */
        foreach ($user_ids as $userId) {
            $user = User::find($userId);
            $order_id = Order::where('user_id', $user->id)->where('event_id', $this->id)->pluck('id')->first();
            $user->notify(new EventUpdateNotification($this->id, $user->name, $order_id));
        }
    }
}
