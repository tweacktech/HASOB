<?php

namespace DMO\SavingsBond\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DMO\SavingsBond\Models\BrokerStaff;

use DMO\SavingsBond\Events\BrokerStaffCreated;
use DMO\SavingsBond\Events\BrokerStaffUpdated;
use DMO\SavingsBond\Events\BrokerStaffDeleted;

use DMO\SavingsBond\Requests\API\CreateBrokerStaffAPIRequest;
use DMO\SavingsBond\Requests\API\UpdateBrokerStaffAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class BrokerStaffController
 * @package DMO\SavingsBond\Controllers\API
 */

class BrokerStaffAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the BrokerStaff.
     * GET|HEAD /brokerStaffs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = BrokerStaff::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $brokerStaffs = $this->showAll($query->get());

        return $this->sendResponse($brokerStaffs->toArray(), 'Broker Staffs retrieved successfully');
    }

    /**
     * Store a newly created BrokerStaff in storage.
     * POST /brokerStaffs
     *
     * @param CreateBrokerStaffAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBrokerStaffAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var BrokerStaff $brokerStaff */
        $brokerStaff = BrokerStaff::create($input);
        
        BrokerStaffCreated::dispatch($brokerStaff);
        return $this->sendResponse($brokerStaff->toArray(), 'Broker Staff saved successfully');
    }

    /**
     * Display the specified BrokerStaff.
     * GET|HEAD /brokerStaffs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var BrokerStaff $brokerStaff */
        $brokerStaff = BrokerStaff::find($id);

        if (empty($brokerStaff)) {
            return $this->sendError('Broker Staff not found');
        }

        return $this->sendResponse($brokerStaff->toArray(), 'Broker Staff retrieved successfully');
    }

    /**
     * Update the specified BrokerStaff in storage.
     * PUT/PATCH /brokerStaffs/{id}
     *
     * @param int $id
     * @param UpdateBrokerStaffAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrokerStaffAPIRequest $request, Organization $organization)
    {
        /** @var BrokerStaff $brokerStaff */
        $brokerStaff = BrokerStaff::find($id);

        if (empty($brokerStaff)) {
            return $this->sendError('Broker Staff not found');
        }

        $brokerStaff->fill($request->all());
        $brokerStaff->save();
        
        BrokerStaffUpdated::dispatch($brokerStaff);
        return $this->sendResponse($brokerStaff->toArray(), 'BrokerStaff updated successfully');
    }

    /**
     * Remove the specified BrokerStaff from storage.
     * DELETE /brokerStaffs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var BrokerStaff $brokerStaff */
        $brokerStaff = BrokerStaff::find($id);

        if (empty($brokerStaff)) {
            return $this->sendError('Broker Staff not found');
        }

        $brokerStaff->delete();
        BrokerStaffDeleted::dispatch($brokerStaff);
        return $this->sendSuccess('Broker Staff deleted successfully');
    }
}
