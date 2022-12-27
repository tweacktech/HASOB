<?php

namespace DMO\SavingsBond\Listeners;

use DMO\SavingsBond\Models\Subscription;
use DMO\SavingsBond\Models\SubscriptionDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubscriptionDeletedListener
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
     * @param  SubscriptionDeleted  $event
     * @return void
     */
    public function handle(SubscriptionDeleted $event)
    {
        //
    }
}
