<!-- Status Field -->
<div id="div_offer_status" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('status', 'Status:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_status">
        @if (isset($offer->status) && empty($offer->status)==false)
            {!! $offer->status !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Offer Title Field -->
<div id="div_offer_offer_title" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('offer_title', 'Offer Title:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_offer_title">
        @if (isset($offer->offer_title) && empty($offer->offer_title)==false)
            {!! $offer->offer_title !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Price Per Unit Field -->
<div id="div_offer_price_per_unit" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('price_per_unit', 'Price Per Unit:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_price_per_unit">
        @if (isset($offer->price_per_unit) && empty($offer->price_per_unit)==false)
            {!! $offer->price_per_unit !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Max Units Per Investor Field -->
<div id="div_offer_max_units_per_investor" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('max_units_per_investor', 'Max Units Per Investor:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_max_units_per_investor">
        @if (isset($offer->max_units_per_investor) && empty($offer->max_units_per_investor)==false)
            {!! $offer->max_units_per_investor !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Interest Rate Pct Field -->
<div id="div_offer_interest_rate_pct" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('interest_rate_pct', 'Interest Rate Pct:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_interest_rate_pct">
        @if (isset($offer->interest_rate_pct) && empty($offer->interest_rate_pct)==false)
            {!! $offer->interest_rate_pct !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Offer Start Date Field -->
<div id="div_offer_offer_start_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('offer_start_date', 'Offer Start Date:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_offer_start_date">
        @if (isset($offer->offer_start_date) && empty($offer->offer_start_date)==false)
            {!! $offer->offer_start_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Offer End Date Field -->
<div id="div_offer_offer_end_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('offer_end_date', 'Offer End Date:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_offer_end_date">
        @if (isset($offer->offer_end_date) && empty($offer->offer_end_date)==false)
            {!! $offer->offer_end_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Offer Settlement Date Field -->
<div id="div_offer_offer_settlement_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('offer_settlement_date', 'Offer Settlement Date:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_offer_settlement_date">
        @if (isset($offer->offer_settlement_date) && empty($offer->offer_settlement_date)==false)
            {!! $offer->offer_settlement_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Offer Maturity Date Field -->
<div id="div_offer_offer_maturity_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('offer_maturity_date', 'Offer Maturity Date:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_offer_maturity_date">
        @if (isset($offer->offer_maturity_date) && empty($offer->offer_maturity_date)==false)
            {!! $offer->offer_maturity_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Tenor Years Field -->
<div id="div_offer_tenor_years" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('tenor_years', 'Tenor Years:', ['class'=>'control-label']) !!} 
        <span id="spn_offer_tenor_years">
        @if (isset($offer->tenor_years) && empty($offer->tenor_years)==false)
            {!! $offer->tenor_years !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

