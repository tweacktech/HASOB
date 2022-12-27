<?php

namespace Hasob\FoundationCore\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Hasob\FoundationCore\Models\Ledger;

class CreateLedgerRequest extends AppBaseFormRequest
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
            'name' => 'required'
        ];
    }
}
