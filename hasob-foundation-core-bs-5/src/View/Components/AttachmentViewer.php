<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class AttachmentViewer extends Component
{
    public $control_id;
    public $attachable;
    public $file_types;

    public function __construct($attachable, $fileTypes=null)
    {
        $this->control_id = "atv_".time();
        $this->file_types = $fileTypes;
        $this->attachable = $attachable;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.attachment-viewer');
    }
}