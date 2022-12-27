<?php

namespace Hasob\FoundationCore\Listeners;

use Hasob\FoundationCore\Models\Address;
use Hasob\FoundationCore\Models\AddressCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddressCreatedListener
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
     * @param  AddressCreated  $event
     * @return void
     */
    public function handle(AddressCreated $event)
    {
        //
    }
}
