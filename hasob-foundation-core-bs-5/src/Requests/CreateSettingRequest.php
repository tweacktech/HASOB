<?php

namespace Hasob\FoundationCore\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Hasob\FoundationCore\Models\Setting;

class CreateSettingRequest extends AppBaseFormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'organization_id' => 'required',
            'display_ordinal' => 'nullable|min:0|max:365',
            'display_type' => 'nullable|max:200',
            'display_name' => 'nullable|max:200',
            'owner_feature' => 'nullable|max:200',
            'allowed_editor_roles' => 'nullable|max:200',
            'allowed_view_roles' => 'nullable|max:200',
            'key' => 'nullable|max:200',
        ];
    }
}
