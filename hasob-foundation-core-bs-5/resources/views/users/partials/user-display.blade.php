@php
$current_user = Auth::user();
@endphp

<form id="frmUserDetails" name="frmUserDetails" class="form-horizontal" novalidate="">

    {{ csrf_field() }}

    <input type='hidden' id="idUserDetails" name="idUserDetails" />

    <div class="mb-3">
        <label class="form-label">Title</label>
        <div class="col-lg-2" style="padding-top:7px">
            {{ $current_user->title }}
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Name</label>
        <div class="col-lg-3" style="padding-top:7px">
            {{ $current_user->first_name }}
        </div>
        <div class="col-lg-3">
            {{ $current_user->middle_name }}
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Last Name</label>
        <div class="col-lg-6" style="padding-top:7px">
            {{ $current_user->last_name }}
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Telephone</label>
        <div class="col-lg-6" style="padding-top:7px">
            {{ $current_user->telephone }}
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <div class="col-lg-6" style="padding-top:7px">
            {{ $current_user->email }}
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="col-lg-3" style="padding-top:7px">******</div>
    </div>


    <div class="mb-3">
        <label class="form-label">Department</label>
        <div class="col-lg-6" style="padding-top:7px">
            @if ($current_user->department != null)
            {{ strtoupper($current_user->department->long_name) }}
            @endif
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Job Title</label>
        <div class="col-lg-6" style="padding-top:7px">
            {{ $current_user->job_title }}
        </div>
    </div>

</form>

