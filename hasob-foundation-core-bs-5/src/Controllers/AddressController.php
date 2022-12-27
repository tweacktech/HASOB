<?php

namespace Hasob\FoundationCore\Controllers;

use Hasob\FoundationCore\Models\Address;

use Hasob\FoundationCore\Events\AddressCreated;
use Hasob\FoundationCore\Events\AddressUpdated;
use Hasob\FoundationCore\Events\AddressDeleted;

use Hasob\FoundationCore\Requests\CreateAddressRequest;
use Hasob\FoundationCore\Requests\UpdateAddressRequest;

use Hasob\FoundationCore\DataTables\AddressDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class AddressController extends BaseController
{
    /**
     * Display a listing of the Address.
     *
     * @param AddressDataTable $addressDataTable
     * @return Response
     */
    public function index(Organization $org, AddressDataTable $addressDataTable)
    {
        $current_user = Auth()->user();

        $cdv_addresses = new \Hasob\FoundationCore\View\Components\CardDataView(Address::class, "hasob-foundation-core::pages.addresses.card_view_item");
        $cdv_addresses->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Address');

        if (request()->expectsJson()){
            return $cdv_addresses->render();
        }

        return view('hasob-foundation-core::pages.addresses.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_addresses', $cdv_addresses);

        /*
        return $addressDataTable->render('hasob-foundation-core::pages.addresses.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Address.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('hasob-foundation-core::pages.addresses.create');
    }

    /**
     * Store a newly created Address in storage.
     *
     * @param CreateAddressRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateAddressRequest $request)
    {
        $input = $request->all();

        /** @var Address $address */
        $address = Address::create($input);

        //Flash::success('Address saved successfully.');

        AddressCreated::dispatch($address);
        return redirect(route('fc.addresses.index'));
    }

    /**
     * Display the specified Address.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            //Flash::error('Address not found');

            return redirect(route('fc.addresses.index'));
        }

        return view('hasob-foundation-core::pages.addresses.show')->with('address', $address);
    }

    /**
     * Show the form for editing the specified Address.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            //Flash::error('Address not found');

            return redirect(route('fc.addresses.index'));
        }

        return view('hasob-foundation-core::pages.addresses.edit')->with('address', $address);
    }

    /**
     * Update the specified Address in storage.
     *
     * @param  int              $id
     * @param UpdateAddressRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateAddressRequest $request)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            //Flash::error('Address not found');

            return redirect(route('fc.addresses.index'));
        }

        $address->fill($request->all());
        $address->save();

        //Flash::success('Address updated successfully.');
        
        AddressUpdated::dispatch($address);
        return redirect(route('fc.addresses.index'));
    }

    /**
     * Remove the specified Address from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Address $address */
        $address = Address::find($id);

        if (empty($address)) {
            //Flash::error('Address not found');

            return redirect(route('fc.addresses.index'));
        }

        $address->delete();

        //Flash::success('Address deleted successfully.');
        AddressDeleted::dispatch($address);
        return redirect(route('fc.addresses.index'));
    }

        
    public function processBulkUpload(Organization $org, Request $request){

        $attachedFileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('uploads'), $attachedFileName);
        $path_to_file = public_path('uploads').'/'.$attachedFileName;

        //Process each line
        $loop = 1;
        $errors = [];
        $lines = file($path_to_file);

        if (count($lines) > 1) {
            foreach ($lines as $line) {
                
                if ($loop > 1) {
                    $data = explode(',', $line);
                    // if (count($invalids) > 0) {
                    //     array_push($errors, $invalids);
                    //     continue;
                    // }else{
                    //     //Check if line is valid
                    //     if (!$valid) {
                    //         $errors[] = $msg;
                    //     }
                    // }
                }
                $loop++;
            }
        }else{
            $errors[] = 'The uploaded csv file is empty';
        }
        
        if (count($errors) > 0) {
            return $this->sendError($this->array_flatten($errors), 'Errors processing file');
        }
        return $this->sendResponse($subject->toArray(), 'Bulk upload completed successfully');
    }
}
