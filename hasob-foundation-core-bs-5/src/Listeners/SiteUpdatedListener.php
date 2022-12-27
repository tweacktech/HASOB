<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Site;
use Hasob\FoundationCore\Models\SiteUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SiteUpdatedListener
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
     * @param  SiteUpdated  $event
     * @return void
     */
    public function handle(SiteUpdated $event)
    {
        //
    }
}
