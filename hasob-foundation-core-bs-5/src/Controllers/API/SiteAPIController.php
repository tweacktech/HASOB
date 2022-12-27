<?php

namespace Hasob\FoundationCore\Controllers\API;

use Hasob\FoundationCore\Events\SiteCreatedEvent;
use Hasob\FoundationCore\Events\SiteUpdatedEvent;
use Hasob\FoundationCore\Events\SiteDeletedEvent;

use Hasob\FoundationCore\Requests\API\CreateSiteAPIRequest;
use Hasob\FoundationCore\Requests\API\UpdateSiteAPIRequest;
use Hasob\FoundationCore\Models\Site;

use Illuminate\Http\Request;

use Hasob\FoundationCore\Controllers\BaseController;
use Response;

use Hasob\FoundationCore\Models\Organization;

/**
 * Class SiteController
 * @package Hasob\FoundationCore\Controllers\API
 */

class SiteAPIController extends BaseController
{
    /**
     * Display a listing of the Site.
     * GET|HEAD /sites
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Site::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $sites = $query->get();

        return $this->sendResponse($sites->toArray(), 'Sites retrieved successfully');
    }

    /**
     * Store a newly created Site in storage.
     * POST /sites
     *
     * @param CreateSiteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSiteAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Site $site */
        $site = Site::create($input);
        if (empty($request->site_path) == true){
            $site->site_path = strtolower(self::generateRandomCode(8));
        }
        $site->save();
        
        SiteCreatedEvent::dispatch($site);
        return $this->sendResponse($site->toArray(), 'Site saved successfully');
    }

    /**
     * Display the specified Site.
     * GET|HEAD /sites/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Site $site */
        $site = Site::find($id);

        if (empty($site)) {
            return $this->sendError('Site not found');
        }

        return $this->sendResponse($site->toArray(), 'Site retrieved successfully');
    }

    /**
     * Update the specified Site in storage.
     * PUT/PATCH /sites/{id}
     *
     * @param int $id
     * @param UpdateSiteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSiteAPIRequest $request, Organization $organization)
    {
        /** @var Site $site */
        $site = Site::find($id);

        if (empty($site)) {
            return $this->sendError('Site not found');
        }

        $site->fill($request->all());
        $site->save();
        
        SiteUpdatedEvent::dispatch($site);
        return $this->sendResponse($site->toArray(), 'Site updated successfully');
    }

    /**
     * Remove the specified Site from storage.
     * DELETE /sites/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Site $site */
        $site = Site::find($id);

        if (empty($site)) {
            return $this->sendError('Site not found');
        }

        $site->delete();
        SiteDeletedEvent::dispatch($site);
        return $this->sendSuccess('Site deleted successfully');
    }
}
