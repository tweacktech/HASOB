<?php

namespace DMO\SavingsBond\Requests;

use DMO\SavingsBond\Requests\AppBaseFormRequest;
use DMO\SavingsBond\Models\Broker;

class UpdateBrokerRequest extends AppBaseFormRequest
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
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'full_name' => 'required',
        'short_name' => 'nullable'
        ];
    }
}
