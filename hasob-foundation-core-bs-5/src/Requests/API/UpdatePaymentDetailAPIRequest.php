<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\PaymentDetail;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;


class UpdatePaymentDetailAPIRequest extends AppBaseFormRequest
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
        'label' => 'required|max:200',
        'bank_account_name' => 'nullable|min:2|max:100',
        'bank_account_number' => 'nullable|length:10',
        'bank_name' => 'nullable|length:100',
        'bank_verification_number' => 'nullable|length:100',
        'national_id_number' => 'nullable|length:100',
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'payable_id' => 'nullable|max:150',
        'payable_type' => 'nullable|max:150'
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
    *     title="label",
    *     description="label",
    *     type="string"
    * )
    */
    public $label;

    /**
    * @OA\Property(
    *     title="is_preferred",
    *     description="is_preferred",
    *     type="boolean"
    * )
    */
    public $is_preferred;

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
    *     title="payable_id",
    *     description="payable_id",
    *     type="string"
    * )
    */
    public $payable_id;

    /**
    * @OA\Property(
    *     title="payable_type",
    *     description="payable_type",
    *     type="string"
    * )
    */
    public $payable_type;


}
