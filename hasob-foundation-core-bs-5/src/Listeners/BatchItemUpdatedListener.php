<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\BatchItem;
use Hasob\FoundationCore\Models\BatchItemUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BatchItemUpdatedListener
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
     * @param  BatchItemUpdated  $event
     * @return void
     */
    public function handle(BatchItemUpdated $event)
    {
        //
    }
}
