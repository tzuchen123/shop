<?php

namespace App\Listeners;

use App\Events\TypeSavingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TypeSavingListener
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
     * @param  TypeSavingEvent  $event
     * @return void
     */
    public function handle(TypeSavingEvent $event)
    {
      
    }
}
