<?php

namespace Hasob\FoundationCore\Controllers;

use Hasob\FoundationCore\Models\BatchItem;

use Hasob\FoundationCore\Events\BatchItemCreated;
use Hasob\FoundationCore\Events\BatchItemUpdated;
use Hasob\FoundationCore\Events\BatchItemDeleted;

use Hasob\FoundationCore\Requests\CreateBatchItemRequest;
use Hasob\FoundationCore\Requests\UpdateBatchItemRequest;

use Hasob\FoundationCore\DataTables\BatchItemDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BatchItemController extends BaseController
{
    /**
     * Display a listing of the BatchItem.
     *
     * @param BatchItemDataTable $batchItemDataTable
     * @return Response
     */
    public function index(Organization $org, BatchItemDataTable $batchItemDataTable)
    {
        $current_user = Auth()->user();

        $cdv_batch_items = new \Hasob\FoundationCore\View\Components\CardDataView(BatchItem::class, "hasob-foundation-core::pages.batch_items.card_view_item");
        $cdv_batch_items->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search BatchItem');

        if (request()->expectsJson()){
            return $cdv_batch_items->render();
        }

        return view('hasob-foundation-core::pages.batch_items.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_batch_items', $cdv_batch_items);

        /*
        return $batchItemDataTable->render('hasob-foundation-core::pages.batch_items.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new BatchItem.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('hasob-foundation-core::pages.batch_items.create');
    }

    /**
     * Store a newly created BatchItem in storage.
     *
     * @param CreateBatchItemRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateBatchItemRequest $request)
    {
        $input = $request->all();

        /** @var BatchItem $batchItem */
        $batchItem = BatchItem::create($input);

        //Flash::success('Batch Item saved successfully.');

        BatchItemCreated::dispatch($batchItem);
        return redirect(route('fc.batchItems.index'));
    }

    /**
     * Display the specified BatchItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var BatchItem $batchItem */
        $batchItem = BatchItem::find($id);

        if (empty($batchItem)) {
            //Flash::error('Batch Item not found');

            return redirect(route('fc.batchItems.index'));
        }

        return view('hasob-foundation-core::pages.batch_items.show')->with('batchItem', $batchItem);
    }

    /**
     * Show the form for editing the specified BatchItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var BatchItem $batchItem */
        $batchItem = BatchItem::find($id);

        if (empty($batchItem)) {
            //Flash::error('Batch Item not found');

            return redirect(route('fc.batchItems.index'));
        }

        return view('hasob-foundation-core::pages.batch_items.edit')->with('batchItem', $batchItem);
    }

    /**
     * Update the specified BatchItem in storage.
     *
     * @param  int              $id
     * @param UpdateBatchItemRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateBatchItemRequest $request)
    {
        /** @var BatchItem $batchItem */
        $batchItem = BatchItem::find($id);

        if (empty($batchItem)) {
            //Flash::error('Batch Item not found');

            return redirect(route('fc.batchItems.index'));
        }

        $batchItem->fill($request->all());
        $batchItem->save();

        //Flash::success('Batch Item updated successfully.');
        
        BatchItemUpdated::dispatch($batchItem);
        return redirect(route('fc.batchItems.index'));
    }

    /**
     * Remove the specified BatchItem from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var BatchItem $batchItem */
        $batchItem = BatchItem::find($id);

        if (empty($batchItem)) {
            //Flash::error('Batch Item not found');

            return redirect(route('fc.batchItems.index'));
        }

        $batchItem->delete();

        //Flash::success('Batch Item deleted successfully.');
        BatchItemDeleted::dispatch($batchItem);
        return redirect(route('fc.batchItems.index'));
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
