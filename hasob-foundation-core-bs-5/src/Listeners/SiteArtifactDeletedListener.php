<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\SiteArtifact;
use Hasob\FoundationCore\Models\SiteArtifactDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SiteArtifactDeletedListener
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
     * @param  SiteArtifactDeleted  $event
     * @return void
     */
    public function handle(SiteArtifactDeleted $event)
    {
        //
    }
}
