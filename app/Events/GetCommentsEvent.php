<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GetCommentsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pageNumber;

    public $restaurant;

    /**
     * Create a new event instance.
     *
     * @param $restaurant
     * @param $pageNumber
     */
    public function __construct($restaurant, $pageNumber)
    {
        $this->pageNumber = $pageNumber;
        $this->restaurant = $restaurant;
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
