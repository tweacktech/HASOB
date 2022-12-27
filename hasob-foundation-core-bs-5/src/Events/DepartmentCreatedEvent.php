<?php

namespace Hasob\FoundationCore\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


use Hasob\FoundationCore\Models\Department;

class DepartmentCreatedEvent
{
    use Dispatchable, SerializesModels;

    public $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }
}