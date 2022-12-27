<?php

namespace DMO\SavingsBond\Controllers\Models;

use DMO\SavingsBond\Models\BrokerStaff;

use DMO\SavingsBond\Events\BrokerStaffCreated;
use DMO\SavingsBond\Events\BrokerStaffUpdated;
use DMO\SavingsBond\Events\BrokerStaffDeleted;

use DMO\SavingsBond\Requests\CreateBrokerStaffRequest;
use DMO\SavingsBond\Requests\UpdateBrokerStaffRequest;

use DMO\SavingsBond\DataTables\BrokerStaffDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BrokerStaffController extends BaseController
{
    /**
     * Display a listing of the BrokerStaff.
     *
     * @param BrokerStaffDataTable $brokerStaffDataTable
     * @return Response
     */
    public function index(Organization $org, BrokerStaffDataTable $brokerStaffDataTable)
    {
        $current_user = Auth()->user();

        $cdv_broker_staffs = new \Hasob\FoundationCore\View\Components\CardDataView(BrokerStaff::class, "dmo-savings-bond-module::pages.broker_staffs.card_view_item");
        $cdv_broker_staffs->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search BrokerStaff');

        if (request()->expectsJson()){
            return $cdv_broker_staffs->render();
        }

        return view('dmo-savings-bond-module::pages.broker_staffs.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_broker_staffs', $cdv_broker_staffs);

        /*
        return $brokerStaffDataTable->render('dmo-savings-bond-module::pages.broker_staffs.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new BrokerStaff.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('dmo-savings-bond-module::pages.broker_staffs.create');
    }

    /**
     * Store a newly created BrokerStaff in storage.
     *
     * @param CreateBrokerStaffRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateBrokerStaffRequest $request)
    {
        $input = $request->all();

        /** @var BrokerStaff $brokerStaff */
        $brokerStaff = BrokerStaff::create($input);

        //Flash::success('Broker Staff saved successfully.');

        BrokerStaffCreated::dispatch($brokerStaff);
        return redirect(route('sb.brokerStaffs.index'));
    }

    /**
     * Display the specified BrokerStaff.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var BrokerStaff $brokerStaff */
        $brokerStaff = BrokerStaff::find($id);

        if (empty($brokerStaff)) {
            //Flash::error('Broker Staff not found');

            return redirect(route('sb.brokerStaffs.index'));
        }

        return view('dmo-savings-bond-module::pages.broker_staffs.show')->with('brokerStaff', $brokerStaff);
    }

    /**
     * Show the form for editing the specified BrokerStaff.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var BrokerStaff $brokerStaff */
        $brokerStaff = BrokerStaff::find($id);

        if (empty($brokerStaff)) {
            //Flash::error('Broker Staff not found');

            return redirect(route('sb.brokerStaffs.index'));
        }

        return view('dmo-savings-bond-module::pages.broker_staffs.edit')->with('brokerStaff', $brokerStaff);
    }

    /**
     * Update the specified BrokerStaff in storage.
     *
     * @param  int              $id
     * @param UpdateBrokerStaffRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateBrokerStaffRequest $request)
    {
        /** @var BrokerStaff $brokerStaff */
        $brokerStaff = BrokerStaff::find($id);

        if (empty($brokerStaff)) {
            //Flash::error('Broker Staff not found');

            return redirect(route('sb.brokerStaffs.index'));
        }

        $brokerStaff->fill($request->all());
        $brokerStaff->save();

        //Flash::success('Broker Staff updated successfully.');
        
        BrokerStaffUpdated::dispatch($brokerStaff);
        return redirect(route('sb.brokerStaffs.index'));
    }

    /**
     * Remove the specified BrokerStaff from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var BrokerStaff $brokerStaff */
        $brokerStaff = BrokerStaff::find($id);

        if (empty($brokerStaff)) {
            //Flash::error('Broker Staff not found');

            return redirect(route('sb.brokerStaffs.index'));
        }

        $brokerStaff->delete();

        //Flash::success('Broker Staff deleted successfully.');
        BrokerStaffDeleted::dispatch($brokerStaff);
        return redirect(route('sb.brokerStaffs.index'));
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
