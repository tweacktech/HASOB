<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Subscription;
use DMO\SavingsBond\Models\SubscriptionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubscriptionCreatedListener
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
     * @param  SubscriptionCreated  $event
     * @return void
     */
    public function handle(SubscriptionCreated $event)
    {
        //
    }
}
