<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Bid;
use DMO\SavingsBond\Models\BidUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BidUpdatedListener
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
     * @param  BidUpdated  $event
     * @return void
     */
    public function handle(BidUpdated $event)
    {
        //
    }
}
