
<form id="frmUserDetails"  name="frmUserDetails" class="form-horizontal" novalidate="">
    
    {{ csrf_field() }}
    
    
    <div id="errorMsgUserDetails" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

   
    <input type='hidden' id="idUserDetails" name="idUserDetails" />

    <!-- <div class="mb-3 pt-3">
        <h6 class="col-lg-3 form-label">Title</h6>
        <div class="">
            <div class="{{ $errors->has('userTitle') ? ' has-error' : '' }}">
                <select id="userTitle" name="userTitle" class="form-select">
                    <option value="">N/A</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Dr.">Dr.</option>
                    <option value="Arc.">Arc.</option>
                    <option value="Engr.">Engr.</option>
                    <option value="Alh.">Alh.</option>
                    <option value="Miss.">Miss</option>
                    <option value="Prof.">Prof</option>
                    <option value="QS.">QS.</option>
                    <option value="Mal.">Mallam</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <h6 class="col-lg-3 form-label">Name</h6>
        <div class="col-lg-12">
            <div class="{{ $errors->has('firstName') ? ' has-error' : '' }}">
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                    <input type="text" class="form-control" id="firstName" name="firstName"  placeholder="First Name" autofocus />

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="{{ $errors->has('middleName') ? ' has-error' : '' }}">
                <input type="text" class="form-control" id="middleName" name="middleName"  placeholder="Middle Name" autofocus />
            </div>
        </div>
    </div>

    <div class="mb-3">
        <h6 class="col-lg-3 form-label">Last Name</h6>
        <div class="">
            <div class="{{ $errors->has('lastName') ? ' has-error' : '' }}">
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Surname" />
            </div>
        </div>
    </div>
    
    
    <div class="mb-3">
        <h6 class="col-lg-3 form-label">Email Address</h6>
        <div class="">
            <div class="input-group {{ $errors->has('emailAddress') ? ' has-error' : '' }}" >
                <input type='text' class="form-control" id="emailAddress" name="emailAddress" />
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        <h6 class="col-lg-3 form-label">Telephone</h6>
        <div class="">
            <div class="input-group {{ $errors->has('phoneNumber') ? ' has-error' : '' }}" >
                <input type='text' class="form-control" id="phoneNumber" name="phoneNumber" />
                <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        <h6 class="col-lg-3 form-label">Password</h6>
        <div class="col-md-2">
            <div class="{{ $errors->has('password1') ? ' has-error' : '' }}">
                <input type="password" autocomplete="off" class="form-control" id="password1" name="password1"  placeholder="Enter Password" />
            </div>
        </div>
        <div class="col-lg-12">
            <div class="{{ $errors->has('password1_confirmation') ? ' has-error' : '' }}">
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="bx bxs-lock-open"></i></span>
                    <input type="password" autocomplete="off" class="form-control" id="password1_confirmation" name="password1_confirmation" placeholder="Re-enter Password" />
                    
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="mb-3">
        <h6 class="col-sm-3">Department</h6>
        <div class="">
            <div class="{{ $errors->has('department') ? ' has-error' : '' }}">
                <select id="department" name="department" class="form-select">
                    <option value="0">Select a Department</option>
                    @if (isset($departments))
                    @foreach ($departments as $id=>$department)
                    <option value="{{$department->id}}">{{ $department->long_name }}</option>
                    @endforeach
            @endif
        </select>
    </div>
</div>
</div>

<div class="mb-3">
    <h6 class="col-lg-3 form-label">Job Title</h6>
    <div class="">
        <div class="input-group {{ $errors->has('jobTitle') ? ' has-error' : '' }}" >
            <input type='text' class="form-control" id="jobTitle" name="jobTitle" placeholder="Director, etc." />
            <span class="input-group-addon"><span class="fa fa-stack-overflow"></span></span>
        </div>
    </div>
    </div> -->

    <!-- <div class="row mt-4"> -->
       
<div class="row mb-3 pt-3">
        <div class="col-lg-12">                         
             <div class="row g-3">                                        
                <div class="col-md-2 mt-4">
            {{-- <label class="col-lg-12 form-label">Title</label> --}}
                <div class="col-lg-12">
        <div class="{{ $errors->has('userTitle') ? ' has-error' : '' }}">
        <select id="userTitle" name="userTitle" class="form-select">
            <option value="">N/A</option>
            <option value="Mr.">Mr.</option>
            <option value="Mrs.">Mrs.</option>
            <option value="Dr.">Dr.</option>
            <option value="Arc.">Arc.</option>
            <option value="Engr.">Engr.</option>
            <option value="Alh.">Alh.</option>
            <option value="Miss.">Miss</option>
            <option value="Prof.">Prof</option>
            <option value="QS.">QS.</option>
            <option value="Mal.">Mallam</option>
        </select>
     </div>
    </div>
</div>
<div class="col-md-5 mt-4">
{{-- <label class="col-lg-12 form-label">Name</label> --}}
<div class="col-lg-12">
    <div class="{{ $errors->has('firstName') ? ' has-error' : '' }}">
        <div class="input-group">
    <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
    <input type="text" class="form-control" id="firstName" name="firstName"  placeholder="First Name" autofocus />
        </div>
       </div>
    </div>
