<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\BrokerStaff;
use DMO\SavingsBond\Models\BrokerStaffDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BrokerStaffDeletedListener
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
     * @param  BrokerStaffDeleted  $event
     * @return void
     */
    public function handle(BrokerStaffDeleted $event)
    {
        //
    }
}
