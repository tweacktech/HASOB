<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\BrokerStaff;
use DMO\SavingsBond\Models\BrokerStaffUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BrokerStaffUpdatedListener
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
     * @param  BrokerStaffUpdated  $event
     * @return void
     */
    public function handle(BrokerStaffUpdated $event)
    {
        //
    }
}