</div>
<div class="col-md-5 mt-4">
    {{-- <label class="col-lg-12 form-label">Middle Name</label> --}}
    <div class="col-lg-12">
        <div class="{{ $errors->has('middleName') ? ' has-error' : '' }}">
             <input type="text" class="form-control" id="middleName" name="middleName"  placeholder="Middle Name" />
        </div>
    </div>
</div>
<div class="col-md-12">
    <label class="col-lg-12 form-label">Last Name</label>
    <div class="col-lg-12">
        <div class="{{ $errors->has('lastName') ? ' has-error' : '' }}">
            <div class="input-group"> 
                <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Surname"  />
            </div>
        </div>
   </div>
</div>
<div class="col-md-6">
<label class="col-lg-12 form-label">Email Address</label>
<div class="col-lg-12">
    <div class="{{ $errors->has('emailAddress') ? ' has-error' : '' }}" >
            <div class="input-group"> 
                <span class="input-group-text bg-transparent"><i class="bx bxs-envelope-open"></i></span>
                <input type='text' class="form-control" id="emailAddress" name="emailAddress" />
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <label class="col-lg-12 form-label">Phone Number</label>
    <div class="col-lg-12">
        <div class="{{ $errors->has('phoneNumber') ? ' has-error' : '' }}" >
            <div class="input-group"> 
                <span class="input-group-text bg-transparent"><i class="bx bxs-phone"></i></span>
                <input type='text' class="form-control" id="phoneNumber" name="phoneNumber"  placeholder="Phone Number" />
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <label class="col-lg-12 form-label">Password</label>
    <div class="col-lg-12">
        <div class="{{ $errors->has('password1') ? ' has-error' : '' }}">
            <div class="input-group"> 
                <span class="input-group-text bg-transparent"><i class="bx bxs-lock-open"></i></span>
                <input type="password" class="form-control" id="password1" name="password1"  placeholder="Enter Password" />
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <label class="col-lg-12 form-label">Confirm Password</label>
    <div class="col-lg-12">
        <div class="{{ $errors->has('password1_confirmation') ? ' has-error' : '' }}">
            <div class="input-group"> 
                <span class="input-group-text bg-transparent"><i class="bx bxs-lock"></i></span>
                <input type="password" class="form-control" id="password1_confirmation" name="password1_confirmation" placeholder="Re-enter Password" />
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <label class="col-lg-12 form-label">Department</label>
    <div class="col-lg-12">
        <div class="{{ $errors->has('department') ? ' has-error' : '' }}">
            <select id="department" name="department" class="form-select">
            <option value="0">Select a Department</option>
            @if (isset($departments))
            @foreach ($departments as $id=>$department)
                <option value="{{$department->id}}">{{ $department->long_name }}</option>
            @endforeach
            @endif
            </select>
        </div>
    </div>
</div>
<div class="col-md-6">
    <label class="col-lg-12 form-label">Job Title</label>
    <div class="col-lg-12">
        <div class="{{ $errors->has('jobTitle') ? ' has-error' : '' }}" >
            <div class="input-group"> 
                <span class="input-group-text bg-transparent"><i class="bx bxs-label"></i></span>
                <input type='text' class="form-control" id="jobTitle" name="jobTitle" placeholder="Job Title i.e. Director, etc."  />
            </div>
        </div>
    </div>
</div>


    @if (isset($allRoles) && $allRoles!=null)
    <div class="form-check">
        <label class="col-xs-3 form-check-label">Security Role</label>
        <div class="col-xs-9">
        @foreach ($allRoles as $idx=>$role)
            <div class="col-xs-6">
                <div class="checkbox">
                    <label>
                        <input id='userRole{{$role->name}}' name='userRole{{$role->name}}' type="checkbox" value="0" class="roleCbx form-check-input" /> {{ $role->name }}
                    </label>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    @endif

<br/>
<br/>
        </div>
      </div>
   </div>
</form>




@push('page_scripts')

    @include('hasob-foundation-core::users.partials.user-editing-js')

    <script type="text/javascript">

        
        $(document).ready(function(){
             $('#errorMsgUserDetails').hide()
            $('#idUserDetails').val('{!! Auth::guard('web')->user()->id !!}');
            
            $('#spinner').hide();
            $('#save').attr("disabled", false);
            $('#userTitle').val(null);
            $('#firstName').val(null);
            $('#middleName').val(null);
            $('#lastName').val(null);
            $('#phoneNumber').val(null);
            $('#emailAddress').val(null);
            $('#department').val(null);
            $('#jobTitle').val(null);
            
            $('#spinner').hide();
            $('#save').attr("disabled", false);

            
            $.get( "{{ route('fc.user.show', Auth::guard('web')->user()->id ) }}").done(function( data ) {
            $('#errorMsgUserDetails').hide()
                $('#userTitle').val(data.title);
                $('#firstName').val(data.first_name);
                $('#middleName').val(data.middle_name);
                $('#lastName').val(data.last_name);
                $('#phoneNumber').val(data.telephone);
                $('#emailAddress').val(data.email);
                $('#department').val(data.department_id);
                $('#jobTitle').val(data.job_title);

                $('#spinner').hide();
                $('#save').attr("disabled", false);
            });
        });
    </script>

@endpush