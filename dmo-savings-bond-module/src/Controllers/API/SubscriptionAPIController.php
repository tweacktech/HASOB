<?php

namespace DMO\SavingsBond\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DMO\SavingsBond\Models\Subscription;

use DMO\SavingsBond\Events\SubscriptionCreated;
use DMO\SavingsBond\Events\SubscriptionUpdated;
use DMO\SavingsBond\Events\SubscriptionDeleted;

use DMO\SavingsBond\Requests\API\CreateSubscriptionAPIRequest;
use DMO\SavingsBond\Requests\API\UpdateSubscriptionAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class SubscriptionController
 * @package DMO\SavingsBond\Controllers\API
 */

class SubscriptionAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the Subscription.
     * GET|HEAD /subscriptions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Subscription::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $subscriptions = $this->showAll($query->get());

        return $this->sendResponse($subscriptions->toArray(), 'Subscriptions retrieved successfully');
    }

    /**
     * Store a newly created Subscription in storage.
     * POST /subscriptions
     *
     * @param CreateSubscriptionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscriptionAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Subscription $subscription */
        $subscription = Subscription::create($input);
        
        SubscriptionCreated::dispatch($subscription);
        return $this->sendResponse($subscription->toArray(), 'Subscription saved successfully');
    }

    /**
     * Display the specified Subscription.
     * GET|HEAD /subscriptions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::find($id);

        if (empty($subscription)) {
            return $this->sendError('Subscription not found');
        }

        return $this->sendResponse($subscription->toArray(), 'Subscription retrieved successfully');
    }

    /**
     * Update the specified Subscription in storage.
     * PUT/PATCH /subscriptions/{id}
     *
     * @param int $id
     * @param UpdateSubscriptionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubscriptionAPIRequest $request, Organization $organization)
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::find($id);

        if (empty($subscription)) {
            return $this->sendError('Subscription not found');
        }

        $subscription->fill($request->all());
        $subscription->save();
        
        SubscriptionUpdated::dispatch($subscription);
        return $this->sendResponse($subscription->toArray(), 'Subscription updated successfully');
    }

    /**
     * Remove the specified Subscription from storage.
     * DELETE /subscriptions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::find($id);

        if (empty($subscription)) {
            return $this->sendError('Subscription not found');
        }

        $subscription->delete();
        SubscriptionDeleted::dispatch($subscription);
        return $this->sendSuccess('Subscription deleted successfully');
    }
}
