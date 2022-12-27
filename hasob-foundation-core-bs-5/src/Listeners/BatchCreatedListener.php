<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Batch;
use Hasob\FoundationCore\Models\BatchCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BatchCreatedListener
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
     * @param  BatchCreated  $event
     * @return void
     */
    public function handle(BatchCreated $event)
    {
        //
    }
}
