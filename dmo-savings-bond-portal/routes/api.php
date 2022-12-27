<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


$orgRoutes = function() {

    Route::group([
        'middleware' => \Hasob\FoundationCore\Middleware\IdentifyOrganization::class,
    ], function () {

        
        \SavingsBond::api_public_routes();
        \FoundationCore::api_public_routes();

        Route::middleware(['auth:sanctum'])->group(function () {

            \SavingsBond::api_routes();
            \FoundationCore::api_routes();
            
        });

    });
};

Route::group([], $orgRoutes);