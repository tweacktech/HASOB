<!-- Key Field -->
<div id="div_setting_key" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('key', 'Key:', ['class'=>'control-label']) !!} 
        <span id="spn_setting_key">
        @if (isset($setting->key) && empty($setting->key)==false)
            {!! $setting->key !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Value Field -->
<div id="div_setting_value" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('value', 'Value:', ['class'=>'control-label']) !!} 
        <span id="spn_setting_value">
        @if (isset($setting->value) && empty($setting->value)==false)
            {!! $setting->value !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Group Name Field -->
<div id="div_setting_group_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('group_name', 'Group Name:', ['class'=>'control-label']) !!} 
        <span id="spn_setting_group_name">
        @if (isset($setting->group_name) && empty($setting->group_name)==false)
            {!! $setting->group_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Model Type Field -->
<div id="div_setting_model_type" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('model_type', 'Model Type:', ['class'=>'control-label']) !!} 
        <span id="spn_setting_model_type">
        @if (isset($setting->model_type) && empty($setting->model_type)==false)
            {!! $setting->model_type !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Model Value Field -->
<div id="div_setting_model_value" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('model_value', 'Model Value:', ['class'=>'control-label']) !!} 
        <span id="spn_setting_model_value">
        @if (isset($setting->model_value) && empty($setting->model_value)==false)
            {!! $setting->model_value !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

