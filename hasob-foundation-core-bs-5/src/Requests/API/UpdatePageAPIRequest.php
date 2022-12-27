<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\Page;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;


class UpdatePageAPIRequest extends AppBaseFormRequest
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
            'display_ordinal' => 'nullable|min:0|max:365',
            'page_name' => 'required|min:4|max:150',
            'page_path' => 'nullable|min:4|max:150',
            'content' => 'nullable|min:0|max:2000',
            'blade_file_path' => 'nullable|max:150',
            'external_page_key' => 'nullable|max:150',
            'external_page_url' => 'nullable|max:150',
            'view_allowed_roles' => 'nullable|max:2000',
            'view_allowed_user_ids' => 'nullable|max:2000',
            'site_id' => 'nullable',
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
    *     title="page_name",
    *     description="page_name",
    *     type="string"
    * )
    */
    public $page_name;

    /**
    * @OA\Property(
    *     title="page_path",
    *     description="page_path",
    *     type="string"
    * )
    */
    public $page_path;

    /**
    * @OA\Property(
    *     title="content",
    *     description="content",
    *     type="string"
    * )
    */
    public $content;

    /**
    * @OA\Property(
    *     title="is_hidden",
    *     description="is_hidden",
    *     type="boolean"
    * )
    */
    public $is_hidden;

    /**
    * @OA\Property(
    *     title="is_published",
    *     description="is_published",
    *     type="boolean"
    * )
    */
    public $is_published;

    /**
    * @OA\Property(
    *     title="allow_comments",
    *     description="allow_comments",
    *     type="boolean"
    * )
    */
    public $allow_comments;

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
    *     title="is_external_page",
    *     description="is_external_page",
    *     type="boolean"
    * )
    */
    public $is_external_page;

    /**
    * @OA\Property(
    *     title="external_page_key",
    *     description="external_page_key",
    *     type="string"
    * )
    */
    public $external_page_key;

    /**
    * @OA\Property(
    *     title="external_page_url",
    *     description="external_page_url",
    *     type="string"
    * )
    */
    public $external_page_url;

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
    *     title="is_site_default_page",
    *     description="is_site_default_page",
    *     type="boolean"
    * )
    */
    public $is_site_default_page;

    /**
    * @OA\Property(
    *     title="site_id",
    *     description="site_id",
    *     type="string"
    * )
    */
    public $site_id;

    /**
    * @OA\Property(
    *     title="creator_user_id",
    *     description="creator_user_id",
    *     type="string"
    * )
    */
    public $creator_user_id;


}
