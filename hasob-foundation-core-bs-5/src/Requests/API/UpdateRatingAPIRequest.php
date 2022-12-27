<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\Rating;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;


class UpdateRatingAPIRequest extends AppBaseFormRequest
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
        'ratable_id' => 'nullable|max:150',
        'ratable_type' => 'nullable|max:150',
        'description' => 'nullable|max:150',
        'score' => 'nullable|min:0|max:10000000000',
        'max_score' => 'nullable|min:0|max:10000000000',
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
    *     title="status",
    *     description="status",
    *     type="string"
    * )
    */
    public $status;

    /**
    * @OA\Property(
    *     title="ratable_id",
    *     description="ratable_id",
    *     type="string"
    * )
    */
    public $ratable_id;

    /**
    * @OA\Property(
    *     title="ratable_type",
    *     description="ratable_type",
    *     type="string"
    * )
    */
    public $ratable_type;

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
    *     title="score",
    *     description="score",
    *     type="integer"
    * )
    */
    public $score;

    /**
    * @OA\Property(
    *     title="max_score",
    *     description="max_score",
    *     type="integer"
    * )
    */
    public $max_score;

    /**
    * @OA\Property(
    *     title="creator_user_id",
    *     description="creator_user_id",
    *     type="string"
    * )
    */
    public $creator_user_id;


}
