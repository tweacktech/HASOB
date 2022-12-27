<!-- Status Field -->
<div id="div_bid_status" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('status', 'Status:', ['class'=>'control-label']) !!} 
        <span id="spn_bid_status">
        @if (isset($bid->status) && empty($bid->status)==false)
            {!! $bid->status !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Price Per Unit Field -->
<div id="div_bid_price_per_unit" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('price_per_unit', 'Price Per Unit:', ['class'=>'control-label']) !!} 
        <span id="spn_bid_price_per_unit">
        @if (isset($bid->price_per_unit) && empty($bid->price_per_unit)==false)
            {!! $bid->price_per_unit !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Total Price Field -->
<div id="div_bid_total_price" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('total_price', 'Total Price:', ['class'=>'control-label']) !!} 
        <span id="spn_bid_total_price">
        @if (isset($bid->total_price) && empty($bid->total_price)==false)
            {!! $bid->total_price !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

