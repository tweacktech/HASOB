<?php

namespace Hasob\FoundationCore\Requests\API;

use Hasob\FoundationCore\Models\BatchItem;
use Hasob\FoundationCore\Requests\AppBaseFormRequest;


class CreateBatchItemAPIRequest extends AppBaseFormRequest
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
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'batchable_id' => 'nullable|max:150',
        'batchable_type' => 'nullable|max:150'
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
    *     title="batchable_id",
    *     description="batchable_id",
    *     type="string"
    * )
    */
    public $batchable_id;

    /**
    * @OA\Property(
    *     title="batchable_type",
    *     description="batchable_type",
    *     type="string"
    * )
    */
    public $batchable_type;


}
