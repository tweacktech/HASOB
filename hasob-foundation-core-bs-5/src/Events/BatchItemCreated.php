<?php

namespace Hasob\FoundationCore\Events;

use Hasob\FoundationCore\Models\BatchItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BatchItemCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $batchItem;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BatchItem $batchItem)
    {
        $this->batchItem = $batchItem;
    }

}
