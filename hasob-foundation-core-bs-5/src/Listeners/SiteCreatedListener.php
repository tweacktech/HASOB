<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Site;
use Hasob\FoundationCore\Models\SiteCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SiteCreatedListener
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
     * @param  SiteCreated  $event
     * @return void
     */
    public function handle(SiteCreated $event)
    {
        //
    }
}
