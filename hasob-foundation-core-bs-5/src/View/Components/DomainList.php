<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class DomainList extends Component
{
    public $domains;

    public function __construct($domains)
    {
        $this->domains = $domains;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.domain-list');
    }
}