<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Page;
use Hasob\FoundationCore\Models\PageUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PageUpdatedListener
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
     * @param  PageUpdated  $event
     * @return void
     */
    public function handle(PageUpdated $event)
    {
        //
    }
}
