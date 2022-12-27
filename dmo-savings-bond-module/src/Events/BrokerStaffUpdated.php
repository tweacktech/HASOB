<?php

namespace DMO\SavingsBond\Events;

use DMO\SavingsBond\Models\BrokerStaff;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BrokerStaffUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $brokerStaff;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BrokerStaff $brokerStaff)
    {
        $this->brokerStaff = $brokerStaff;
    }

}
