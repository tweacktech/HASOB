<a href="{{ route('fc.user.edit', $id) }}" data-val='{{$id}}' class=''>
    <i class="fa fa-eye"></i>
    {{-- {!! Form::button('<i class="fa fa-eye"></i>', ['type'=>'button']) !!} --}}
</a>

{{-- <a href="#" data-val='{{$id}}' class='btn-edit-mdl-enrollment-modal'>
    {!! Form::button('<i class="fa fa-edit"></i>', ['type'=>'button']) !!}
</a> --}}

<a href="#" data-val='{{$id}}' class='btn-delete-mdl-enrollment-modal'>
    <i class="fa fa-trash text-danger"></i>
    {{-- {!! Form::button('<i class="fa fa-trash"></i>', ['type'=>'button', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
</a>