<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class ContentEditor extends Component
{
    public $control_id;
    public $pageable;
    public $file_types;

    public function __construct($pageable, $fileTypes=null)
    {
        $this->control_id = "ate_".time();
        $this->file_types = $fileTypes;
        $this->pageable = $pageable;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.content-editor');
    }
}