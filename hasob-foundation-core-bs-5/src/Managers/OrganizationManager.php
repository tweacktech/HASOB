<?php
namespace Hasob\FoundationCore\Managers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

use Hasob\FoundationCore\Models\Organization;


class OrganizationManager {
    
    private $tenant;
   
    public function setTenant(Organization $tenant) {
        $this->tenant = $tenant;
        return $this;
    }
    
    public function getTenant() {
        return $this->tenant;
    }
    
    public function loadTenant($identifier) {

        if (Schema::hasTable('fc_organizations') == false){
            Log::error("Unable to set Organization ID as organizations table doesn't exist on DB");
            return null;
        }

        if ($identifier == "127.0.0.1" || $identifier == "localhost"){

            //this is local development
            Log::info("Local development environment detected.");
            $default_org_id = env('DEFAULT_ORGANIZATION', null);

            if ($default_org_id != null){
                
                Log::info("Identified Organization from env settings => {$default_org_id}");
                $tenant = Organization::find($default_org_id);

            }else{

                $tenant = Organization::where('is_local_default_organization', true)->first();
                if ($tenant) {
                    $default_org_id = $tenant->id;
                    Log::info("Identified Organization from default organization selected in DB => {$default_org_id}");
                }
            }

            if ($tenant) {
                Log::info("Organization Loaded in Tenant Manager => {$tenant->org}/{$tenant->domain}");
                $this->setTenant($tenant);
                return $tenant;
            }
        }else {
            
            $tenant = Organization::query()->where('full_url', 'LIKE', "%{$identifier}%")->first();
            if ($tenant) {
                Log::info("Organization Found for Host {$identifier}");
                Log::info("Organization Loaded in Tenant Manager => {$tenant->id} => {$tenant->org}/{$tenant->domain}");
                $this->setTenant($tenant);
                return $tenant;
            }
        }

        Log::error("Unable to set Organization ID from env or domain");
        return null;
    }

}