<?php

namespace Hasob\FoundationCore\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hasob\FoundationCore\Models\PaymentDetail;

use Hasob\FoundationCore\Events\PaymentDetailCreated;
use Hasob\FoundationCore\Events\PaymentDetailUpdated;
use Hasob\FoundationCore\Events\PaymentDetailDeleted;

use Hasob\FoundationCore\Requests\API\CreatePaymentDetailAPIRequest;
use Hasob\FoundationCore\Requests\API\UpdatePaymentDetailAPIRequest;

use Hasob\FoundationCore\Traits\ApiResponder;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Controllers\BaseController as AppBaseController;

/**
 * Class PaymentDetailController
 * @package Hasob\FoundationCore\Controllers\API
 */

class PaymentDetailAPIController extends AppBaseController
{

    use ApiResponder;

    /**
     * Display a listing of the PaymentDetail.
     * GET|HEAD /paymentDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = PaymentDetail::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $paymentDetails = $this->showAll($query->get());

        return $this->sendResponse($paymentDetails->toArray(), 'Payment Details retrieved successfully');
    }

    /**
     * Store a newly created PaymentDetail in storage.
     * POST /paymentDetails
     *
     * @param CreatePaymentDetailAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentDetailAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = PaymentDetail::create($input);
        
        PaymentDetailCreated::dispatch($paymentDetail);
        return $this->sendResponse($paymentDetail->toArray(), 'Payment Detail saved successfully');
    }

    /**
     * Display the specified PaymentDetail.
     * GET|HEAD /paymentDetails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = PaymentDetail::find($id);

        if (empty($paymentDetail)) {
            return $this->sendError('Payment Detail not found');
        }

        return $this->sendResponse($paymentDetail->toArray(), 'Payment Detail retrieved successfully');
    }

    /**
     * Update the specified PaymentDetail in storage.
     * PUT/PATCH /paymentDetails/{id}
     *
     * @param int $id
     * @param UpdatePaymentDetailAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentDetailAPIRequest $request, Organization $organization)
    {
        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = PaymentDetail::find($id);

        if (empty($paymentDetail)) {
            return $this->sendError('Payment Detail not found');
        }

        $paymentDetail->fill($request->all());
        $paymentDetail->save();
        
        PaymentDetailUpdated::dispatch($paymentDetail);
        return $this->sendResponse($paymentDetail->toArray(), 'PaymentDetail updated successfully');
    }

    /**
     * Remove the specified PaymentDetail from storage.
     * DELETE /paymentDetails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = PaymentDetail::find($id);

        if (empty($paymentDetail)) {
            return $this->sendError('Payment Detail not found');
        }

        $paymentDetail->delete();
        PaymentDetailDeleted::dispatch($paymentDetail);
        return $this->sendSuccess('Payment Detail deleted successfully');
    }
}
