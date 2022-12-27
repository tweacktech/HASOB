<?php

namespace Hasob\FoundationCore\Middleware;

use Closure;

use Illuminate\Support\Facades\Log;

use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Managers\OrganizationManager;

class IdentifyOrganization
{
    
    /**
    * @var App\Services\OrganizationManager
    */
    protected $tenantManager;
    
    public function __construct(OrganizationManager $tenantManager)
    {
        $this->tenantManager = $tenantManager;
    }

    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();
        Log::info("Identified Host => {$host}");
        $tenant=$this->tenantManager->loadTenant($host);

        if ($tenant != null){

            $request->route()->setParameter('org_id', $tenant->id);
            return $next($request);

        } else {

            Log::error("Unable to set Organization ID from environment file or domain");
            abort(404);

        }

    }
}
