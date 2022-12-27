<?php

namespace Hasob\FoundationCore\Controllers;

use Hasob\FoundationCore\Models\Batch;

use Hasob\FoundationCore\Events\BatchCreated;
use Hasob\FoundationCore\Events\BatchUpdated;
use Hasob\FoundationCore\Events\BatchDeleted;

use Hasob\FoundationCore\Requests\CreateBatchRequest;
use Hasob\FoundationCore\Requests\UpdateBatchRequest;

use Hasob\FoundationCore\DataTables\BatchDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BatchController extends BaseController
{
    /**
     * Display a listing of the Batch.
     *
     * @param BatchDataTable $batchDataTable
     * @return Response
     */
    public function index(Organization $org, BatchDataTable $batchDataTable)
    {
        $current_user = Auth()->user();

        $cdv_batches = new \Hasob\FoundationCore\View\Components\CardDataView(Batch::class, "hasob-foundation-core::pages.batches.card_view_item");
        $cdv_batches->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Batch');

        if (request()->expectsJson()){
            return $cdv_batches->render();
        }

        return view('hasob-foundation-core::pages.batches.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_batches', $cdv_batches);

        /*
        return $batchDataTable->render('hasob-foundation-core::pages.batches.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Batch.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('hasob-foundation-core::pages.batches.create');
    }

    /**
     * Store a newly created Batch in storage.
     *
     * @param CreateBatchRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateBatchRequest $request)
    {
        $input = $request->all();

        /** @var Batch $batch */
        $batch = Batch::create($input);

        //Flash::success('Batch saved successfully.');

        BatchCreated::dispatch($batch);
        return redirect(route('fc.batches.index'));
    }

    /**
     * Display the specified Batch.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Batch $batch */
        $batch = Batch::find($id);

        if (empty($batch)) {
            //Flash::error('Batch not found');

            return redirect(route('fc.batches.index'));
        }

        return view('hasob-foundation-core::pages.batches.show')->with('batch', $batch);
    }

    /**
     * Show the form for editing the specified Batch.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Batch $batch */
        $batch = Batch::find($id);

        if (empty($batch)) {
            //Flash::error('Batch not found');

            return redirect(route('fc.batches.index'));
        }

        return view('hasob-foundation-core::pages.batches.edit')->with('batch', $batch);
    }

    /**
     * Update the specified Batch in storage.
     *
     * @param  int              $id
     * @param UpdateBatchRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateBatchRequest $request)
    {
        /** @var Batch $batch */
        $batch = Batch::find($id);

        if (empty($batch)) {
            //Flash::error('Batch not found');

            return redirect(route('fc.batches.index'));
        }

        $batch->fill($request->all());
        $batch->save();

        //Flash::success('Batch updated successfully.');
        
        BatchUpdated::dispatch($batch);
        return redirect(route('fc.batches.index'));
    }

    /**
     * Remove the specified Batch from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Batch $batch */
        $batch = Batch::find($id);

        if (empty($batch)) {
            //Flash::error('Batch not found');

            return redirect(route('fc.batches.index'));
        }

        $batch->delete();

        //Flash::success('Batch deleted successfully.');
        BatchDeleted::dispatch($batch);
        return redirect(route('fc.batches.index'));
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
