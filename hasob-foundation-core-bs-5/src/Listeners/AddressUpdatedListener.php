<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Address;
use Hasob\FoundationCore\Models\AddressUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddressUpdatedListener
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
     * @param  AddressUpdated  $event
     * @return void
     */
    public function handle(AddressUpdated $event)
    {
        //
    }
}
