<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Offer;
use DMO\SavingsBond\Events\OfferDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OfferDeletedListener
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
     * @param  OfferDeleted  $event
     * @return void
     */
    public function handle(OfferDeleted $event)
    {
        //
    }
}
