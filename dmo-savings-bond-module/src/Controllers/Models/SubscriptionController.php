<?php

namespace DMO\SavingsBond\Controllers\Models;

use DMO\SavingsBond\Models\Subscription;

use DMO\SavingsBond\Events\SubscriptionCreated;
use DMO\SavingsBond\Events\SubscriptionUpdated;
use DMO\SavingsBond\Events\SubscriptionDeleted;

use DMO\SavingsBond\Requests\CreateSubscriptionRequest;
use DMO\SavingsBond\Requests\UpdateSubscriptionRequest;

use DMO\SavingsBond\DataTables\SubscriptionDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SubscriptionController extends BaseController
{
    /**
     * Display a listing of the Subscription.
     *
     * @param SubscriptionDataTable $subscriptionDataTable
     * @return Response
     */
    public function index(Organization $org, SubscriptionDataTable $subscriptionDataTable)
    {
        $current_user = Auth()->user();

        $cdv_subscriptions = new \Hasob\FoundationCore\View\Components\CardDataView(Subscription::class, "dmo-savings-bond-module::pages.subscriptions.card_view_item");
        $cdv_subscriptions->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Subscription');

        if (request()->expectsJson()){
            return $cdv_subscriptions->render();
        }

        return view('dmo-savings-bond-module::pages.subscriptions.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_subscriptions', $cdv_subscriptions);

        /*
        return $subscriptionDataTable->render('dmo-savings-bond-module::pages.subscriptions.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Subscription.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('dmo-savings-bond-module::pages.subscriptions.create');
    }

    /**
     * Store a newly created Subscription in storage.
     *
     * @param CreateSubscriptionRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateSubscriptionRequest $request)
    {
        $input = $request->all();

        /** @var Subscription $subscription */
        $subscription = Subscription::create($input);

        //Flash::success('Subscription saved successfully.');

        SubscriptionCreated::dispatch($subscription);
        return redirect(route('sb.subscriptions.index'));
    }

    /**
     * Display the specified Subscription.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::find($id);

        if (empty($subscription)) {
            //Flash::error('Subscription not found');

            return redirect(route('sb.subscriptions.index'));
        }

        return view('dmo-savings-bond-module::pages.subscriptions.show')->with('subscription', $subscription);
    }

    /**
     * Show the form for editing the specified Subscription.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::find($id);

        if (empty($subscription)) {
            //Flash::error('Subscription not found');

            return redirect(route('sb.subscriptions.index'));
        }

        return view('dmo-savings-bond-module::pages.subscriptions.edit')->with('subscription', $subscription);
    }

    /**
     * Update the specified Subscription in storage.
     *
     * @param  int              $id
     * @param UpdateSubscriptionRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateSubscriptionRequest $request)
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::find($id);

        if (empty($subscription)) {
            //Flash::error('Subscription not found');

            return redirect(route('sb.subscriptions.index'));
        }

        $subscription->fill($request->all());
        $subscription->save();

        //Flash::success('Subscription updated successfully.');
        
        SubscriptionUpdated::dispatch($subscription);
        return redirect(route('sb.subscriptions.index'));
    }

    /**
     * Remove the specified Subscription from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::find($id);

        if (empty($subscription)) {
            //Flash::error('Subscription not found');

            return redirect(route('sb.subscriptions.index'));
        }

        $subscription->delete();

        //Flash::success('Subscription deleted successfully.');
        SubscriptionDeleted::dispatch($subscription);
        return redirect(route('sb.subscriptions.index'));
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
