<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Events\InvestorUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvestorUpdatedListener
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
     * @param  InvestorUpdated  $event
     * @return void
     */
    public function handle(InvestorUpdated $event)
    {
        //
    }
}
