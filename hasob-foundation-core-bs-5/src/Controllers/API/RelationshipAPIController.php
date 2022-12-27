<?php

namespace Hasob\FoundationCore\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hasob\FoundationCore\Models\Relationship;

use Hasob\FoundationCore\Events\RelationshipCreated;
use Hasob\FoundationCore\Events\RelationshipUpdated;
use Hasob\FoundationCore\Events\RelationshipDeleted;

use Hasob\FoundationCore\Requests\API\CreateRelationshipAPIRequest;
use Hasob\FoundationCore\Requests\API\UpdateRelationshipAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class RelationshipController
 * @package Hasob\FoundationCore\Controllers\API
 */

class RelationshipAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the Relationship.
     * GET|HEAD /relationships
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Relationship::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $relationships = $this->showAll($query->get());

        return $this->sendResponse($relationships->toArray(), 'Relationships retrieved successfully');
    }

    /**
     * Store a newly created Relationship in storage.
     * POST /relationships
     *
     * @param CreateRelationshipAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRelationshipAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Relationship $relationship */
        $relationship = Relationship::create($input);
        
        RelationshipCreated::dispatch($relationship);
        return $this->sendResponse($relationship->toArray(), 'Relationship saved successfully');
    }

    /**
     * Display the specified Relationship.
     * GET|HEAD /relationships/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Relationship $relationship */
        $relationship = Relationship::find($id);

        if (empty($relationship)) {
            return $this->sendError('Relationship not found');
        }

        return $this->sendResponse($relationship->toArray(), 'Relationship retrieved successfully');
    }

    /**
     * Update the specified Relationship in storage.
     * PUT/PATCH /relationships/{id}
     *
     * @param int $id
     * @param UpdateRelationshipAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRelationshipAPIRequest $request, Organization $organization)
    {
        /** @var Relationship $relationship */
        $relationship = Relationship::find($id);

        if (empty($relationship)) {
            return $this->sendError('Relationship not found');
        }

        $relationship->fill($request->all());
        $relationship->save();
        
        RelationshipUpdated::dispatch($relationship);
        return $this->sendResponse($relationship->toArray(), 'Relationship updated successfully');
    }

    /**
     * Remove the specified Relationship from storage.
     * DELETE /relationships/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Relationship $relationship */
        $relationship = Relationship::find($id);

        if (empty($relationship)) {
            return $this->sendError('Relationship not found');
        }

        $relationship->delete();
        RelationshipDeleted::dispatch($relationship);
        return $this->sendSuccess('Relationship deleted successfully');
    }
}
