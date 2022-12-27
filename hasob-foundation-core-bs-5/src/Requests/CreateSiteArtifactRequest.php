<?php

namespace Hasob\FoundationCore\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Hasob\FoundationCore\Models\SiteArtifact;

class CreateSiteArtifactRequest extends AppBaseFormRequest
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
        'headline' => 'required|min:0|max:150',
        'type' => 'required|min:0|max:150',
        'display_ordinal' => 'nullable|min:0|max:365',
        'content' => 'nullable|min:0|max:2000',
        'external_page_url' => 'nullable|max:150',
        'creator_user_id' => 'required'
        ];
    }
}
