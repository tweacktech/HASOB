<?php

namespace DMO\SavingsBond\Requests\API;

use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Requests\AppBaseFormRequest;


class UpdateInvestorAPIRequest extends AppBaseFormRequest
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
        'broker_id' => 'required',
        'user_id' => 'required',
        'origin_geo_zone' => 'nullable|length:100',
        'origin_lga' => 'nullable|length:100',
        'address_street' => 'nullable|length:200',
        'address_town' => 'nullable|length:200',
        'address_state' => 'nullable|length:200',
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'bank_account_name' => 'nullable|min:2|max:100',
        'bank_account_number' => 'nullable|length:10',
        'bank_name' => 'nullable|length:100',
        'bank_account_meta_data' => 'max:1000',
        'bank_verification_number' => 'nullable|length:100',
        'bvn_meta_data' => 'max:1000',
        'national_id_number' => 'nullable|length:100',
        'nin_meta_data' => 'max:1000',
        'cscs_id_number' => 'nullable|length:100',
        'cscs_meta_data' => 'max:1000',
        'chn_id_number' => 'nullable|length:100',
        'chn_meta_data' => 'max:1000'
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
    *     title="broker_id",
    *     description="broker_id",
    *     type="string"
    * )
    */
    public $broker_id;

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
    *     title="user_id",
    *     description="user_id",
    *     type="string"
    * )
    */
    public $user_id;

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
    *     title="is_bank_account_verified",
    *     description="is_bank_account_verified",
    *     type="boolean"
    * )
    */
    public $is_bank_account_verified;

    /**
    * @OA\Property(
    *     title="bank_account_meta_data",
    *     description="bank_account_meta_data",
    *     type="string"
    * )
    */
    public $bank_account_meta_data;

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
    *     title="is_bvn_verified",
    *     description="is_bvn_verified",
    *     type="boolean"
    * )
    */
    public $is_bvn_verified;

    /**
    * @OA\Property(
    *     title="bvn_meta_data",
    *     description="bvn_meta_data",
    *     type="string"
    * )
    */
    public $bvn_meta_data;

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
    *     title="is_nin_verified",
    *     description="is_nin_verified",
    *     type="boolean"
    * )
    */
    public $is_nin_verified;

    /**
    * @OA\Property(
    *     title="nin_meta_data",
    *     description="nin_meta_data",
    *     type="string"
    * )
    */
    public $nin_meta_data;

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
    *     title="is_cscs_id_verified",
    *     description="is_cscs_id_verified",
    *     type="boolean"
    * )
    */
    public $is_cscs_id_verified;

    /**
    * @OA\Property(
    *     title="cscs_meta_data",
    *     description="cscs_meta_data",
    *     type="string"
    * )
    */
    public $cscs_meta_data;

    /**
    * @OA\Property(
    *     title="chn_id_number",
    *     description="chn_id_number",
    *     type="string"
    * )
    */
    public $chn_id_number;

    /**
    * @OA\Property(
    *     title="is_chn_id_verified",
    *     description="is_chn_id_verified",
    *     type="boolean"
    * )
    */
    public $is_chn_id_verified;

    /**
    * @OA\Property(
    *     title="chn_meta_data",
    *     description="chn_meta_data",
    *     type="string"
    * )
    */
    public $chn_meta_data;


}
