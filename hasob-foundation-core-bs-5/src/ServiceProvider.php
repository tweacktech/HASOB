<?php
namespace Hasob\FoundationCore;

use Hash;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Setting;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Managers\OrganizationManager;

use Hasob\FoundationCore\Facades;
use Hasob\FoundationCore\Providers\FoundationCoreEventServiceProvider;

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
        $configPath = __DIR__ . '/../config/hasob-foundation-core.php';
        $this->publishes([$configPath => $this->getConfigPath()], 'config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'hasob-foundation-core');

        // Publish view files
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/hasob-foundation-core'),
        ], 'views');

        // Publish assets
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('hasob-foundation-core'),
        ], 'assets');

        // Publish view components
        $this->publishes([
            __DIR__.'/../src/View/Components/' => app_path('View/Components'),
            __DIR__.'/../resources/views/components/' => resource_path('views/components'),
        ], 'view-components');

        $this->publishes([
            __DIR__ . '/../database/seeders/FoundationCoreSeeder.php' => database_path('seeders/FoundationCoreSeeder.php'),
        ], 'seeders');

        
        Blade::componentNamespace('Hasob\\FoundationCore\\View\\Components', 'hasob-foundation-core');

        $this->registerSecurityRoles();
        $this->initializeOrganization();
        $this->registerSettings();
    }

    /**
    * Make config publishing optional by merging the config from the package.
    *
    * @return  void
    */
    public function register()
    {
        $configPath = __DIR__ . '/../config/hasob-foundation-core.php';
        $this->mergeConfigFrom($configPath, 'hasob-foundation-core');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app->bind('FoundationCore', function($app) {
            return new FoundationCore();
        });

        $this->app->register(FoundationCoreEventServiceProvider::class);

    }

    private function initializeOrganization(){

        if (Schema::hasTable('fc_organizations')){

            //Create default organization
            $default_org_id = null;
            if (DB::table('fc_organizations')->count() == 0){
                $default_org_id = Organization::create([
                    'org' => 'app',
                    'domain' => 'test',
                    'full_url' => 'www.app.test',
                    'subdomain' => 'sub',
                    'is_local_default_organization' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ])->id;
            }else{
                $default_org_id = DB::table('fc_organizations')->where('is_local_default_organization', true)->select('id')->first()->id;
            }
        
            if (Schema::hasTable('fc_departments')){
                //Create home department
                if (DB::table('fc_departments')->count() == 0){
                    $fc_department_id = Department::create([
                        'key' => 'home',
                        'long_name' => 'Home',
                        'email' => 'home@app.com',
                        'telephone' => '07085554141',
                        'physical_location' => 'Ground Floor',
                        'organization_id' => $default_org_id,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ])->id;
                }
            }

            if (Schema::hasTable('fc_users')){
                //Create user accounts
                if (DB::table('fc_users')->count() == 0){
                    $platform_admin_id = User::create([
                        'email' => 'admin@app.com',
                        'telephone' => '07063321200',
                        'password' => Hash::make('password'),
                        'first_name' => 'Admin',
                        'last_name' => 'Admin',
                        'organization_id' => $default_org_id,
                        'last_loggedin_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ])->id;
                
                    $usr = User::where('email','admin@app.com')->first();
                    if ($usr != null){ $usr->assignRole('admin'); }
                }
            }

        }
    }

    public function registerSettings(){


        $app_settings = [
            'portal_app_name'=>['group_name'=>'Portal','display_type'=>'string','display_name'=>'Application Name','display_ordinal'=>1],
            'portal_contact_name'=>['group_name'=>'Portal','display_type'=>'string','display_name'=>'Contact Name on Portal Support','display_ordinal'=>2],
            'portal_contact_phone'=>['group_name'=>'Portal','display_type'=>'string','display_name'=>'Contact Phone Number on Portal Support','display_ordinal'=>3],
            'portal_contact_email'=>['group_name'=>'Portal','display_type'=>'string','display_name'=>'Contact Email on Portal Support','display_ordinal'=>4],

            'portal_email_sender_name'=>['group_name'=>'Portal','display_type'=>'string','display_name'=>'Name for Sending Email','display_ordinal'=>5],
            'portal_email_sender_email'=>['group_name'=>'Portal','display_type'=>'string','display_name'=>'Email Address for Sending Email','display_ordinal'=>6],
            
            'portal_welcome_text'=>['group_name'=>'Portal Text','display_type'=>'textarea','display_name'=>'Welcome text on Landing Page of Portal','display_ordinal'=>1],
            'portal_login_text'=>['group_name'=>'Portal Text','display_type'=>'textarea','display_name'=>'Text on Login Page','display_ordinal'=>2],
            'portal_registration_text'=>['group_name'=>'Portal Text','display_type'=>'textarea','display_name'=>'Text on Registration Page','display_ordinal'=>3],
            
            'portal_file_high_res_picture'=>['group_name'=>'Portal Graphics','display_type'=>'file-select','display_name'=>'High Resolution Image of Portal Logo','display_ordinal'=>1],
            'portal_file_icon_picture'=>['group_name'=>'Portal Graphics','display_type'=>'file-select','display_name'=>'Icon Image of Portal','display_ordinal'=>2],
            'portal_file_landing_page_picture'=>['group_name'=>'Portal Graphics','display_type'=>'file-select','display_name'=>'Image on Landing Page of Portal','display_ordinal'=>3],

            'portal_long_name'=>['group_name'=>'Application','display_type'=>'string','display_name'=>'Institution Name','display_ordinal'=>2],
            'portal_short_name'=>['group_name'=>'Application','display_type'=>'string','display_name'=>'Institution Abbreviation','display_ordinal'=>3],
            'portal_official_website'=>['group_name'=>'Application','display_type'=>'string','display_name'=>'Official Institution Website','display_ordinal'=>4],
            'portal_official_email'=>['group_name'=>'Application','display_type'=>'email','display_name'=>'Official Institution Email','display_ordinal'=>5],
            'portal_official_phone'=>['group_name'=>'Application','display_type'=>'number','display_name'=>'Official Institution Phone Number','display_ordinal'=>6],
            'portal_official_address'=>['group_name'=>'Application','display_type'=>'string','display_name'=>'Official Institution Address','display_ordinal'=>7],
        ];

        if (Schema::hasTable('fc_organizations') && Schema::hasTable('fc_settings')){

            $host = request()->getHost();
            $manager = new OrganizationManager();
            $org = $manager->loadTenant($host);

            if ($org != null){


                foreach($app_settings as $key=>$setting){
                    \FoundationCore::register_setting(
                        $org, 
                        $key, 
                        $setting['group_name'],
                        $setting['display_type'],
                        $setting['display_name'], 
                        "app_settings", 
                        $setting['display_ordinal']
                    );
                }

                $setting_list = Setting::whereIn('key',array_keys($app_settings))->get();

                $app_setting_values = $setting_list->mapWithKeys(function($item,$key){
                    return [$item->key => $item->value];
                });

                \View::share('app_settings', $app_setting_values);
            }

        }


    }

    public function registerSecurityRoles(){

        //Roles in this application with their roles.
        \FoundationCore::register_roles([
            'admin'                 =>  [],
            'departments-admin'     =>  [],
            'ledgers-admin'         =>  [],
            'sites-admin'           =>  [],
            'personal-ledger'       =>  [],
            'principal-officer'     =>  [],
        ]);
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
        return config_path('hasob-foundation-core.php');
    }

    /**
     * Publish the config file
     *
     * @param  string $configPath
     */
    protected function publishConfig($configPath)
    {
        $this->publishes([$configPath => config_path('hasob-foundation-core.php')], 'config');
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