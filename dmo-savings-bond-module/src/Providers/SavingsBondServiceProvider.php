<?php

namespace DMO\SavingsBond\Providers;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

use Hasob\FoundationCore\Models\Setting;
use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Managers\OrganizationManager;

use Illuminate\Support\ServiceProvider;

class SavingsBondServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

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
        $org = $manager->loadTenant($host);

        //Roles in this application with their roles.
        $app_roles = [
            'investor'      =>  [],
            'broker-admin'  =>  [],
            'broker-staff'  =>  [],
            'dmo-admin'     =>  [],
            'dmo-staff'     =>  [],
        ];

        \FoundationCore::register_roles($app_roles);

        $app_settings = [

            'allow_broker_register_investor'=>['group_name'=>'DMO','display_type'=>'boolean','display_name'=>'Allow Broker Register Investor','display_ordinal'=>1],
            'allow_investor_change_broker'=>['group_name'=>'DMO','display_type'=>'boolean','display_name'=>'Allow Investor Change Broker','display_ordinal'=>2],
            
        ];

        if (Schema::hasTable('fc_organizations') && Schema::hasTable('fc_settings')){

            if ($org != null && \FoundationCore::has_feature('savings-bond',$org)){

                foreach($app_settings as $key=>$setting){
                    \FoundationCore::register_setting(
                        $org, 
                        $key, 
                        $setting['group_name'],
                        $setting['display_type'],
                        $setting['display_name'], 
                        "savings-bond", 
                        $setting['display_ordinal']
                    );
                }

                $setting_list = Setting::whereIn('key',array_keys($app_settings))->get();

                $app_setting_values = $setting_list->mapWithKeys(function($item,$key){
                    return [$item->key => $item->value];
                });

                \View::share('savings_bond_settings', $app_setting_values);
            }
        }

        if (isset($org) && $org != null && \FoundationCore::has_feature('savings-bond',$org)){

            //Register the workables available in this module
            //Register the operations for this module   
            //Register the workflows available via this module
            
        }

    }
}
