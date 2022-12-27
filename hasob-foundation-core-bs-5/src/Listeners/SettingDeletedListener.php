<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Setting;
use Hasob\FoundationCore\Events\SettingDeleted;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SettingDeletedListener
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
     * @param  SettingDeleted  $event
     * @return void
     */
    public function handle(SettingDeleted $event)
    {
        //
    }
}
