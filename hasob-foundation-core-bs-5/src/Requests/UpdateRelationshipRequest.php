<?php

namespace Hasob\FoundationCore\Requests;

use Hasob\FoundationCore\Requests\AppBaseFormRequest;
use Hasob\FoundationCore\Models\Relationship;

class UpdateRelationshipRequest extends AppBaseFormRequest
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
        'status' => 'max:100',
        'primary_item_id' => 'nullable|max:150',
        'primary_item_type' => 'nullable|max:150',
        'related_item_id' => 'nullable|max:150',
        'related_item_type' => 'nullable|max:150',
        'relation_type' => 'nullable|max:150',
        'weight' => 'nullable|min:0|max:10000000000'
        ];
    }
}
