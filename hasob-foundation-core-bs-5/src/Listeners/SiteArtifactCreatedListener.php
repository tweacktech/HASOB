<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\SiteArtifact;
use Hasob\FoundationCore\Models\SiteArtifactCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SiteArtifactCreatedListener
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
     * @param  SiteArtifactCreated  $event
     * @return void
     */
    public function handle(SiteArtifactCreated $event)
    {
        //
    }
}
