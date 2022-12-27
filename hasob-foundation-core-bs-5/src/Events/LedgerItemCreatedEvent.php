<?php

namespace Hasob\FoundationCore\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


use Hasob\FoundationCore\Models\LedgerItem;

class LedgerItemCreatedEvent
{
    use Dispatchable, SerializesModels;

    public $ledger_item;

    public function __construct(LedgerItem $ledger_item)
    {
        $this->ledger_item = $ledger_item;
    }
}