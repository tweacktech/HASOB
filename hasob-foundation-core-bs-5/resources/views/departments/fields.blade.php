
            <!--Key Field -->
            {{-- <div id="div-key" class="form-group">
            <label class="form-label" for="key">Key</label>
            <div class="col-sm-9">
                {!! Form::text('key', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
            </div>
            </div> --}}
            
            <!-- Long Name Field -->
            <div id="div-long_name" class="mb-3">
                <label class="form-label" for="long_name">Name</label>
                <div>
                    {!! Form::text('long_name', null, ['id'=>'long_name', 'class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                </div>
            </div>

            <!-- Parent Field -->
            <div class="mb-3">
                <label class="form-label">Parent</label>
                <span class="input-group-addon"><span class="fa fa-institution"></span></span>
                <select 
                    id="department_id" 
                    name="department_id" 
                    class="form-select form-select-md"
                >
                    <option value="0">None</option>
                    @if (isset($departments) && $departments != null)
                        @foreach ($departments as $idx=>$dept)
                            <option value="{{$dept->key}}">{{$dept->long_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            
            <!-- Is Unit Field -->
            <div id="div-is_unit" class="row mb-3">
                <div class="col-md-9">
                    <div class="form-check">
                        {!! Form::hidden('is_unit', 0, ['id'=>'is_unit', 'class' => 'form-check-input']) !!}
                        {!! Form::checkbox('is_unit', '1', null, ['id'=>'is_unit', 'class' => 'form-check-input']) !!}
                        <label class="form-label" for="is_unit">Unit</label>
                    </div>
                </div>
            </div>

            <!-- Email Field -->
            <div id="div-email" class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label col-md-6" for="email">Email</label>
                    {!! Form::email('email', null, ['id'=>'email', 'class' => 'form-control','placeholder'=>'Department Email','maxlength' => 255,'maxlength' => 255]) !!}
                </div>
                    
                <div class="col-md-6">
                    <label class="form-label col-md-6" for="telephone">Telephone</label>
                    {!! Form::text('telephone', null, ['id'=>'telephone', 'class' => 'form-control','placeholder'=>'Phone Number','maxlength' => 255,'maxlength' => 255]) !!}
                </div>
            </div>


            <!-- Physical Location Field -->
            <div id="div-physical_location" class="mb-3">
                <label class="form-label" for="physical_location">Physical Location</label>
                <div>
                    {!! Form::text('physical_location', null, ['id'=>'physical_location', 'class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                </div>
            </div>

            <!-- Logo Image Field -->
            {{-- <div id="div-logo_image" class="mb-3">
                <label class="form-label" for="logo_image">Logo Image</label>
                <div>
                    {!! Form::text('logo_image', null, ['class' => 'form-control','maxlength' => 65535,'maxlength' => 65535]) !!}
                </div>
            </div> --}}

            <!-- Is Ad Import Field -->
            {{-- <div id="div-is_ad_import" class="mb-3">
                <label class="form-label" for="is_ad_import">Is Ad Import</label>
                <div>
                    <div class="form-check">
                        {!! Form::hidden('is_ad_import', 0, ['class' => 'form-check-input']) !!}
                        {!! Form::checkbox('is_ad_import', '1', null, ['class' => 'form-check-input']) !!}
                    </div>
                </div>
            </div> --}}

            <!-- Ad Type Field -->
            {{-- <div id="div-ad_type" class="mb-3">
                <label class="form-label" for="ad_type">Ad Type</label>
                <div>
                    {!! Form::text('ad_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                </div>
            </div> --}}

            <!-- Ad Key Field -->
            {{-- <div id="div-ad_key" class="mb-3">
                <label class="form-label" for="ad_key">Ad Key</label>
                <div>
                    {!! Form::text('ad_key', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
                </div>
            </div> --}}

            <!-- Ad Data Field -->
            {{-- <div id="div-ad_data" class="mb-3">
                <label class="form-label" for="ad_data">Ad Data</label>
                <div>
                    {!! Form::textarea('ad_data', null, ['class' => 'form-control']) !!}
                </div>
            </div> --}}

            <!-- Parent Id Field -->
            {{-- <div id="div-parent_id" class="mb-3">
                <label class="form-label" for="parent_id">Parent Id</label>
                <div>
                    {!! Form::text('parent_id', null, ['class' => 'form-control','maxlength' => 36,'maxlength' => 36]) !!}
                </div>
            </div> --}}

            <!-- Organization Id Field -->
            {{-- <div id="div-organization_id" class="mb-3">
                <label class="form-label" for="organization_id">Organization Id</label>
                <div>
                    {!! Form::text('organization_id', null, ['class' => 'form-control','maxlength' => 36,'maxlength' => 36]) !!}
                </div>
            </div> --}}
