<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Page;
use Hasob\FoundationCore\Models\PageCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PageCreatedListener
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
     * @param  PageCreated  $event
     * @return void
     */
    public function handle(PageCreated $event)
    {
        //
    }
}
