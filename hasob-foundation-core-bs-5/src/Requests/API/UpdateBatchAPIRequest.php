<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\Batch;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;


class UpdateBatchAPIRequest extends AppBaseFormRequest
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
        'name' => 'required|max:200',
        'status' => 'max:100',
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'batchable_type' => 'nullable|max:150',
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
    *     title="name",
    *     description="name",
    *     type="string"
    * )
    */
    public $name;

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
    *     title="wf_status",
    *     description="wf_status",
    *     type="string"
    * )
    */
    public $wf_status;

    /**
    * @OA\Property(
    *     title="wf_meta_data",
    *     description="wf_meta_data",
    *     type="string"
    * )
    */
    public $wf_meta_data;

    /**
    * @OA\Property(
    *     title="batchable_type",
    *     description="batchable_type",
    *     type="string"
    * )
    */
    public $batchable_type;

    /**
    * @OA\Property(
    *     title="creator_user_id",
    *     description="creator_user_id",
    *     type="string"
    * )
    */
    public $creator_user_id;


}
