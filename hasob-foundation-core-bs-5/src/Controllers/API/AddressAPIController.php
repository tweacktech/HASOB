<?php

namespace Hasob\FoundationCore\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hasob\FoundationCore\Models\Address;

use Hasob\FoundationCore\Events\AddressCreated;
use Hasob\FoundationCore\Events\AddressUpdated;
use Hasob\FoundationCore\Events\AddressDeleted;

use Hasob\FoundationCore\Requests\API\CreateAddressAPIRequest;
use Hasob\FoundationCore\Requests\API\UpdateAddressAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class AddressController
 * @package Hasob\FoundationCore\Controllers\API
 */

class AddressAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the Address.
     * GET|HEAD /addresses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Address::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $addresses = $this->showAll($query->get());

        return $this->sendResponse($addresses->toArray(), 'Addresses retrieved successfully');
    }

    /**
     * Store a newly created Address in storage.
     * POST /addresses
     *
     * @param CreateAddressAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAddressAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Address $address */
        $address = Address::create($input);
        
        AddressCreated::dispatch($address);
        return $this->sendResponse($address->toArray(), 'Address saved successfully');
    }

    /**
     * Display the specified Address.
     * GET|HEAD /addresses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            return $this->sendError('Address not found');
        }

        return $this->sendResponse($address->toArray(), 'Address retrieved successfully');
    }

    /**
     * Update the specified Address in storage.
     * PUT/PATCH /addresses/{id}
     *
     * @param int $id
     * @param UpdateAddressAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAddressAPIRequest $request, Organization $organization)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            return $this->sendError('Address not found');
        }

        $address->fill($request->all());
        $address->save();
        
        AddressUpdated::dispatch($address);
        return $this->sendResponse($address->toArray(), 'Address updated successfully');
    }

    /**
     * Remove the specified Address from storage.
     * DELETE /addresses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            return $this->sendError('Address not found');
        }

        $address->delete();
        AddressDeleted::dispatch($address);
        return $this->sendSuccess('Address deleted successfully');
    }
}
