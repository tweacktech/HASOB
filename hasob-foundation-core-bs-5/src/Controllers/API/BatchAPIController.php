<?php

namespace Hasob\FoundationCore\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hasob\FoundationCore\Models\Batch;

use Hasob\FoundationCore\Events\BatchCreated;
use Hasob\FoundationCore\Events\BatchUpdated;
use Hasob\FoundationCore\Events\BatchDeleted;

use Hasob\FoundationCore\Requests\API\CreateBatchAPIRequest;
use Hasob\FoundationCore\Requests\API\UpdateBatchAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class BatchController
 * @package Hasob\FoundationCore\Controllers\API
 */

class BatchAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the Batch.
     * GET|HEAD /batches
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Batch::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $batches = $this->showAll($query->get());

        return $this->sendResponse($batches->toArray(), 'Batches retrieved successfully');
    }

    /**
     * Store a newly created Batch in storage.
     * POST /batches
     *
     * @param CreateBatchAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBatchAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Batch $batch */
        $batch = Batch::create($input);
        
        BatchCreated::dispatch($batch);
        return $this->sendResponse($batch->toArray(), 'Batch saved successfully');
    }

    /**
     * Display the specified Batch.
     * GET|HEAD /batches/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Batch $batch */
        $batch = Batch::find($id);

        if (empty($batch)) {
            return $this->sendError('Batch not found');
        }

        return $this->sendResponse($batch->toArray(), 'Batch retrieved successfully');
    }

    /**
     * Update the specified Batch in storage.
     * PUT/PATCH /batches/{id}
     *
     * @param int $id
     * @param UpdateBatchAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBatchAPIRequest $request, Organization $organization)
    {
        /** @var Batch $batch */
        $batch = Batch::find($id);

        if (empty($batch)) {
            return $this->sendError('Batch not found');
        }

        $batch->fill($request->all());
        $batch->save();
        
        BatchUpdated::dispatch($batch);
        return $this->sendResponse($batch->toArray(), 'Batch updated successfully');
    }

    /**
     * Remove the specified Batch from storage.
     * DELETE /batches/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Batch $batch */
        $batch = Batch::find($id);

        if (empty($batch)) {
            return $this->sendError('Batch not found');
        }

        $batch->delete();
        BatchDeleted::dispatch($batch);
        return $this->sendSuccess('Batch deleted successfully');
    }
}
