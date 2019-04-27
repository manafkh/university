<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QRScanned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lectureId;
    public $nextScanId;

    /**
     * Create a new event instance.
     *
     * @param $lectureId
     * @param $nextScanId
     */
    public function __construct($lectureId, $nextScanId)
    {
        $this->lectureId = $lectureId;
        $this->nextScanId = $nextScanId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('lecture.'.$this->lectureId);
    }
}
