<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Batch;
use Hasob\FoundationCore\Models\BatchUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BatchUpdatedListener
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
     * @param  BatchUpdated  $event
     * @return void
     */
    public function handle(BatchUpdated $event)
    {
        //
    }
}
