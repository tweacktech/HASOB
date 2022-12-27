<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\SiteArtifact;
use Hasob\FoundationCore\Models\SiteArtifactUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SiteArtifactUpdatedListener
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
     * @param  SiteArtifactUpdated  $event
     * @return void
     */
    public function handle(SiteArtifactUpdated $event)
    {
        //
    }
}
