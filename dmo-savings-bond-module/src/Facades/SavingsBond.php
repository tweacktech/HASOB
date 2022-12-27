<?php

namespace DMO\SavingsBond\Facades;

use Illuminate\Support\Facades\Facade;

class SavingsBond extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SavingsBond';
    }
}