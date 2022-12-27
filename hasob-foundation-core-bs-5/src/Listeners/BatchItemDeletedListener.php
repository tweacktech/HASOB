<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\BatchItem;
use Hasob\FoundationCore\Models\BatchItemDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BatchItemDeletedListener
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
     * @param  BatchItemDeleted  $event
     * @return void
     */
    public function handle(BatchItemDeleted $event)
    {
        //
    }
}
