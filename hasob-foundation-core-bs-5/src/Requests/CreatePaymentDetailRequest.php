<?php

namespace Hasob\FoundationCore\Requests;

use Hasob\FoundationCore\Requests\AppBaseFormRequest;
use Hasob\FoundationCore\Models\PaymentDetail;

class CreatePaymentDetailRequest extends AppBaseFormRequest
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
}
