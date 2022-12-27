<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class PictureAttachmentViewer extends Component
{
    public $control_id;
    public $file_types;
    public $attachable;
    public $show_tags;
    public $display_limit;
    public $display_style;

    public function __construct($attachable, $file_types="jpg,png,jpeg", $show_tags=true, $display_limit=20, $display_style="grid")
    {
        $this->control_id = "pv_".time();
        $this->show_tags = $show_tags;
        $this->attachable = $attachable;
        $this->file_types = $file_types;
        $this->display_limit = $display_limit;
        $this->display_style = $display_style;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.picture-attachment-viewer');
    }
}