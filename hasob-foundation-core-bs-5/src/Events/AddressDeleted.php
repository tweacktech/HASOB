<?php

namespace Hasob\FoundationCore\Events;

use Hasob\FoundationCore\Models\Address;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddressDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $address;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

}
