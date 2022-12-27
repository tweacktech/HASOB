<!-- Label Field -->
<div id="div-label" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="label">Label</label>
    <div class="col-sm-9">
        {!! Form::text('label', null, ['class' => 'form-control','maxlength' => 200]) !!}
    </div>
</div>

<!-- Bank Account Name Field -->
<div id="div-bank_account_name" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="bank_account_name">Bank Account Name</label>
    <div class="col-sm-9">
        {!! Form::text('bank_account_name', null, ['class' => 'form-control','minlength' => 2,'maxlength' => 100]) !!}
    </div>
</div>

<!-- Bank Account Number Field -->
<div id="div-bank_account_number" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="bank_account_number">Bank Account Number</label>
    <div class="col-sm-9">
        {!! Form::text('bank_account_number', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Bank Name Field -->
<div id="div-bank_name" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="bank_name">Bank Name</label>
    <div class="col-sm-9">
        {!! Form::text('bank_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Bank Verification Number Field -->
<div id="div-bank_verification_number" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="bank_verification_number">Bank Verification Number</label>
    <div class="col-sm-9">
        {!! Form::text('bank_verification_number', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- National Id Number Field -->
<div id="div-national_id_number" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="national_id_number">National Id Number</label>
    <div class="col-sm-9">
        {!! Form::text('national_id_number', null, ['class' => 'form-control']) !!}
    </div>
</div>