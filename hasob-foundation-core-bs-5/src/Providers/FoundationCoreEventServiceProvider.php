<?php

namespace Hasob\FoundationCore\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Hasob\FoundationCore\Events\AttachmentCreatedEvent;
use Hasob\FoundationCore\Events\OrganizationCreatedEvent;
use Hasob\FoundationCore\Listeners\OrganizationCreatedListener;

class FoundationCoreEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        OrganizationCreatedEvent::class => [
            OrganizationCreatedListener::class,
        ]
    ];

    public function boot()
    {
        parent::boot();
    }
}