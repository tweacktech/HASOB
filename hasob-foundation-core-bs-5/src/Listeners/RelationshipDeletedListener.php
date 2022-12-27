<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Relationship;
use Hasob\FoundationCore\Models\RelationshipDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RelationshipDeletedListener
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
     * @param  RelationshipDeleted  $event
     * @return void
     */
    public function handle(RelationshipDeleted $event)
    {
        //
    }
}
