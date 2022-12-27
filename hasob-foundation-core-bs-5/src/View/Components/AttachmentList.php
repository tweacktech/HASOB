<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class AttachmentList extends Component
{
    public $attachable;
    public $file_types;

    public function __construct($attachable, $fileTypes=null)
    {
        $this->file_types = $fileTypes;
        $this->attachable = $attachable;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.attachment-list');
    }
}