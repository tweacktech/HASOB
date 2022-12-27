<?php

namespace DMO\SavingsBond\Requests\API;

use DMO\SavingsBond\Models\Subscription;
use DMO\SavingsBond\Requests\AppBaseFormRequest;


class UpdateSubscriptionAPIRequest extends AppBaseFormRequest
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
        'broker_id' => 'required',
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'units_requested' => 'nullable|min:0|max:365',
        'price_per_unit' => 'required|min:0|max:100000000',
        'total_price' => 'required|min:0|max:100000000',
        'interest_rate_pct' => 'required|min:0|max:100',
        'offer_start_date' => 'required',
        'offer_end_date' => 'required',
        'offer_settlement_date' => 'required',
        'offer_maturity_date' => 'required',
        'investor_email' => 'required|email',
        'first_name' => 'required',
        'middle_name' => 'required',
        'last_name' => 'required',
        'origin_geo_zone' => 'nullable|length:100',
        'origin_lga' => 'nullable|length:100',
        'address_street' => 'nullable|length:200',
        'address_town' => 'nullable|length:200',
        'address_state' => 'nullable|length:200',
        'bank_account_name' => 'nullable|min:2|max:100',
        'bank_account_number' => 'nullable|length:10',
        'bank_name' => 'nullable|length:100',
        'bank_verification_number' => 'nullable|length:100',
        'national_id_number' => 'nullable|length:100',
        'cscs_id_number' => 'nullable|length:100',
        'chn_id_number' => 'nullable|length:100'
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
    *     title="broker_id",
    *     description="broker_id",
    *     type="string"
    * )
    */
    public $broker_id;

    /**
    * @OA\Property(
    *     title="broker_code",
    *     description="broker_code",
    *     type="string"
    * )
    */
    public $broker_code;

    /**
    * @OA\Property(
    *     title="broker_name",
    *     description="broker_name",
    *     type="string"
    * )
    */
    public $broker_name;

    /**
    * @OA\Property(
    *     title="is_broker_created",
    *     description="is_broker_created",
    *     type="boolean"
    * )
    */
    public $is_broker_created;

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

    /**
    * @OA\Property(
    *     title="interest_rate_pct",
    *     description="interest_rate_pct",
    *     type="number"
    * )
    */
    public $interest_rate_pct;

    /**
    * @OA\Property(
    *     title="offer_start_date",
    *     description="offer_start_date",
    *     type="string"
    * )
    */
    public $offer_start_date;

    /**
    * @OA\Property(
    *     title="offer_end_date",
    *     description="offer_end_date",
    *     type="string"
    * )
    */
    public $offer_end_date;

    /**
    * @OA\Property(
    *     title="offer_settlement_date",
    *     description="offer_settlement_date",
    *     type="string"
    * )
    */
    public $offer_settlement_date;

    /**
    * @OA\Property(
    *     title="offer_maturity_date",
    *     description="offer_maturity_date",
    *     type="string"
    * )
    */
    public $offer_maturity_date;

    /**
    * @OA\Property(
    *     title="tenor_years",
    *     description="tenor_years",
    *     type="integer"
    * )
    */
    public $tenor_years;

    /**
    * @OA\Property(
    *     title="investor_email",
    *     description="investor_email",
    *     type="string"
    * )
    */
    public $investor_email;

    /**
    * @OA\Property(
    *     title="investor_telephone",
    *     description="investor_telephone",
    *     type="string"
    * )
    */
    public $investor_telephone;

    /**
    * @OA\Property(
    *     title="first_name",
    *     description="first_name",
    *     type="string"
    * )
    */
    public $first_name;

    /**
    * @OA\Property(
    *     title="middle_name",
    *     description="middle_name",
    *     type="string"
    * )
    */
    public $middle_name;

    /**
    * @OA\Property(
    *     title="last_name",
    *     description="last_name",
    *     type="string"
    * )
    */
    public $last_name;

    /**
    * @OA\Property(
    *     title="date_of_birth",
    *     description="date_of_birth",
    *     type="string"
    * )
    */
    public $date_of_birth;

    /**
    * @OA\Property(
    *     title="origin_geo_zone",
    *     description="origin_geo_zone",
    *     type="string"
    * )
    */
    public $origin_geo_zone;

    /**
    * @OA\Property(
    *     title="origin_lga",
    *     description="origin_lga",
    *     type="string"
    * )
    */
    public $origin_lga;

    /**
    * @OA\Property(
    *     title="address_street",
    *     description="address_street",
    *     type="string"
    * )
    */
    public $address_street;

    /**
    * @OA\Property(
    *     title="address_town",
    *     description="address_town",
    *     type="string"
    * )
    */
    public $address_town;

    /**
    * @OA\Property(
    *     title="address_state",
    *     description="address_state",
    *     type="string"
    * )
    */
    public $address_state;

    /**
    * @OA\Property(
    *     title="bank_account_name",
    *     description="bank_account_name",
    *     type="string"
    * )
    */
    public $bank_account_name;

    /**
    * @OA\Property(
    *     title="bank_account_number",
    *     description="bank_account_number",
    *     type="string"
    * )
    */
    public $bank_account_number;

    /**
    * @OA\Property(
    *     title="bank_name",
    *     description="bank_name",
    *     type="string"
    * )
    */
    public $bank_name;

    /**
    * @OA\Property(
    *     title="bank_verification_number",
    *     description="bank_verification_number",
    *     type="string"
    * )
    */
    public $bank_verification_number;

    /**
    * @OA\Property(
    *     title="national_id_number",
    *     description="national_id_number",
    *     type="string"
    * )
    */
    public $national_id_number;

    /**
    * @OA\Property(
    *     title="cscs_id_number",
    *     description="cscs_id_number",
    *     type="string"
    * )
    */
    public $cscs_id_number;

    /**
    * @OA\Property(
    *     title="chn_id_number",
    *     description="chn_id_number",
    *     type="string"
    * )
    */
    public $chn_id_number;


}
