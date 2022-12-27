<!-- Status Field -->
<div id="div_brokerStaff_status" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('status', 'Status:', ['class'=>'control-label']) !!} 
        <span id="spn_brokerStaff_status">
        @if (isset($brokerStaff->status) && empty($brokerStaff->status)==false)
            {!! $brokerStaff->status !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

