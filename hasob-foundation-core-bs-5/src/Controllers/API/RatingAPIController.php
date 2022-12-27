<?php

namespace Hasob\FoundationCore\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hasob\FoundationCore\Models\Rating;

use Hasob\FoundationCore\Events\RatingCreated;
use Hasob\FoundationCore\Events\RatingUpdated;
use Hasob\FoundationCore\Events\RatingDeleted;

use Hasob\FoundationCore\Requests\API\CreateRatingAPIRequest;
use Hasob\FoundationCore\Requests\API\UpdateRatingAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class RatingController
 * @package Hasob\FoundationCore\Controllers\API
 */

class RatingAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the Rating.
     * GET|HEAD /ratings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Rating::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $ratings = $this->showAll($query->get());

        return $this->sendResponse($ratings->toArray(), 'Ratings retrieved successfully');
    }

    /**
     * Store a newly created Rating in storage.
     * POST /ratings
     *
     * @param CreateRatingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRatingAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Rating $rating */
        $rating = Rating::create($input);
        
        RatingCreated::dispatch($rating);
        return $this->sendResponse($rating->toArray(), 'Rating saved successfully');
    }

    /**
     * Display the specified Rating.
     * GET|HEAD /ratings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Rating $rating */
        $rating = Rating::find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        return $this->sendResponse($rating->toArray(), 'Rating retrieved successfully');
    }

    /**
     * Update the specified Rating in storage.
     * PUT/PATCH /ratings/{id}
     *
     * @param int $id
     * @param UpdateRatingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRatingAPIRequest $request, Organization $organization)
    {
        /** @var Rating $rating */
        $rating = Rating::find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating->fill($request->all());
        $rating->save();
        
        RatingUpdated::dispatch($rating);
        return $this->sendResponse($rating->toArray(), 'Rating updated successfully');
    }

    /**
     * Remove the specified Rating from storage.
     * DELETE /ratings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Rating $rating */
        $rating = Rating::find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating->delete();
        RatingDeleted::dispatch($rating);
        return $this->sendSuccess('Rating deleted successfully');
    }
}
