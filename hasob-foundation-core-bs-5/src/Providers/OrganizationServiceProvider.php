<?php

namespace Hasob\FoundationCore\Providers;

use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Managers\OrganizationManager;

use Illuminate\Support\ServiceProvider;

class OrganizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $manager = new OrganizationManager();
        $this->app->instance(OrganizationManager::class, $manager);
        $this->app->bind(Organization::class, function () use($manager) {
            return $manager->getTenant();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $host = request()->getHost();
        $manager = new OrganizationManager();
        $tenant = $manager->loadTenant($host);

        if ($tenant != null){
            \View::share('organization', Organization::find($tenant->id));
        }
        
    }
}
