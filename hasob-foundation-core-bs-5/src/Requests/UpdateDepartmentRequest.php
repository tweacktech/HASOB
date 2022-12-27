<?php

namespace Hasob\FoundationCore\Requests;

use Hasob\FoundationCore\Requests\AppBaseFormRequest;
use Hasob\FoundationCore\Models\Address;

class UpdateDepartmentRequest extends AppBaseFormRequest
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
            'long_name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required|digits:11',
            'long_name' => 'required',      
        ];
    }
}
