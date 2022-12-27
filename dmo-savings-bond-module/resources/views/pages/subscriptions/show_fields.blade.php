<!-- Broker Code Field -->
<div id="div_subscription_broker_code" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('broker_code', 'Broker Code:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_broker_code">
        @if (isset($subscription->broker_code) && empty($subscription->broker_code)==false)
            {!! $subscription->broker_code !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Broker Name Field -->
<div id="div_subscription_broker_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('broker_name', 'Broker Name:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_broker_name">
        @if (isset($subscription->broker_name) && empty($subscription->broker_name)==false)
            {!! $subscription->broker_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Status Field -->
<div id="div_subscription_status" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('status', 'Status:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_status">
        @if (isset($subscription->status) && empty($subscription->status)==false)
            {!! $subscription->status !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Price Per Unit Field -->
<div id="div_subscription_price_per_unit" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('price_per_unit', 'Price Per Unit:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_price_per_unit">
        @if (isset($subscription->price_per_unit) && empty($subscription->price_per_unit)==false)
            {!! $subscription->price_per_unit !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Total Price Field -->
<div id="div_subscription_total_price" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('total_price', 'Total Price:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_total_price">
        @if (isset($subscription->total_price) && empty($subscription->total_price)==false)
            {!! $subscription->total_price !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Interest Rate Pct Field -->
<div id="div_subscription_interest_rate_pct" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('interest_rate_pct', 'Interest Rate Pct:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_interest_rate_pct">
        @if (isset($subscription->interest_rate_pct) && empty($subscription->interest_rate_pct)==false)
            {!! $subscription->interest_rate_pct !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Offer Start Date Field -->
<div id="div_subscription_offer_start_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('offer_start_date', 'Offer Start Date:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_offer_start_date">
        @if (isset($subscription->offer_start_date) && empty($subscription->offer_start_date)==false)
            {!! $subscription->offer_start_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Offer End Date Field -->
<div id="div_subscription_offer_end_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('offer_end_date', 'Offer End Date:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_offer_end_date">
        @if (isset($subscription->offer_end_date) && empty($subscription->offer_end_date)==false)
            {!! $subscription->offer_end_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Offer Settlement Date Field -->
<div id="div_subscription_offer_settlement_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('offer_settlement_date', 'Offer Settlement Date:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_offer_settlement_date">
        @if (isset($subscription->offer_settlement_date) && empty($subscription->offer_settlement_date)==false)
            {!! $subscription->offer_settlement_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Offer Maturity Date Field -->
<div id="div_subscription_offer_maturity_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('offer_maturity_date', 'Offer Maturity Date:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_offer_maturity_date">
        @if (isset($subscription->offer_maturity_date) && empty($subscription->offer_maturity_date)==false)
            {!! $subscription->offer_maturity_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Tenor Years Field -->
<div id="div_subscription_tenor_years" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('tenor_years', 'Tenor Years:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_tenor_years">
        @if (isset($subscription->tenor_years) && empty($subscription->tenor_years)==false)
            {!! $subscription->tenor_years !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Investor Email Field -->
<div id="div_subscription_investor_email" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('investor_email', 'Investor Email:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_investor_email">
        @if (isset($subscription->investor_email) && empty($subscription->investor_email)==false)
            {!! $subscription->investor_email !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Investor Telephone Field -->
<div id="div_subscription_investor_telephone" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('investor_telephone', 'Investor Telephone:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_investor_telephone">
        @if (isset($subscription->investor_telephone) && empty($subscription->investor_telephone)==false)
            {!! $subscription->investor_telephone !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- First Name Field -->
<div id="div_subscription_first_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('first_name', 'First Name:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_first_name">
        @if (isset($subscription->first_name) && empty($subscription->first_name)==false)
            {!! $subscription->first_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Middle Name Field -->
<div id="div_subscription_middle_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('middle_name', 'Middle Name:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_middle_name">
        @if (isset($subscription->middle_name) && empty($subscription->middle_name)==false)
            {!! $subscription->middle_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Last Name Field -->
<div id="div_subscription_last_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('last_name', 'Last Name:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_last_name">
        @if (isset($subscription->last_name) && empty($subscription->last_name)==false)
            {!! $subscription->last_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Date Of Birth Field -->
<div id="div_subscription_date_of_birth" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('date_of_birth', 'Date Of Birth:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_date_of_birth">
        @if (isset($subscription->date_of_birth) && empty($subscription->date_of_birth)==false)
            {!! $subscription->date_of_birth !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Origin Geo Zone Field -->
<div id="div_subscription_origin_geo_zone" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('origin_geo_zone', 'Origin Geo Zone:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_origin_geo_zone">
        @if (isset($subscription->origin_geo_zone) && empty($subscription->origin_geo_zone)==false)
            {!! $subscription->origin_geo_zone !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Origin Lga Field -->
<div id="div_subscription_origin_lga" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('origin_lga', 'Origin Lga:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_origin_lga">
        @if (isset($subscription->origin_lga) && empty($subscription->origin_lga)==false)
            {!! $subscription->origin_lga !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Address Street Field -->
<div id="div_subscription_address_street" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('address_street', 'Address Street:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_address_street">
        @if (isset($subscription->address_street) && empty($subscription->address_street)==false)
            {!! $subscription->address_street !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Address Town Field -->
<div id="div_subscription_address_town" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('address_town', 'Address Town:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_address_town">
        @if (isset($subscription->address_town) && empty($subscription->address_town)==false)
            {!! $subscription->address_town !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Address State Field -->
<div id="div_subscription_address_state" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('address_state', 'Address State:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_address_state">
        @if (isset($subscription->address_state) && empty($subscription->address_state)==false)
            {!! $subscription->address_state !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Bank Account Name Field -->
<div id="div_subscription_bank_account_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('bank_account_name', 'Bank Account Name:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_bank_account_name">
        @if (isset($subscription->bank_account_name) && empty($subscription->bank_account_name)==false)
            {!! $subscription->bank_account_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Bank Account Number Field -->
<div id="div_subscription_bank_account_number" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('bank_account_number', 'Bank Account Number:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_bank_account_number">
        @if (isset($subscription->bank_account_number) && empty($subscription->bank_account_number)==false)
            {!! $subscription->bank_account_number !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Bank Name Field -->
<div id="div_subscription_bank_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('bank_name', 'Bank Name:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_bank_name">
        @if (isset($subscription->bank_name) && empty($subscription->bank_name)==false)
            {!! $subscription->bank_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Bank Verification Number Field -->
<div id="div_subscription_bank_verification_number" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('bank_verification_number', 'Bank Verification Number:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_bank_verification_number">
        @if (isset($subscription->bank_verification_number) && empty($subscription->bank_verification_number)==false)
            {!! $subscription->bank_verification_number !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- National Id Number Field -->
<div id="div_subscription_national_id_number" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('national_id_number', 'National Id Number:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_national_id_number">
        @if (isset($subscription->national_id_number) && empty($subscription->national_id_number)==false)
            {!! $subscription->national_id_number !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Cscs Id Number Field -->
<div id="div_subscription_cscs_id_number" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('cscs_id_number', 'Cscs Id Number:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_cscs_id_number">
        @if (isset($subscription->cscs_id_number) && empty($subscription->cscs_id_number)==false)
            {!! $subscription->cscs_id_number !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Chn Id Number Field -->
<div id="div_subscription_chn_id_number" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('chn_id_number', 'Chn Id Number:', ['class'=>'control-label']) !!} 
        <span id="spn_subscription_chn_id_number">
        @if (isset($subscription->chn_id_number) && empty($subscription->chn_id_number)==false)
            {!! $subscription->chn_id_number !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

