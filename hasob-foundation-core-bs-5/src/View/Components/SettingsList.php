<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\View\Component;

class SettingsList extends Component
{
    public $groups;
    public $settings;
    
    public function __construct($groups, $settings)
    {
        $this->groups = $groups;
        $this->settings = $settings;
    }

    public function render()
    {
        return view('hasob-foundation-core::components.settings-list');
    }
}