<?php

namespace DMO\SavingsBond\Requests;

use DMO\SavingsBond\Requests\AppBaseFormRequest;
use DMO\SavingsBond\Models\Bid;

class CreateBidRequest extends AppBaseFormRequest
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
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'units_requested' => 'nullable|min:0|max:365',
        'price_per_unit' => 'required|min:0|max:100000000',
        'total_price' => 'required|min:0|max:100000000'
        ];
    }
}
