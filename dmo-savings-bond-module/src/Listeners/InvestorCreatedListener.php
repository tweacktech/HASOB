<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Models\InvestorCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvestorCreatedListener
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
     * @param  InvestorCreated  $event
     * @return void
     */
    public function handle(InvestorCreated $event)
    {
        //
    }
}
