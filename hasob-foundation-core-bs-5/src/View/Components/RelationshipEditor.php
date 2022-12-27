<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class RelationshipEditor extends Component
{
    public $relatable;

    public function __construct($relatable)
    {
        $this->relatable = $relatable;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.relationship-editor');
    }
}