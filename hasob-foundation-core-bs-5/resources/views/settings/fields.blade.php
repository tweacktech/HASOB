<!-- Key Field -->
<div id="div-key" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="key">Key</label>
    <div class="col-sm-9">
        {!! Form::text('key', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Value Field -->
<div id="div-value" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="value">Value</label>
    <div class="col-sm-9">
        {!! Form::textarea('value', null, ['rows'=>'3','class' => 'form-control']) !!}
    </div>
</div>

<!-- Group Name Field -->
<div id="div-group_name" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="group_name">Group Name</label>
    <div class="col-sm-9">
        {!! Form::text('group_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Model Type Field -->
<div id="div-model_type" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="model_type">Model Type</label>
    <div class="col-sm-9">
        {!! Form::text('model_type', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Model Value Field -->
<div id="div-model_value" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="model_value">Model Value</label>
    <div class="col-sm-9">
        {!! Form::text('model_value', null, ['class' => 'form-control']) !!}
    </div>
</div>