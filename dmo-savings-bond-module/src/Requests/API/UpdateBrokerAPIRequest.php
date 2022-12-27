<?php

namespace DMO\SavingsBond\Requests\API;

use DMO\SavingsBond\Models\Broker;
use DMO\SavingsBond\Requests\AppBaseFormRequest;


class UpdateBrokerAPIRequest extends AppBaseFormRequest
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
        'wf_status' => 'max:100',
        'wf_meta_data' => 'max:1000',
        'full_name' => 'required',
        'short_name' => 'nullable'
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
    *     title="broker_code",
    *     description="broker_code",
    *     type="string"
    * )
    */
    public $broker_code;

    /**
    * @OA\Property(
    *     title="full_name",
    *     description="full_name",
    *     type="string"
    * )
    */
    public $full_name;

    /**
    * @OA\Property(
    *     title="short_name",
    *     description="short_name",
    *     type="string"
    * )
    */
    public $short_name;


}
