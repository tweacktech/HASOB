<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Address;
use Hasob\FoundationCore\Models\AddressDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddressDeletedListener
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
     * @param  AddressDeleted  $event
     * @return void
     */
    public function handle(AddressDeleted $event)
    {
        //
    }
}
