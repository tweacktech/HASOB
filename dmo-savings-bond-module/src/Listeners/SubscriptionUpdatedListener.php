<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Subscription;
use DMO\SavingsBond\Models\SubscriptionUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubscriptionUpdatedListener
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
     * @param  SubscriptionUpdated  $event
     * @return void
     */
    public function handle(SubscriptionUpdated $event)
    {
        //
    }
}
