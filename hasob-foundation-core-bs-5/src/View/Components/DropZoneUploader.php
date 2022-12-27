<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class DropZoneUploader extends Component
{
    public $file_types;
    public $attachable;
    public $max_mb_size;

    public function __construct($attachable, $file_types=".jpeg,.jpg,.png,.gif,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx", $max_mb_size=150)
    {
        $this->attachable = $attachable;
        $this->file_types = $file_types;
        $this->max_mb_size = $max_mb_size;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.drop-zone-uploader');
    }
}