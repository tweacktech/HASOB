<?php

namespace DMO\SavingsBond\Controllers\Models;

use DMO\SavingsBond\Models\Broker;

use DMO\SavingsBond\Events\BrokerCreated;
use DMO\SavingsBond\Events\BrokerUpdated;
use DMO\SavingsBond\Events\BrokerDeleted;

use DMO\SavingsBond\Requests\CreateBrokerRequest;
use DMO\SavingsBond\Requests\UpdateBrokerRequest;

use DMO\SavingsBond\DataTables\BrokerDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BrokerController extends BaseController
{
    /**
     * Display a listing of the Broker.
     *
     * @param BrokerDataTable $brokerDataTable
     * @return Response
     */
    public function index(Organization $org, BrokerDataTable $brokerDataTable)
    {
        $current_user = Auth()->user();

        $cdv_brokers = new \Hasob\FoundationCore\View\Components\CardDataView(Broker::class, "dmo-savings-bond-module::pages.brokers.card_view_item");
        $cdv_brokers->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Broker');

        if (request()->expectsJson()){
            return $cdv_brokers->render();
        }

        return view('dmo-savings-bond-module::pages.brokers.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_brokers', $cdv_brokers);

        /*
        return $brokerDataTable->render('dmo-savings-bond-module::pages.brokers.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Broker.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('dmo-savings-bond-module::pages.brokers.create');
    }

    /**
     * Store a newly created Broker in storage.
     *
     * @param CreateBrokerRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateBrokerRequest $request)
    {
        $input = $request->all();

        /** @var Broker $broker */
        $broker = Broker::create($input);

        //Flash::success('Broker saved successfully.');

        BrokerCreated::dispatch($broker);
        return redirect(route('sb.brokers.index'));
    }

    /**
     * Display the specified Broker.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Broker $broker */
        $broker = Broker::find($id);

        if (empty($broker)) {
            //Flash::error('Broker not found');

            return redirect(route('sb.brokers.index'));
        }

        return view('dmo-savings-bond-module::pages.brokers.show')->with('broker', $broker);
    }

    /**
     * Show the form for editing the specified Broker.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Broker $broker */
        $broker = Broker::find($id);

        if (empty($broker)) {
            //Flash::error('Broker not found');

            return redirect(route('sb.brokers.index'));
        }

        return view('dmo-savings-bond-module::pages.brokers.edit')->with('broker', $broker);
    }

    /**
     * Update the specified Broker in storage.
     *
     * @param  int              $id
     * @param UpdateBrokerRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateBrokerRequest $request)
    {
        /** @var Broker $broker */
        $broker = Broker::find($id);

        if (empty($broker)) {
            //Flash::error('Broker not found');

            return redirect(route('sb.brokers.index'));
        }

        $broker->fill($request->all());
        $broker->save();

        //Flash::success('Broker updated successfully.');
        
        BrokerUpdated::dispatch($broker);
        return redirect(route('sb.brokers.index'));
    }

    /**
     * Remove the specified Broker from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Broker $broker */
        $broker = Broker::find($id);

        if (empty($broker)) {
            //Flash::error('Broker not found');

            return redirect(route('sb.brokers.index'));
        }

        $broker->delete();

        //Flash::success('Broker deleted successfully.');
        BrokerDeleted::dispatch($broker);
        return redirect(route('sb.brokers.index'));
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
