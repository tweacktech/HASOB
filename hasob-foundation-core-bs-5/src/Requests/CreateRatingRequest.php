<?php

namespace Hasob\FoundationCore\Requests;

use Hasob\FoundationCore\Requests\AppBaseFormRequest;
use Hasob\FoundationCore\Models\Rating;

class CreateRatingRequest extends AppBaseFormRequest
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
        'status' => 'max:100',
        'ratable_id' => 'nullable|max:150',
        'ratable_type' => 'nullable|max:150',
        'description' => 'nullable|max:150',
        'score' => 'nullable|min:0|max:10000000000',
        'max_score' => 'nullable|min:0|max:10000000000',
        'creator_user_id' => 'required'
        ];
    }
}
