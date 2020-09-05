<?php

namespace App\Listeners;

use App\Events\OrderSavingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSavingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderSavingEvent  $event
     * @return void
     */
    public function handle(OrderSavingEvent $event)
    {
        //
    }
}
