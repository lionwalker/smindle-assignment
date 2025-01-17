<?php

namespace App\Listeners;

use App\Events\BasketSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;

class SendSubscriptionNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BasketSaved $event): void
    {
        if ($event->basket->type == 'subscription') {
            Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post(
                config('system-parameters.subscription_api'), 
                [
                    'ProductName' => $event->basket->name,
                    'Price' => $event->basket->price,
                    'Timestamp' => $event->basket->created_at,
                ]
            );
        }
    }
}
