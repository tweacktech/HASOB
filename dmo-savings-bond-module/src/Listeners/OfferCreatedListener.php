<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Offer;
use DMO\SavingsBond\Events\OfferCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OfferCreatedListener
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
     * @param  OfferCreated  $event
     * @return void
     */
    public function handle(OfferCreated $event)
    {
        
    }
}
