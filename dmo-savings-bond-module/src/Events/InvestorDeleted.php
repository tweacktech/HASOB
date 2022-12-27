<?php

namespace DMO\SavingsBond\Events;

use DMO\SavingsBond\Models\Investor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvestorDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $investor;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Investor $investor)
    {
        $this->investor = $investor;
    }

}
