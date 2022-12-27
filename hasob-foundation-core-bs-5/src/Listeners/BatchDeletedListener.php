<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Batch;
use Hasob\FoundationCore\Models\BatchDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BatchDeletedListener
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
     * @param  BatchDeleted  $event
     * @return void
     */
    public function handle(BatchDeleted $event)
    {
        //
    }
}
