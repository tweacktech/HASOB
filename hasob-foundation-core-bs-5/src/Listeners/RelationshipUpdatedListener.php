<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Relationship;
use Hasob\FoundationCore\Models\RelationshipUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RelationshipUpdatedListener
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
     * @param  RelationshipUpdated  $event
     * @return void
     */
    public function handle(RelationshipUpdated $event)
    {
        //
    }
}
