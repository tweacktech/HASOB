<?php

namespace Hasob\FoundationCore\Models;

use Hasob\FoundationCore\Traits\GuidId;
use Hasob\FoundationCore\Traits\OrganizationalConstraint;

use Eloquent as Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PaymentAttempt extends Model
{
    use GuidId;
    use SoftDeletes;
    use OrganizationalConstraint;    


    public $table = 'fc_payment_attempts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'organization_id',
        'amount',
        'attempt_code',
        'payable_type',
        'payable_type_id',
        'gateway_url',
        'gateway_name',
        'gateway_reference_code',
        'status',
        'gateway_initialization_response',
        'payment_instrument_type',
        'is_verified',
        'is_verification_passed',
        'is_verification_failed',
        'verified_amount',
        'verification_meta',
        'verification_notes'
    ];

    protected $casts = [
        'id' => 'string',
        'amount' => 'double',
        'attempt_code' => 'string',
        'payable_type' => 'string',
        'payable_type_id' => 'string',
        'gateway_url' => 'string',
        'gateway_name' => 'string',
        'gateway_reference_code' => 'string',
        'status' => 'string',
        'gateway_initialization_response' => 'string',
        'payment_instrument_type' => 'string',
        'is_verified' => 'boolean',
        'is_verification_passed' => 'boolean',
        'is_verification_failed' => 'boolean',
        'verified_amount' => 'double',
        'verification_meta' => 'string',
        'verification_notes' => 'string'
    ];

    public function get_payable(){
        return $this->payable_type::find($this->payable_id);
    }
    

}
