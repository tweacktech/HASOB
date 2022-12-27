<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Site;
use Hasob\FoundationCore\Models\SiteDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SiteDeletedListener
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
     * @param  SiteDeleted  $event
     * @return void
     */
    public function handle(SiteDeleted $event)
    {
        //
    }
}
