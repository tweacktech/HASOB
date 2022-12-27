<?php

namespace DMO\SavingsBond\Controllers\Models;

use DMO\SavingsBond\Models\Bid;

use DMO\SavingsBond\Events\BidCreated;
use DMO\SavingsBond\Events\BidUpdated;
use DMO\SavingsBond\Events\BidDeleted;

use DMO\SavingsBond\Requests\CreateBidRequest;
use DMO\SavingsBond\Requests\UpdateBidRequest;

use DMO\SavingsBond\DataTables\BidDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BidController extends BaseController
{
    /**
     * Display a listing of the Bid.
     *
     * @param BidDataTable $bidDataTable
     * @return Response
     */
    public function index(Organization $org, BidDataTable $bidDataTable)
    {
        $current_user = Auth()->user();

        $cdv_bids = new \Hasob\FoundationCore\View\Components\CardDataView(Bid::class, "dmo-savings-bond-module::pages.bids.card_view_item");
        $cdv_bids->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Bid');

        if (request()->expectsJson()){
            return $cdv_bids->render();
        }

        return view('dmo-savings-bond-module::pages.bids.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_bids', $cdv_bids);

        /*
        return $bidDataTable->render('dmo-savings-bond-module::pages.bids.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Bid.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('dmo-savings-bond-module::pages.bids.create');
    }

    /**
     * Store a newly created Bid in storage.
     *
     * @param CreateBidRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateBidRequest $request)
    {
        $input = $request->all();

        /** @var Bid $bid */
        $bid = Bid::create($input);

        //Flash::success('Bid saved successfully.');

        BidCreated::dispatch($bid);
        return redirect(route('sb.bids.index'));
    }

    /**
     * Display the specified Bid.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Bid $bid */
        $bid = Bid::find($id);

        if (empty($bid)) {
            //Flash::error('Bid not found');

            return redirect(route('sb.bids.index'));
        }

        return view('dmo-savings-bond-module::pages.bids.show')->with('bid', $bid);
    }

    /**
     * Show the form for editing the specified Bid.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Bid $bid */
        $bid = Bid::find($id);

        if (empty($bid)) {
            //Flash::error('Bid not found');

            return redirect(route('sb.bids.index'));
        }

        return view('dmo-savings-bond-module::pages.bids.edit')->with('bid', $bid);
    }

    /**
     * Update the specified Bid in storage.
     *
     * @param  int              $id
     * @param UpdateBidRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateBidRequest $request)
    {
        /** @var Bid $bid */
        $bid = Bid::find($id);

        if (empty($bid)) {
            //Flash::error('Bid not found');

            return redirect(route('sb.bids.index'));
        }

        $bid->fill($request->all());
        $bid->save();

        //Flash::success('Bid updated successfully.');
        
        BidUpdated::dispatch($bid);
        return redirect(route('sb.bids.index'));
    }

    /**
     * Remove the specified Bid from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Bid $bid */
        $bid = Bid::find($id);

        if (empty($bid)) {
            //Flash::error('Bid not found');

            return redirect(route('sb.bids.index'));
        }

        $bid->delete();

        //Flash::success('Bid deleted successfully.');
        BidDeleted::dispatch($bid);
        return redirect(route('sb.bids.index'));
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
