<?php
namespace DMO\SavingsBond;

use DMO\SavingsBond\Facades;
use DMO\SavingsBond\Providers\SavingsBondEventServiceProvider;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Engines\EngineResolver;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
    * Publishes configuration file.
    *
    * @return  void
    */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/dmo-savings-bond.php';
        $this->publishes([$configPath => $this->getConfigPath()], 'config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dmo-savings-bond-module');

        // Publish view files
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dmo-savings-bond-module'),
        ], 'views');

        // Publish assets
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('dmo-savings-bond-module'),
        ], 'assets');

        // Publish view components
        $this->publishes([
            __DIR__.'/../src/View/Components/' => app_path('View/Components'),
            __DIR__.'/../resources/views/components/' => resource_path('views/components'),
        ], 'view-components');

        $this->publishes([
            __DIR__ . '/../database/seeders/SavingsBondSeeder.php' => database_path('seeders/SavingsBondSeeder.php'),
        ], 'seeders');

        
        Blade::componentNamespace('DMO\\SavingsBond\\View\\Components', 'dmo-savings-bond-module');
    }

    /**
    * Make config publishing optional by merging the config from the package.
    *
    * @return  void
    */
    public function register()
    {
        $configPath = __DIR__ . '/../config/dmo-savings-bond.php';
        $this->mergeConfigFrom($configPath, 'dmo-savings-bond');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app->bind('SavingsBond', function($app) {
            return new SavingsBond();
        });

        $this->app->register(SavingsBondEventServiceProvider::class);

    }

        /**
     * Get the active router.
     *
     * @return Router
     */
    protected function getRouter()
    {
        return $this->app['router'];
    }

    /**
     * Get the config path
     *
     * @return string
     */
    protected function getConfigPath()
    {
        return config_path('dmo-savings-bond.php');
    }

    /**
     * Publish the config file
     *
     * @param  string $configPath
     */
    protected function publishConfig($configPath)
    {
        $this->publishes([$configPath => config_path('dmo-savings-bond.php')], 'config');
    }

    /**
     * Register a Middleware
     *
     * @param  string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }
}