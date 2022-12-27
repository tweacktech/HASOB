<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\Site;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;


class CreateSiteAPIRequest extends AppBaseFormRequest
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
    *     title="site_name",
    *     description="site_name",
    *     type="string"
    * )
    */
    public $site_name;

    /**
    * @OA\Property(
    *     title="site_path",
    *     description="site_path",
    *     type="string"
    * )
    */
    public $site_path;

    /**
    * @OA\Property(
    *     title="description",
    *     description="description",
    *     type="string"
    * )
    */
    public $description;

    /**
    * @OA\Property(
    *     title="siteable_id",
    *     description="siteable_id",
    *     type="string"
    * )
    */
    public $siteable_id;

    /**
    * @OA\Property(
    *     title="siteable_type",
    *     description="siteable_type",
    *     type="string"
    * )
    */
    public $siteable_type;

    /**
    * @OA\Property(
    *     title="department_id",
    *     description="department_id",
    *     type="string"
    * )
    */
    public $department_id;

    /**
    * @OA\Property(
    *     title="blade_file_path",
    *     description="blade_file_path",
    *     type="string"
    * )
    */
    public $blade_file_path;

    /**
    * @OA\Property(
    *     title="is_blade_rendered",
    *     description="is_blade_rendered",
    *     type="boolean"
    * )
    */
    public $is_blade_rendered;

    /**
    * @OA\Property(
    *     title="is_view_restricted",
    *     description="is_view_restricted",
    *     type="boolean"
    * )
    */
    public $is_view_restricted;

    /**
    * @OA\Property(
    *     title="view_allowed_roles",
    *     description="view_allowed_roles",
    *     type="string"
    * )
    */
    public $view_allowed_roles;

    /**
    * @OA\Property(
    *     title="view_allowed_user_ids",
    *     description="view_allowed_user_ids",
    *     type="string"
    * )
    */
    public $view_allowed_user_ids;

    /**
    * @OA\Property(
    *     title="creator_user_id",
    *     description="creator_user_id",
    *     type="string"
    * )
    */
    public $creator_user_id;


}
