<?php

namespace DMO\SavingsBond\Requests;

use DMO\SavingsBond\Requests\AppBaseFormRequest;
use DMO\SavingsBond\Models\Investor;

class CreateInvestorRequest extends AppBaseFormRequest
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
}
