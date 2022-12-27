<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class SocialEditor extends Component
{
    public $control_id;
    public $socialable;

    public function __construct($socialable)
    {
        $this->control_id = "ase_".time();
        $this->socialable = $socialable;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.social-editor');
    }
}