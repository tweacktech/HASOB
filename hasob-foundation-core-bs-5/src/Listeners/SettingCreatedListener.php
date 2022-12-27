<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Setting;
use Hasob\FoundationCore\Event\SettingCreated;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SettingCreatedListener
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
     * @param  SettingCreated  $event
     * @return void
     */
    public function handle(SettingCreated $event)
    {
        //
    }
}
