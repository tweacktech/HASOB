<?php

namespace Hasob\FoundationCore\Controllers;

use Hasob\FoundationCore\Models\Rating;

use Hasob\FoundationCore\Events\RatingCreated;
use Hasob\FoundationCore\Events\RatingUpdated;
use Hasob\FoundationCore\Events\RatingDeleted;

use Hasob\FoundationCore\Requests\CreateRatingRequest;
use Hasob\FoundationCore\Requests\UpdateRatingRequest;

use Hasob\FoundationCore\DataTables\RatingDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class RatingController extends BaseController
{
    /**
     * Display a listing of the Rating.
     *
     * @param RatingDataTable $ratingDataTable
     * @return Response
     */
    public function index(Organization $org, RatingDataTable $ratingDataTable)
    {
        $current_user = Auth()->user();

        $cdv_ratings = new \Hasob\FoundationCore\View\Components\CardDataView(Rating::class, "hasob-foundation-core::pages.ratings.card_view_item");
        $cdv_ratings->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Rating');

        if (request()->expectsJson()){
            return $cdv_ratings->render();
        }

        return view('hasob-foundation-core::pages.ratings.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_ratings', $cdv_ratings);

        /*
        return $ratingDataTable->render('hasob-foundation-core::pages.ratings.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Rating.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('hasob-foundation-core::pages.ratings.create');
    }

    /**
     * Store a newly created Rating in storage.
     *
     * @param CreateRatingRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateRatingRequest $request)
    {
        $input = $request->all();

        /** @var Rating $rating */
        $rating = Rating::create($input);

        //Flash::success('Rating saved successfully.');

        RatingCreated::dispatch($rating);
        return redirect(route('fc.ratings.index'));
    }

    /**
     * Display the specified Rating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Rating $rating */
        $rating = Rating::find($id);

        if (empty($rating)) {
            //Flash::error('Rating not found');

            return redirect(route('fc.ratings.index'));
        }

        return view('hasob-foundation-core::pages.ratings.show')->with('rating', $rating);
    }

    /**
     * Show the form for editing the specified Rating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Rating $rating */
        $rating = Rating::find($id);

        if (empty($rating)) {
            //Flash::error('Rating not found');

            return redirect(route('fc.ratings.index'));
        }

        return view('hasob-foundation-core::pages.ratings.edit')->with('rating', $rating);
    }

    /**
     * Update the specified Rating in storage.
     *
     * @param  int              $id
     * @param UpdateRatingRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateRatingRequest $request)
    {
        /** @var Rating $rating */
        $rating = Rating::find($id);

        if (empty($rating)) {
            //Flash::error('Rating not found');

            return redirect(route('fc.ratings.index'));
        }

        $rating->fill($request->all());
        $rating->save();

        //Flash::success('Rating updated successfully.');
        
        RatingUpdated::dispatch($rating);
        return redirect(route('fc.ratings.index'));
    }

    /**
     * Remove the specified Rating from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Rating $rating */
        $rating = Rating::find($id);

        if (empty($rating)) {
            //Flash::error('Rating not found');

            return redirect(route('fc.ratings.index'));
        }

        $rating->delete();

        //Flash::success('Rating deleted successfully.');
        RatingDeleted::dispatch($rating);
        return redirect(route('fc.ratings.index'));
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
