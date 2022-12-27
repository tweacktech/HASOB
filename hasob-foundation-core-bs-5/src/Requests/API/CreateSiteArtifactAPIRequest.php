<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\SiteArtifact;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;

class CreateSiteArtifactAPIRequest extends AppBaseFormRequest
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
    *     title="headline",
    *     description="headline",
    *     type="string"
    * )
    */
    public $headline;

    /**
    * @OA\Property(
    *     title="type",
    *     description="type",
    *     type="string"
    * )
    */
    public $type;

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
    *     title="content",
    *     description="content",
    *     type="string"
    * )
    */
    public $content;

    /**
    * @OA\Property(
    *     title="is_sticky",
    *     description="is_sticky",
    *     type="boolean"
    * )
    */
    public $is_sticky;

    /**
    * @OA\Property(
    *     title="is_flashing",
    *     description="is_flashing",
    *     type="boolean"
    * )
    */
    public $is_flashing;

    /**
    * @OA\Property(
    *     title="is_external_url",
    *     description="is_external_url",
    *     type="boolean"
    * )
    */
    public $is_external_url;

    /**
    * @OA\Property(
    *     title="page_id",
    *     description="page_id",
    *     type="string"
    * )
    */
    public $page_id;

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
    *     title="external_page_url",
    *     description="external_page_url",
    *     type="string"
    * )
    */
    public $external_page_url;

    /**
    * @OA\Property(
    *     title="creator_user_id",
    *     description="creator_user_id",
    *     type="string"
    * )
    */
    public $creator_user_id;

    /**
    * @OA\Property(
    *     title="display_start_date",
    *     description="display_start_date",
    *     type="string"
    * )
    */
    public $display_start_date;

    /**
    * @OA\Property(
    *     title="display_end_date",
    *     description="display_end_date",
    *     type="string"
    * )
    */
    public $display_end_date;

    /**
    * @OA\Property(
    *     title="specific_display_date",
    *     description="specific_display_date",
    *     type="string"
    * )
    */
    public $specific_display_date;


}
