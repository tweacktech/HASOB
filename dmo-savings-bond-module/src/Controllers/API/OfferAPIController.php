<?php

namespace DMO\SavingsBond\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DMO\SavingsBond\Models\Offer;

use DMO\SavingsBond\Events\OfferCreated;
use DMO\SavingsBond\Events\OfferUpdated;
use DMO\SavingsBond\Events\OfferDeleted;

use DMO\SavingsBond\Requests\API\CreateOfferAPIRequest;
use DMO\SavingsBond\Requests\API\UpdateOfferAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class OfferController
 * @package DMO\SavingsBond\Controllers\API
 */

class OfferAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the Offer.
     * GET|HEAD /offers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Offer::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $offers = $this->showAll($query->get());

        return $this->sendResponse($offers->toArray(), 'Offers retrieved successfully');
    }

    /**
     * Store a newly created Offer in storage.
     * POST /offers
     *
     * @param CreateOfferAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Offer $offer */
        $offer = Offer::create($input);
        
        OfferCreated::dispatch($offer);
        return $this->sendResponse($offer->toArray(), 'Offer saved successfully');
    }

    /**
     * Display the specified Offer.
     * GET|HEAD /offers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Offer $offer */
        $offer = Offer::find($id);

        if (empty($offer)) {
            return $this->sendError('Offer not found');
        }

        return $this->sendResponse($offer->toArray(), 'Offer retrieved successfully');
    }

    /**
     * Update the specified Offer in storage.
     * PUT/PATCH /offers/{id}
     *
     * @param int $id
     * @param UpdateOfferAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferAPIRequest $request, Organization $organization)
    {
        /** @var Offer $offer */
        $offer = Offer::find($id);

        if (empty($offer)) {
            return $this->sendError('Offer not found');
        }

        $offer->fill($request->all());
        $offer->save();
        
        OfferUpdated::dispatch($offer);
        return $this->sendResponse($offer->toArray(), 'Offer updated successfully');
    }

    /**
     * Remove the specified Offer from storage.
     * DELETE /offers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Offer $offer */
        $offer = Offer::find($id);

        if (empty($offer)) {
            return $this->sendError('Offer not found');
        }

        $offer->delete();
        OfferDeleted::dispatch($offer);
        return $this->sendSuccess('Offer deleted successfully');
    }
}
