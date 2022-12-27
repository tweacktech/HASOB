<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\BrokerStaff;
use DMO\SavingsBond\Models\BrokerStaffCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BrokerStaffCreatedListener
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
     * @param  BrokerStaffCreated  $event
     * @return void
     */
    public function handle(BrokerStaffCreated $event)
    {
        //
    }
}
