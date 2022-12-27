<?php

namespace DMO\SavingsBond\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DMO\SavingsBond\Models\Bid;

use DMO\SavingsBond\Events\BidCreated;
use DMO\SavingsBond\Events\BidUpdated;
use DMO\SavingsBond\Events\BidDeleted;

use DMO\SavingsBond\Requests\API\CreateBidAPIRequest;
use DMO\SavingsBond\Requests\API\UpdateBidAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class BidController
 * @package DMO\SavingsBond\Controllers\API
 */

class BidAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the Bid.
     * GET|HEAD /bids
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Bid::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $bids = $this->showAll($query->get());

        return $this->sendResponse($bids->toArray(), 'Bids retrieved successfully');
    }

    /**
     * Store a newly created Bid in storage.
     * POST /bids
     *
     * @param CreateBidAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBidAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Bid $bid */
        $bid = Bid::create($input);
        
        BidCreated::dispatch($bid);
        return $this->sendResponse($bid->toArray(), 'Bid saved successfully');
    }

    /**
     * Display the specified Bid.
     * GET|HEAD /bids/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Bid $bid */
        $bid = Bid::find($id);

        if (empty($bid)) {
            return $this->sendError('Bid not found');
        }

        return $this->sendResponse($bid->toArray(), 'Bid retrieved successfully');
    }

    /**
     * Update the specified Bid in storage.
     * PUT/PATCH /bids/{id}
     *
     * @param int $id
     * @param UpdateBidAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBidAPIRequest $request, Organization $organization)
    {
        /** @var Bid $bid */
        $bid = Bid::find($id);

        if (empty($bid)) {
            return $this->sendError('Bid not found');
        }

        $bid->fill($request->all());
        $bid->save();
        
        BidUpdated::dispatch($bid);
        return $this->sendResponse($bid->toArray(), 'Bid updated successfully');
    }

    /**
     * Remove the specified Bid from storage.
     * DELETE /bids/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Bid $bid */
        $bid = Bid::find($id);

        if (empty($bid)) {
            return $this->sendError('Bid not found');
        }

        $bid->delete();
        BidDeleted::dispatch($bid);
        return $this->sendSuccess('Bid deleted successfully');
    }
}
