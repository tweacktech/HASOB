<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class DepartmentList extends Component
{
    public $departments;

    public function __construct($departments, $label="Department")
    {
        $this->departments = $departments;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.departments-list');
    }
}