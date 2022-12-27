<!-- Site Name Field -->
<div id="div-site_name" class="mb-3">
    <label class="form-label mb-10 col-sm-3" for="site_name">Site Name</label>
    <div class="col-sm-12">
        {!! Form::text('site_name', null, ['id'=>'site_name', 'class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Site Path Field -->
{{-- <div id="div-site_path" class="mb-3">
    <label class="form-label mb-10 col-sm-3" for="site_path">Site Path</label>
    <div class="col-sm-12">
        {!! Form::text('site_path', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div> --}}

<!-- Description Field -->
<div id="div-description" class="mb-3">
    <label class="form-label mb-10 col-sm-3" for="site_description">Description</label>
    <div class="col-sm-12">
        {!! Form::textarea('site_description', null, ['id'=>'site_description','rows'=>'3','class' => 'form-control']) !!}
    </div>
</div>

<!-- Department Id Field -->

<div class="mb-3">
    <!-- <label class="col-sm-3 mb-10 form-control">Department</label>  -->
    <label class="form-label">Department</label> <span class="input-group-addon"><span class="fa fa-institution"></span></span>
    <div class="col-sm-12">
        <div class="input-group">

            <select id="site_department" name="site_department" class="form-select">
                <option value="">Not Departmental Site
                </option>
                @if (isset($all_departments) && $all_departments != null)
                    @foreach ($all_departments as $idx=>$dept)
                        <option value="{{$dept->id}}">{{$dept->long_name}}</option>
                    @endforeach
                @endif
            </select>
           

        </div>
    </div>
</div>

<!-- Is Blade Rendered Field -->
{{-- <div id="div-is_blade_rendered" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="is_blade_rendered">Is Blade Rendered</label>
    <div class="col-sm-9">
        <div class="form-check">
            {!! Form::hidden('is_blade_rendered', 0, ['class' => 'form-check-input']) !!}
            {!! Form::checkbox('is_blade_rendered', '1', null, ['class' => 'form-check-input']) !!}
        </div>
    </div>
</div> --}}

<!-- Blade File Path Field -->
{{-- <div id="div-blade_file_path" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="blade_file_path">Blade File Path</label>
    <div class="col-sm-9">
        {!! Form::text('blade_file_path', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div> --}}

<!-- Is View Restricted Field -->
{{-- <div id="div-is_view_restricted" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="is_view_restricted">Is View Restricted</label>
    <div class="col-sm-9">
        <div class="form-check">
            {!! Form::hidden('is_view_restricted', 0, ['class' => 'form-check-input']) !!}
            {!! Form::checkbox('is_view_restricted', '1', null, ['class' => 'form-check-input']) !!}
        </div>
    </div>
</div> --}}

<!-- View Allowed Roles Field -->
{{-- <div id="div-view_allowed_roles" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="view_allowed_roles">View Allowed Roles</label>
    <div class="col-sm-12">
        {!! Form::text('view_allowed_roles', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div> --}}

<!-- View Allowed User Ids Field -->
{{-- <div id="div-view_allowed_user_ids" class="mb-3">
    <label class="form-control mb-10 col-sm-3" for="view_allowed_user_ids">View Allowed User Ids</label>
    <div class="col-sm-12">
        {!! Form::text('view_allowed_user_ids', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div> --}}
