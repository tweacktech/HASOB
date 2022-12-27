<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class AttributeEditor extends Component
{
    public $control_id;
    public $artifactable;
    public $file_types;

    public function __construct($artifactable, $fileTypes=null)
    {
        $this->control_id = "ate_".time();
        $this->file_types = $fileTypes;
        $this->artifactable = $artifactable;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.attribute-editor');
    }
}