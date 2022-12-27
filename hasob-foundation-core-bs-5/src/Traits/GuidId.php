<?php

namespace Hasob\FoundationCore\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait GuidId
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Log::debug("Creating event for {$model} detected");

            if (! $model->getKey()) {
                $guidStr = (string) Str::uuid();
                $model->{$model->getKeyName()} = $guidStr;
                Log::debug("Primary GUID created == {$guidStr}");
            }
        });
        
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}