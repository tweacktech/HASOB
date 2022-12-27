<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\Setting;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;


class CreateSettingAPIRequest extends AppBaseFormRequest
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

    /**
    * @OA\Property(
    *     title="organization_id",
    *     description="organization_id",
    *     type="string"
    * )
    */
    public $organization_id;

    /**
    * @OA\Property(
    *     title="display_ordinal",
    *     description="display_ordinal",
    *     type="integer"
    * )
    */
    public $display_ordinal;

    /**
    * @OA\Property(
    *     title="display_type",
    *     description="display_type",
    *     type="string"
    * )
    */
    public $display_type;

    /**
    * @OA\Property(
    *     title="allowed_editor_roles",
    *     description="allowed_editor_roles",
    *     type="string"
    * )
    */
    public $allowed_editor_roles;

    /**
    * @OA\Property(
    *     title="allowed_view_roles",
    *     description="allowed_view_roles",
    *     type="string"
    * )
    */
    public $allowed_view_roles;

    /**
    * @OA\Property(
    *     title="key",
    *     description="key",
    *     type="string"
    * )
    */
    public $key;

    /**
    * @OA\Property(
    *     title="value",
    *     description="value",
    *     type="string"
    * )
    */
    public $value;

    /**
    * @OA\Property(
    *     title="group_name",
    *     description="group_name",
    *     type="string"
    * )
    */
    public $group_name;

    /**
    * @OA\Property(
    *     title="model_type",
    *     description="model_type",
    *     type="string"
    * )
    */
    public $model_type;

    /**
    * @OA\Property(
    *     title="model_value",
    *     description="model_value",
    *     type="string"
    * )
    */
    public $model_value;


}
