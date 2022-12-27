<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\Page;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;


class UpdateModelArtifactAPIRequest extends AppBaseFormRequest
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
            'model_name' => 'required|min:2|max:150',
            'model_primary_id' => 'required|min:2|max:150',
            'key' => 'required|min:4|max:150',
            'value' => 'nullable|min:0|max:5000',
        ];
    }

    public $key;
    public $value;
    public $model_name;
    public $organization_id;
    public $model_primary_id;

}
