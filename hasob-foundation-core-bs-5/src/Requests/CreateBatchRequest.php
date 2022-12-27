<?php

namespace Hasob\FoundationCore\Requests;

use Hasob\FoundationCore\Requests\AppBaseFormRequest;
use Hasob\FoundationCore\Models\Batch;

class CreateBatchRequest extends AppBaseFormRequest
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
        'name' => 'required|max:200',
        'status' => 'max:100',
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'batchable_type' => 'nullable|max:150',
        'creator_user_id' => 'required'
        ];
    }
}
