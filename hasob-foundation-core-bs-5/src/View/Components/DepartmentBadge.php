<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class DepartmentBadge extends Component
{
    public $department;

    public function __construct($department)
    {
        $this->department = $department;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.department-badge');
    }
}