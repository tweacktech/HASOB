<!-- Broker Code Field -->
<div id="div-broker_code" class="form-group">
    <label for="broker_code" class="col-lg-3 col-form-label">Broker Code</label>
    <div class="col-lg-9">
        {!! Form::text('broker_code', null, ['id'=>'broker_code', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Broker Name Field -->
<div id="div-broker_name" class="form-group">
    <label for="broker_name" class="col-lg-3 col-form-label">Broker Name</label>
    <div class="col-lg-9">
        {!! Form::text('broker_name', null, ['id'=>'broker_name', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Status Field -->
<div id="div-status" class="form-group">
    <label for="status" class="col-lg-3 col-form-label">Status</label>
    <div class="col-lg-9">
        {!! Form::text('status', null, ['id'=>'status', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Start Price Per Unit Field -->
<div id="div-price_per_unit" class="row mb-3">
    <label for="price_per_unit" class="col-lg-3 col-form-label">Price Per Unit</label>
    <div class="col-sm-9">
        {!! Form::number('price_per_unit', null, ['id'=>'price_per_unit', 'class' => 'form-control','min' => 0,'max' => 100000000]) !!}
    </div>
</div>
<!-- End Price Per Unit Field -->

<!-- Start Total Price Field -->
<div id="div-total_price" class="row mb-3">
    <label for="total_price" class="col-lg-3 col-form-label">Total Price</label>
    <div class="col-sm-9">
        {!! Form::number('total_price', null, ['id'=>'total_price', 'class' => 'form-control','min' => 0,'max' => 100000000]) !!}
    </div>
</div>
<!-- End Total Price Field -->

<!-- Start Interest Rate Pct Field -->
<div id="div-interest_rate_pct" class="row mb-3">
    <label for="interest_rate_pct" class="col-lg-3 col-form-label">Interest Rate Pct</label>
    <div class="col-sm-9">
        {!! Form::number('interest_rate_pct', null, ['id'=>'interest_rate_pct', 'class' => 'form-control','min' => 0,'max' => 100]) !!}
    </div>
</div>
<!-- End Interest Rate Pct Field -->

<!-- Offer Start Date Field -->
<div id="div-offer_start_date" class="form-group">
    <label for="offer_start_date" class="col-lg-3 col-form-label">Offer Start Date</label>
    <div class="col-lg-9">
        {!! Form::text('offer_start_date', null, ['id'=>'offer_start_date', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Offer End Date Field -->
<div id="div-offer_end_date" class="form-group">
    <label for="offer_end_date" class="col-lg-3 col-form-label">Offer End Date</label>
    <div class="col-lg-9">
        {!! Form::text('offer_end_date', null, ['id'=>'offer_end_date', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Offer Settlement Date Field -->
<div id="div-offer_settlement_date" class="form-group">
    <label for="offer_settlement_date" class="col-lg-3 col-form-label">Offer Settlement Date</label>
    <div class="col-lg-9">
        {!! Form::text('offer_settlement_date', null, ['id'=>'offer_settlement_date', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Offer Maturity Date Field -->
<div id="div-offer_maturity_date" class="form-group">
    <label for="offer_maturity_date" class="col-lg-3 col-form-label">Offer Maturity Date</label>
    <div class="col-lg-9">
        {!! Form::text('offer_maturity_date', null, ['id'=>'offer_maturity_date', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Tenor Years Field -->
<div id="div-tenor_years" class="form-group">
    <label for="tenor_years" class="col-lg-3 col-form-label">Tenor Years</label>
    <div class="col-lg-9">
        {!! Form::text('tenor_years', null, ['id'=>'tenor_years', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Investor Email Field -->
<div id="div-investor_email" class="form-group">
    <label for="investor_email" class="col-lg-3 col-form-label">Investor Email</label>
    <div class="col-lg-9">
        {!! Form::text('investor_email', null, ['id'=>'investor_email', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Investor Telephone Field -->
<div id="div-investor_telephone" class="form-group">
    <label for="investor_telephone" class="col-lg-3 col-form-label">Investor Telephone</label>
    <div class="col-lg-9">
        {!! Form::text('investor_telephone', null, ['id'=>'investor_telephone', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- First Name Field -->
<div id="div-first_name" class="form-group">
    <label for="first_name" class="col-lg-3 col-form-label">First Name</label>
    <div class="col-lg-9">
        {!! Form::text('first_name', null, ['id'=>'first_name', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Middle Name Field -->
<div id="div-middle_name" class="form-group">
    <label for="middle_name" class="col-lg-3 col-form-label">Middle Name</label>
    <div class="col-lg-9">
        {!! Form::text('middle_name', null, ['id'=>'middle_name', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Last Name Field -->
<div id="div-last_name" class="form-group">
    <label for="last_name" class="col-lg-3 col-form-label">Last Name</label>
    <div class="col-lg-9">
        {!! Form::text('last_name', null, ['id'=>'last_name', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Date Of Birth Field -->
<div id="div-date_of_birth" class="form-group">
    <label for="date_of_birth" class="col-lg-3 col-form-label">Date Of Birth</label>
    <div class="col-lg-9">
        {!! Form::text('date_of_birth', null, ['id'=>'date_of_birth', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Origin Geo Zone Field -->
<div id="div-origin_geo_zone" class="form-group">
    <label for="origin_geo_zone" class="col-lg-3 col-form-label">Origin Geo Zone</label>
    <div class="col-lg-9">
        {!! Form::text('origin_geo_zone', null, ['id'=>'origin_geo_zone', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Origin Lga Field -->
<div id="div-origin_lga" class="form-group">
    <label for="origin_lga" class="col-lg-3 col-form-label">Origin Lga</label>
    <div class="col-lg-9">
        {!! Form::text('origin_lga', null, ['id'=>'origin_lga', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Address Street Field -->
<div id="div-address_street" class="form-group">
    <label for="address_street" class="col-lg-3 col-form-label">Address Street</label>
    <div class="col-lg-9">
        {!! Form::text('address_street', null, ['id'=>'address_street', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Address Town Field -->
<div id="div-address_town" class="form-group">
    <label for="address_town" class="col-lg-3 col-form-label">Address Town</label>
    <div class="col-lg-9">
        {!! Form::text('address_town', null, ['id'=>'address_town', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Address State Field -->
<div id="div-address_state" class="form-group">
    <label for="address_state" class="col-lg-3 col-form-label">Address State</label>
    <div class="col-lg-9">
        {!! Form::text('address_state', null, ['id'=>'address_state', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Bank Account Name Field -->
<div id="div-bank_account_name" class="form-group">
    <label for="bank_account_name" class="col-lg-3 col-form-label">Bank Account Name</label>
    <div class="col-lg-9">
        {!! Form::text('bank_account_name', null, ['id'=>'bank_account_name', 'class' => 'form-control','minlength' => 2,'maxlength' => 100]) !!}
    </div>
</div>

<!-- Bank Account Number Field -->
<div id="div-bank_account_number" class="form-group">
    <label for="bank_account_number" class="col-lg-3 col-form-label">Bank Account Number</label>
    <div class="col-lg-9">
        {!! Form::text('bank_account_number', null, ['id'=>'bank_account_number', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Bank Name Field -->
<div id="div-bank_name" class="form-group">
    <label for="bank_name" class="col-lg-3 col-form-label">Bank Name</label>
    <div class="col-lg-9">
        {!! Form::text('bank_name', null, ['id'=>'bank_name', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Bank Verification Number Field -->
<div id="div-bank_verification_number" class="form-group">
    <label for="bank_verification_number" class="col-lg-3 col-form-label">Bank Verification Number</label>
    <div class="col-lg-9">
        {!! Form::text('bank_verification_number', null, ['id'=>'bank_verification_number', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- National Id Number Field -->
<div id="div-national_id_number" class="form-group">
    <label for="national_id_number" class="col-lg-3 col-form-label">National Id Number</label>
    <div class="col-lg-9">
        {!! Form::text('national_id_number', null, ['id'=>'national_id_number', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Cscs Id Number Field -->
<div id="div-cscs_id_number" class="form-group">
    <label for="cscs_id_number" class="col-lg-3 col-form-label">Cscs Id Number</label>
    <div class="col-lg-9">
        {!! Form::text('cscs_id_number', null, ['id'=>'cscs_id_number', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Chn Id Number Field -->
<div id="div-chn_id_number" class="form-group">
    <label for="chn_id_number" class="col-lg-3 col-form-label">Chn Id Number</label>
    <div class="col-lg-9">
        {!! Form::text('chn_id_number', null, ['id'=>'chn_id_number', 'class' => 'form-control']) !!}
    </div>
</div>