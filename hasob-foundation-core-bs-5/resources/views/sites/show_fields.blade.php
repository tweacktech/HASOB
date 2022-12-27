<!-- Site Name Field -->
<div id="div_site_site_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('site_name', 'Site Name:', ['class'=>'form-label']) !!} 
        <span id="spn_site_site_name">
        @if (isset($site->site_name) && empty($site->site_name)==false)
            {!! $site->site_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Site Path Field -->
<div id="div_site_site_path" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('site_path', 'Site Path:', ['class'=>'form-label']) !!} 
        <span id="spn_site_site_path">
        @if (isset($site->site_path) && empty($site->site_path)==false)
            {!! $site->site_path !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Description Field -->
<div id="div_site_description" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('description', 'Description:', ['class'=>'form-label']) !!} 
        <span id="spn_site_description">
        @if (isset($site->description) && empty($site->description)==false)
            {!! $site->description !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

