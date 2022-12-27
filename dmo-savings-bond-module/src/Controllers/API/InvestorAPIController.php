<?php

namespace DMO\SavingsBond\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DMO\SavingsBond\Models\Investor;

use DMO\SavingsBond\Events\InvestorCreated;
use DMO\SavingsBond\Events\InvestorUpdated;
use DMO\SavingsBond\Events\InvestorDeleted;

use DMO\SavingsBond\Requests\API\CreateInvestorAPIRequest;
use DMO\SavingsBond\Requests\API\UpdateInvestorAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class InvestorController
 * @package DMO\SavingsBond\Controllers\API
 */

class InvestorAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the Investor.
     * GET|HEAD /investors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Investor::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $investors = $this->showAll($query->get());

        return $this->sendResponse($investors->toArray(), 'Investors retrieved successfully');
    }

    /**
     * Store a newly created Investor in storage.
     * POST /investors
     *
     * @param CreateInvestorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInvestorAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Investor $investor */
        $investor = Investor::create($input);
        
        InvestorCreated::dispatch($investor);
        return $this->sendResponse($investor->toArray(), 'Investor saved successfully');
    }

    /**
     * Display the specified Investor.
     * GET|HEAD /investors/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Investor $investor */
        $investor = Investor::find($id);

        if (empty($investor)) {
            return $this->sendError('Investor not found');
        }

        return $this->sendResponse($investor->toArray(), 'Investor retrieved successfully');
    }

    /**
     * Update the specified Investor in storage.
     * PUT/PATCH /investors/{id}
     *
     * @param int $id
     * @param UpdateInvestorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvestorAPIRequest $request, Organization $organization)
    {
        /** @var Investor $investor */
        $investor = Investor::find($id);

        if (empty($investor)) {
            return $this->sendError('Investor not found');
        }

        $investor->fill($request->all());
        $investor->save();
        
        InvestorUpdated::dispatch($investor);
        return $this->sendResponse($investor->toArray(), 'Investor updated successfully');
    }

    /**
     * Remove the specified Investor from storage.
     * DELETE /investors/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Investor $investor */
        $investor = Investor::find($id);

        if (empty($investor)) {
            return $this->sendError('Investor not found');
        }

        $investor->delete();
        InvestorDeleted::dispatch($investor);
        return $this->sendSuccess('Investor deleted successfully');
    }
}
