<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Models\BrokerDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BrokerDeletedListener
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
     * @param  BrokerDeleted  $event
     * @return void
     */
    public function handle(BrokerDeleted $event)
    {
        //
    }
}
