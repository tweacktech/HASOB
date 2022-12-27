<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Setting;
use Hasob\FoundationCore\Models\SettingUpdated;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SettingUpdatedListener
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
     * @param  SettingUpdated  $event
     * @return void
     */
    public function handle(SettingUpdated $event)
    {
        //
    }
}
