

<form id="frmRoleDetails" name="frmRoleDetails" class="form-horizontal" novalidate="">
    {{ csrf_field() }}

    <div class="mb-3">
        <label class="col-xs-3 form-label">Name</label>
        <div class="col-xs-9">
            <div class="input-group {{ $errors->has('nameRoleDetails') ? ' has-error' : '' }}" >
                <input type='hidden' id="idRoleDetails" name="idRoleDetails" />
                <input type='text' class="form-control" id="nameRoleDetails" name="nameRoleDetails" value="{{ old('nameRoleDetails') }}" required />
               
            </div>
        </div>
    </div>


</form>

<!-- <span class="input-group-addon"><span class="fa fa-file"></span></span> -->



