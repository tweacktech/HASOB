<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Models\BrokerUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BrokerUpdatedListener
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
     * @param  BrokerUpdated  $event
     * @return void
     */
    public function handle(BrokerUpdated $event)
    {
        //
    }
}
