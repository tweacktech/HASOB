<?php

namespace Hasob\FoundationCore\Facades;

use Illuminate\Support\Facades\Facade;

class FoundationCore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'FoundationCore';
    }
}