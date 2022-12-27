<?php

namespace Hasob\FoundationCore\Listeners;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

use Hasob\FoundationCore\Events\OrganizationCreatedEvent;

class OrganizationCreatedListener
{
    public function handle(OrganizationCreatedEvent $event)
    {
        Log::info("New Organization Created => {$event->organization->id}");
    }
}