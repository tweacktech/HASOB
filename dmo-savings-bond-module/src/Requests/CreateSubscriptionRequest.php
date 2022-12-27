<?php

namespace DMO\SavingsBond\Requests;

use DMO\SavingsBond\Requests\AppBaseFormRequest;
use DMO\SavingsBond\Models\Subscription;

class CreateSubscriptionRequest extends AppBaseFormRequest
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
}
