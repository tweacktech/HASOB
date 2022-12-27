<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Events\InvestorDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvestorDeletedListener
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
     * @param  InvestorDeleted  $event
     * @return void
     */
    public function handle(InvestorDeleted $event)
    {
        //
    }
}
