<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Bid;
use DMO\SavingsBond\Models\BidCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BidCreatedListener
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
     * @param  BidCreated  $event
     * @return void
     */
    public function handle(BidCreated $event)
    {
        //
    }
}
