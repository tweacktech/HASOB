<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class LedgersList extends Component
{
    public $ledgers;

    public function __construct($ledgers)
    {
        $this->ledgers = $ledgers;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.ledgers-list');
    }
}