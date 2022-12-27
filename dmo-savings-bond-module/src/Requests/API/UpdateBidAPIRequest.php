<?php

namespace DMO\SavingsBond\Requests\API;

use DMO\SavingsBond\Models\Bid;
use DMO\SavingsBond\Requests\AppBaseFormRequest;


class UpdateBidAPIRequest extends AppBaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*
        
        */
        return [
            'organization_id' => 'required',
        'display_ordinal' => 'nullable|min:0|max:365',
        'offer_id' => 'required',
        'user_id' => 'required',
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'units_requested' => 'nullable|min:0|max:365',
        'price_per_unit' => 'required|min:0|max:100000000',
        'total_price' => 'required|min:0|max:100000000'
        ];
    }

    /**
    * @OA\Property(
    *     title="organization_id",
    *     description="organization_id",
    *     type="string"
    * )
    */
    public $organization_id;

    /**
    * @OA\Property(
    *     title="display_ordinal",
    *     description="display_ordinal",
    *     type="integer"
    * )
    */
    public $display_ordinal;

    /**
    * @OA\Property(
    *     title="offer_id",
    *     description="offer_id",
    *     type="string"
    * )
    */
    public $offer_id;

    /**
    * @OA\Property(
    *     title="user_id",
    *     description="user_id",
    *     type="string"
    * )
    */
    public $user_id;

    /**
    * @OA\Property(
    *     title="status",
    *     description="status",
    *     type="string"
    * )
    */
    public $status;

    /**
    * @OA\Property(
    *     title="wf_status",
    *     description="wf_status",
    *     type="string"
    * )
    */
    public $wf_status;

    /**
    * @OA\Property(
    *     title="wf_meta_data",
    *     description="wf_meta_data",
    *     type="string"
    * )
    */
    public $wf_meta_data;

    /**
    * @OA\Property(
    *     title="units_requested",
    *     description="units_requested",
    *     type="integer"
    * )
    */
    public $units_requested;

    /**
    * @OA\Property(
    *     title="price_per_unit",
    *     description="price_per_unit",
    *     type="number"
    * )
    */
    public $price_per_unit;

    /**
    * @OA\Property(
    *     title="total_price",
    *     description="total_price",
    *     type="number"
    * )
    */
    public $total_price;


}
