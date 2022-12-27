<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Rating;
use Hasob\FoundationCore\Models\RatingUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RatingUpdatedListener
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
     * @param  RatingUpdated  $event
     * @return void
     */
    public function handle(RatingUpdated $event)
    {
        //
    }
}
