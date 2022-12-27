<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class LedgerEntries extends Component
{
    
    public $ledger;


    public function __construct($ledger)
    {
        $this->ledger = $ledger;
    }

    
    public function render()
    {
        return view('hasob-foundation-core::components.ledger-entries');
    }

}