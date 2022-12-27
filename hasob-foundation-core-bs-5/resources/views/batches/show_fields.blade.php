<!-- Name Field -->
<div id="div_batch_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('name', 'Name:', ['class'=>'control-label']) !!} 
        <span id="spn_batch_name">
        @if (isset($batch->name) && empty($batch->name)==false)
            {!! $batch->name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

