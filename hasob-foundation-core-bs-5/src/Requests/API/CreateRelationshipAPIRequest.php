<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\Relationship;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;


class CreateRelationshipAPIRequest extends AppBaseFormRequest
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
        'primary_item_id' => 'nullable|max:150',
        'primary_item_type' => 'nullable|max:150',
        'related_item_id' => 'nullable|max:150',
        'related_item_type' => 'nullable|max:150',
        'relation_type' => 'nullable|max:150',
        'weight' => 'nullable|min:0|max:10000000000'
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
    *     title="primary_item_id",
    *     description="primary_item_id",
    *     type="string"
    * )
    */
    public $primary_item_id;

    /**
    * @OA\Property(
    *     title="primary_item_type",
    *     description="primary_item_type",
    *     type="string"
    * )
    */
    public $primary_item_type;

    /**
    * @OA\Property(
    *     title="related_item_id",
    *     description="related_item_id",
    *     type="string"
    * )
    */
    public $related_item_id;

    /**
    * @OA\Property(
    *     title="related_item_type",
    *     description="related_item_type",
    *     type="string"
    * )
    */
    public $related_item_type;

    /**
    * @OA\Property(
    *     title="relation_type",
    *     description="relation_type",
    *     type="string"
    * )
    */
    public $relation_type;

    /**
    * @OA\Property(
    *     title="weight",
    *     description="weight",
    *     type="integer"
    * )
    */
    public $weight;


}
