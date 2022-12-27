<?php

namespace Hasob\FoundationCore\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


use Hasob\FoundationCore\Models\Attachment;

class AttachmentDeletedEvent
{
    use Dispatchable, SerializesModels;

    public $attachment;

    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }
}