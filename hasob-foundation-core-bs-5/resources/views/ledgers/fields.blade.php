<!-- Name Field -->
<div id="div-name" class="mb-3">
        <label class="form-label" for="ledger_name">Name</label>
        {!! Form::text('ledger_name',null,['id'=>'ledger_name','class'=>'form-control','maxlength'=>100,'maxlength'=>100]) !!}
</div>



<div class="mb-3">
    <label class="form-label">Department</label>
    <span class="input-group-addon"><span class="fa fa-institution"></span></span>
    <select id="ledger_department" name="ledger_department" class="form-select form-select-md">
        <option value="">Not Departmental Ledger</option>
        @if (isset($all_departments) && $all_departments != null)
            @foreach ($all_departments as $idx=>$dept)
                <option value="{{$dept->id}}">{{$dept->long_name}}</option>
            @endforeach
        @endif
    </select>

</div>