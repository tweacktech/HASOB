<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Bid;
use DMO\SavingsBond\Models\BidDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BidDeletedListener
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
     * @param  BidDeleted  $event
     * @return void
     */
    public function handle(BidDeleted $event)
    {
        //
    }
}
