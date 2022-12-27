<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\BatchItem;
use Hasob\FoundationCore\Models\BatchItemCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BatchItemCreatedListener
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
     * @param  BatchItemCreated  $event
     * @return void
     */
    public function handle(BatchItemCreated $event)
    {
        //
    }
}
