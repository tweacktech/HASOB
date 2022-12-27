<?php

namespace Hasob\FoundationCore\Requests;

use Hasob\FoundationCore\Requests\AppBaseFormRequest;
use Hasob\FoundationCore\Models\Address;

class UpdateAddressRequest extends AppBaseFormRequest
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
        'contact_person' => 'nullable|max:200',
        'street' => 'nullable|max:200',
        'town' => 'nullable|max:200',
        'state' => 'nullable|max:200',
        'country' => 'nullable|max:200',
        'telephone' => 'nullable|max:12',
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'addressable_id' => 'nullable|max:150',
        'addressable_type' => 'nullable|max:150'
        ];
    }
}
