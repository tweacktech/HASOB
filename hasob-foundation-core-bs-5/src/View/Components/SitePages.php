<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class SitePages extends Component
{
    public $site;

    public function __construct($site)
    {
        $this->site = $site;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.site-pages');
    }
}