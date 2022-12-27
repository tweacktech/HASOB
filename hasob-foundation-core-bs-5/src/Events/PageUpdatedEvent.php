<?php

namespace Hasob\FoundationCore\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


use Hasob\FoundationCore\Models\Page;

class PageUpdatedEvent
{
    use Dispatchable, SerializesModels;

    public $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }
}