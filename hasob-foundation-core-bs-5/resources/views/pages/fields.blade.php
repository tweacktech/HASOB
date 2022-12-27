<!-- Page Name Field -->
<div id="div-page_name" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="page_name">Page Name</label>
    <div class="col-sm-9">
        {!! Form::text('page_name', null, ['class' => 'form-control','minlength' => 4,'maxlength' => 150]) !!}
    </div>
</div>

<!-- Page Path Field -->
<div id="div-page_path" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="page_path">Page Path</label>
    <div class="col-sm-9">
        {!! Form::text('page_path', null, ['class' => 'form-control','minlength' => 4,'maxlength' => 150]) !!}
    </div>
</div>

<!-- Content Field -->
<div id="div-content" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="content">Content</label>
    <div class="col-sm-9">
        {!! Form::text('content', null, ['class' => 'form-control','minlength' => 0,'maxlength' => 2000]) !!}
    </div>
</div>

<!-- Is Hidden Field -->
<div id="div-is_hidden" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="is_hidden">Is Hidden</label>
    <div class="col-sm-9">
        {!! Form::text('is_hidden', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Is Published Field -->
<div id="div-is_published" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="is_published">Is Published</label>
    <div class="col-sm-9">
        {!! Form::text('is_published', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Allow Comments Field -->
<div id="div-allow_comments" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="allow_comments">Allow Comments</label>
    <div class="col-sm-9">
        {!! Form::text('allow_comments', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Is Blade Rendered Field -->
<div id="div-is_blade_rendered" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="is_blade_rendered">Is Blade Rendered</label>
    <div class="col-sm-9">
        {!! Form::text('is_blade_rendered', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Is View Restricted Field -->
<div id="div-is_view_restricted" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="is_view_restricted">Is View Restricted</label>
    <div class="col-sm-9">
        {!! Form::text('is_view_restricted', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Is Site Default Page Field -->
<div id="div-is_site_default_page" class="form-group">
    <label class="control-label mb-10 col-sm-3" for="is_site_default_page">Is Site Default Page</label>
    <div class="col-sm-9">
        {!! Form::text('is_site_default_page', null, ['class' => 'form-control']) !!}
    </div>
</div>