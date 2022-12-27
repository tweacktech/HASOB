<?php

namespace Hasob\FoundationCore\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hasob\FoundationCore\Models\SiteArtifact;

use Hasob\FoundationCore\Events\SiteArtifactCreatedEvent;
use Hasob\FoundationCore\Events\SiteArtifactUpdatedEvent;
use Hasob\FoundationCore\Events\SiteArtifactDeletedEvent;

use Hasob\FoundationCore\Requests\API\CreateSiteArtifactAPIRequest;
use Hasob\FoundationCore\Requests\API\UpdateSiteArtifactAPIRequest;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

use Hasob\FoundationCore\Models\Organization;

/**
 * Class SiteArtifactController
 * @package Hasob\FoundationCore\Controllers\API
 */

class SiteArtifactAPIController extends AppBaseController
{
    /**
     * Display a listing of the SiteArtifact.
     * GET|HEAD /siteArtifacts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = SiteArtifact::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $siteArtifacts = $query->get();

        return $this->sendResponse($siteArtifacts->toArray(), 'Site Artifacts retrieved successfully');
    }

    /**
     * Store a newly created SiteArtifact in storage.
     * POST /siteArtifacts
     *
     * @param CreateSiteArtifactAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSiteArtifactAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var SiteArtifact $siteArtifact */
        $siteArtifact = SiteArtifact::create($input);
        
        SiteArtifactCreated::dispatch($siteArtifact);
        return $this->sendResponse($siteArtifact->toArray(), 'Site Artifact saved successfully');
    }

    /**
     * Display the specified SiteArtifact.
     * GET|HEAD /siteArtifacts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var SiteArtifact $siteArtifact */
        $siteArtifact = SiteArtifact::find($id);

        if (empty($siteArtifact)) {
            return $this->sendError('Site Artifact not found');
        }

        return $this->sendResponse($siteArtifact->toArray(), 'Site Artifact retrieved successfully');
    }

    /**
     * Update the specified SiteArtifact in storage.
     * PUT/PATCH /siteArtifacts/{id}
     *
     * @param int $id
     * @param UpdateSiteArtifactAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSiteArtifactAPIRequest $request, Organization $organization)
    {
        /** @var SiteArtifact $siteArtifact */
        $siteArtifact = SiteArtifact::find($id);

        if (empty($siteArtifact)) {
            return $this->sendError('Site Artifact not found');
        }

        $siteArtifact->fill($request->all());
        $siteArtifact->save();
        
        SiteArtifactUpdated::dispatch($siteArtifact);
        return $this->sendResponse($siteArtifact->toArray(), 'SiteArtifact updated successfully');
    }

    /**
     * Remove the specified SiteArtifact from storage.
     * DELETE /siteArtifacts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var SiteArtifact $siteArtifact */
        $siteArtifact = SiteArtifact::find($id);

        if (empty($siteArtifact)) {
            return $this->sendError('Site Artifact not found');
        }

        $siteArtifact->delete();
        SiteArtifactDeleted::dispatch($siteArtifact);
        return $this->sendSuccess('Site Artifact deleted successfully');
    }
}
