<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class SiteList extends Component
{
    public $sites;

    public function __construct($sites)
    {
        $this->sites = $sites;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.sites-list');
    }
}