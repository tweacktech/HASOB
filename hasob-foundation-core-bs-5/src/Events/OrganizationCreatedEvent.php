<?php

namespace Hasob\FoundationCore\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


use Hasob\FoundationCore\Models\Organization;

class OrganizationCreatedEvent
{
    use Dispatchable, SerializesModels;

    public $organization;

    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }
}