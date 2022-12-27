<?php

namespace Hasob\FoundationCore\Controllers;

use Hasob\FoundationCore\Models\PaymentDetail;

use Hasob\FoundationCore\Events\PaymentDetailCreated;
use Hasob\FoundationCore\Events\PaymentDetailUpdated;
use Hasob\FoundationCore\Events\PaymentDetailDeleted;

use Hasob\FoundationCore\Requests\CreatePaymentDetailRequest;
use Hasob\FoundationCore\Requests\UpdatePaymentDetailRequest;

use Hasob\FoundationCore\DataTables\PaymentDetailDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PaymentDetailController extends BaseController
{
    /**
     * Display a listing of the PaymentDetail.
     *
     * @param PaymentDetailDataTable $paymentDetailDataTable
     * @return Response
     */
    public function index(Organization $org, PaymentDetailDataTable $paymentDetailDataTable)
    {
        $current_user = Auth()->user();

        $cdv_payment_details = new \Hasob\FoundationCore\View\Components\CardDataView(PaymentDetail::class, "hasob-foundation-core::pages.payment_details.card_view_item");
        $cdv_payment_details->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search PaymentDetail');

        if (request()->expectsJson()){
            return $cdv_payment_details->render();
        }

        return view('hasob-foundation-core::pages.payment_details.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_payment_details', $cdv_payment_details);

        /*
        return $paymentDetailDataTable->render('hasob-foundation-core::pages.payment_details.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new PaymentDetail.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('hasob-foundation-core::pages.payment_details.create');
    }

    /**
     * Store a newly created PaymentDetail in storage.
     *
     * @param CreatePaymentDetailRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreatePaymentDetailRequest $request)
    {
        $input = $request->all();

        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = PaymentDetail::create($input);

        //Flash::success('Payment Detail saved successfully.');

        PaymentDetailCreated::dispatch($paymentDetail);
        return redirect(route('fc.paymentDetails.index'));
    }

    /**
     * Display the specified PaymentDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = PaymentDetail::find($id);

        if (empty($paymentDetail)) {
            //Flash::error('Payment Detail not found');

            return redirect(route('fc.paymentDetails.index'));
        }

        return view('hasob-foundation-core::pages.payment_details.show')->with('paymentDetail', $paymentDetail);
    }

    /**
     * Show the form for editing the specified PaymentDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = PaymentDetail::find($id);

        if (empty($paymentDetail)) {
            //Flash::error('Payment Detail not found');

            return redirect(route('fc.paymentDetails.index'));
        }

        return view('hasob-foundation-core::pages.payment_details.edit')->with('paymentDetail', $paymentDetail);
    }

    /**
     * Update the specified PaymentDetail in storage.
     *
     * @param  int              $id
     * @param UpdatePaymentDetailRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdatePaymentDetailRequest $request)
    {
        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = PaymentDetail::find($id);

        if (empty($paymentDetail)) {
            //Flash::error('Payment Detail not found');

            return redirect(route('fc.paymentDetails.index'));
        }

        $paymentDetail->fill($request->all());
        $paymentDetail->save();

        //Flash::success('Payment Detail updated successfully.');
        
        PaymentDetailUpdated::dispatch($paymentDetail);
        return redirect(route('fc.paymentDetails.index'));
    }

    /**
     * Remove the specified PaymentDetail from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = PaymentDetail::find($id);

        if (empty($paymentDetail)) {
            //Flash::error('Payment Detail not found');

            return redirect(route('fc.paymentDetails.index'));
        }

        $paymentDetail->delete();

        //Flash::success('Payment Detail deleted successfully.');
        PaymentDetailDeleted::dispatch($paymentDetail);
        return redirect(route('fc.paymentDetails.index'));
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
