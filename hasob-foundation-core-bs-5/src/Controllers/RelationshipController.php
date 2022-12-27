<?php

namespace Hasob\FoundationCore\Controllers;

use Hasob\FoundationCore\Models\Relationship;

use Hasob\FoundationCore\Events\RelationshipCreated;
use Hasob\FoundationCore\Events\RelationshipUpdated;
use Hasob\FoundationCore\Events\RelationshipDeleted;

use Hasob\FoundationCore\Requests\CreateRelationshipRequest;
use Hasob\FoundationCore\Requests\UpdateRelationshipRequest;

use Hasob\FoundationCore\DataTables\RelationshipDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class RelationshipController extends BaseController
{
    /**
     * Display a listing of the Relationship.
     *
     * @param RelationshipDataTable $relationshipDataTable
     * @return Response
     */
    public function index(Organization $org, RelationshipDataTable $relationshipDataTable)
    {
        $current_user = Auth()->user();

        $cdv_relationships = new \Hasob\FoundationCore\View\Components\CardDataView(Relationship::class, "hasob-foundation-core::pages.relationships.card_view_item");
        $cdv_relationships->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Relationship');

        if (request()->expectsJson()){
            return $cdv_relationships->render();
        }

        return view('hasob-foundation-core::pages.relationships.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_relationships', $cdv_relationships);

        /*
        return $relationshipDataTable->render('hasob-foundation-core::pages.relationships.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Relationship.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('hasob-foundation-core::pages.relationships.create');
    }

    /**
     * Store a newly created Relationship in storage.
     *
     * @param CreateRelationshipRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateRelationshipRequest $request)
    {
        $input = $request->all();

        /** @var Relationship $relationship */
        $relationship = Relationship::create($input);

        //Flash::success('Relationship saved successfully.');

        RelationshipCreated::dispatch($relationship);
        return redirect(route('fc.relationships.index'));
    }

    /**
     * Display the specified Relationship.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Relationship $relationship */
        $relationship = Relationship::find($id);

        if (empty($relationship)) {
            //Flash::error('Relationship not found');

            return redirect(route('fc.relationships.index'));
        }

        return view('hasob-foundation-core::pages.relationships.show')->with('relationship', $relationship);
    }

    /**
     * Show the form for editing the specified Relationship.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Relationship $relationship */
        $relationship = Relationship::find($id);

        if (empty($relationship)) {
            //Flash::error('Relationship not found');

            return redirect(route('fc.relationships.index'));
        }

        return view('hasob-foundation-core::pages.relationships.edit')->with('relationship', $relationship);
    }

    /**
     * Update the specified Relationship in storage.
     *
     * @param  int              $id
     * @param UpdateRelationshipRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateRelationshipRequest $request)
    {
        /** @var Relationship $relationship */
        $relationship = Relationship::find($id);

        if (empty($relationship)) {
            //Flash::error('Relationship not found');

            return redirect(route('fc.relationships.index'));
        }

        $relationship->fill($request->all());
        $relationship->save();

        //Flash::success('Relationship updated successfully.');
        
        RelationshipUpdated::dispatch($relationship);
        return redirect(route('fc.relationships.index'));
    }

    /**
     * Remove the specified Relationship from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Relationship $relationship */
        $relationship = Relationship::find($id);

        if (empty($relationship)) {
            //Flash::error('Relationship not found');

            return redirect(route('fc.relationships.index'));
        }

        $relationship->delete();

        //Flash::success('Relationship deleted successfully.');
        RelationshipDeleted::dispatch($relationship);
        return redirect(route('fc.relationships.index'));
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
