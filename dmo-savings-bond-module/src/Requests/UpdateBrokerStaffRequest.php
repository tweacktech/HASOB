<?php

namespace DMO\SavingsBond\Requests;

use DMO\SavingsBond\Requests\AppBaseFormRequest;
use DMO\SavingsBond\Models\BrokerStaff;

class UpdateBrokerStaffRequest extends AppBaseFormRequest
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
        'role' => 'max:100'
        ];
    }
}
