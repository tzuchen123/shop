<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TypeSavingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ip_addr;
    public $request_url;
    public $city_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ip_addr, $request_url, $city_name)
    {
        $this->ip_addr = $ip_addr;
        $this->request_url = $request_url;
        $this->city_name = $city_name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
