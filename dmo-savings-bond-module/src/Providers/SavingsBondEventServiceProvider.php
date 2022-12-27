<?php

namespace DMO\SavingsBond\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use DMO\SavingsBond\Events\OfferCreated;
use DMO\SavingsBond\Listeners\OfferCreatedListener;
use DMO\SavingsBond\Events\OfferUpdated;
use DMO\SavingsBond\Listeners\OfferUpdatedListener;
use DMO\SavingsBond\Events\OfferDeleted;
use DMO\SavingsBond\Listeners\OfferDeletedListener;

class SavingsBondEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrganizationCreatedEvent::class => [
            OrganizationCreatedListener::class,
        ],
        OfferCreated::class => [
            OfferCreatedListener::class,
        ],
       
        OfferUpdated::class => [
            OfferUpdatedListener::class,
        ], 

        OfferDeleted::class => [
            OfferDeletedListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}