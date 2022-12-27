<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Relationship;
use Hasob\FoundationCore\Models\RelationshipCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RelationshipCreatedListener
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
     * @param  RelationshipCreated  $event
     * @return void
     */
    public function handle(RelationshipCreated $event)
    {
        //
    }
}
