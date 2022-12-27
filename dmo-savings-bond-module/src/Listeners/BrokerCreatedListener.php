<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Models\BrokerCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BrokerCreatedListener
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
     * @param  BrokerCreated  $event
     * @return void
     */
    public function handle(BrokerCreated $event)
    {
        //
    }
}
