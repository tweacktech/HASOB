<!-- Label Field -->
<div id="div_paymentDetail_label" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('label', 'Label:', ['class'=>'control-label']) !!} 
        <span id="spn_paymentDetail_label">
        @if (isset($paymentDetail->label) && empty($paymentDetail->label)==false)
            {!! $paymentDetail->label !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Bank Account Name Field -->
<div id="div_paymentDetail_bank_account_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('bank_account_name', 'Bank Account Name:', ['class'=>'control-label']) !!} 
        <span id="spn_paymentDetail_bank_account_name">
        @if (isset($paymentDetail->bank_account_name) && empty($paymentDetail->bank_account_name)==false)
            {!! $paymentDetail->bank_account_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Bank Account Number Field -->
<div id="div_paymentDetail_bank_account_number" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('bank_account_number', 'Bank Account Number:', ['class'=>'control-label']) !!} 
        <span id="spn_paymentDetail_bank_account_number">
        @if (isset($paymentDetail->bank_account_number) && empty($paymentDetail->bank_account_number)==false)
            {!! $paymentDetail->bank_account_number !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Bank Name Field -->
<div id="div_paymentDetail_bank_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('bank_name', 'Bank Name:', ['class'=>'control-label']) !!} 
        <span id="spn_paymentDetail_bank_name">
        @if (isset($paymentDetail->bank_name) && empty($paymentDetail->bank_name)==false)
            {!! $paymentDetail->bank_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Bank Verification Number Field -->
<div id="div_paymentDetail_bank_verification_number" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('bank_verification_number', 'Bank Verification Number:', ['class'=>'control-label']) !!} 
        <span id="spn_paymentDetail_bank_verification_number">
        @if (isset($paymentDetail->bank_verification_number) && empty($paymentDetail->bank_verification_number)==false)
            {!! $paymentDetail->bank_verification_number !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- National Id Number Field -->
<div id="div_paymentDetail_national_id_number" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('national_id_number', 'National Id Number:', ['class'=>'control-label']) !!} 
        <span id="spn_paymentDetail_national_id_number">
        @if (isset($paymentDetail->national_id_number) && empty($paymentDetail->national_id_number)==false)
            {!! $paymentDetail->national_id_number !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

