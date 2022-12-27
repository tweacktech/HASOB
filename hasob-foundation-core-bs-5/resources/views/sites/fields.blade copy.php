<!-- Site Name Field -->
<div id="div-site_name" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="site_name">Site Name</label>
    <div class="col-sm-12">
        {!! Form::text('site_name', null, ['class' => 'form-control','minlength' => 4,'maxlength' => 150]) !!}
    </div>
</div>

<!-- Site Path Field -->
<div id="div-site_path" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="site_path">Site Path</label>
    <div class="col-sm-12">
        {!! Form::text('site_path', null, ['class' => 'form-control','minlength' => 4,'maxlength' => 150]) !!}
    </div>
</div>

<!-- Description Field -->
<div id="div-description" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="description">Description</label>
    <div class="col-sm-12">
        {!! Form::text('description', null, ['class' => 'form-control','minlength' => 4,'maxlength' => 150]) !!}
    </div>
</div>

<!-- Is Blade Rendered Field -->
<div id="div-is_blade_rendered" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="is_blade_rendered">Is Blade Rendered</label>
    <div class="col-sm-12">
        {!! Form::text('is_blade_rendered', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Is View Restricted Field -->
<div id="div-is_view_restricted" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="is_view_restricted">Is View Restricted</label>
    <div class="col-sm-12">
        {!! Form::text('is_view_restricted', null, ['class' => 'form-control']) !!}
    </div>
</div>