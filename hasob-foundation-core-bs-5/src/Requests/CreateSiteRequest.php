<?php

namespace Hasob\FoundationCore\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Hasob\FoundationCore\Models\Site;

class CreateSiteRequest extends AppBaseFormRequest
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
            'site_name' => 'required|min:4|max:150',
            'site_path' => 'nullable|min:4|max:150',
            'description' => 'nullable|min:4|max:150',
            'siteable_id' => 'nullable|max:150',
            'siteable_type' => 'nullable|max:150',
            'blade_file_path' => 'nullable|max:150',
            'view_allowed_roles' => 'nullable|max:2000',
            'view_allowed_user_ids' => 'nullable|max:2000',
            'creator_user_id' => 'required'
        ];
    }
}
