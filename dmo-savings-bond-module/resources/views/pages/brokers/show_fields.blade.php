<!-- Status Field -->
<div id="div_broker_status" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('status', 'Status:', ['class'=>'control-label']) !!} 
        <span id="spn_broker_status">
        @if (isset($broker->status) && empty($broker->status)==false)
            {!! $broker->status !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Broker Code Field -->
<div id="div_broker_broker_code" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('broker_code', 'Broker Code:', ['class'=>'control-label']) !!} 
        <span id="spn_broker_broker_code">
        @if (isset($broker->broker_code) && empty($broker->broker_code)==false)
            {!! $broker->broker_code !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Full Name Field -->
<div id="div_broker_full_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('full_name', 'Full Name:', ['class'=>'control-label']) !!} 
        <span id="spn_broker_full_name">
        @if (isset($broker->full_name) && empty($broker->full_name)==false)
            {!! $broker->full_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Short Name Field -->
<div id="div_broker_short_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('short_name', 'Short Name:', ['class'=>'control-label']) !!} 
        <span id="spn_broker_short_name">
        @if (isset($broker->short_name) && empty($broker->short_name)==false)
            {!! $broker->short_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

