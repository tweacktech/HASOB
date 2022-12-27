@extends('layouts.app')

@section('title_postfix')
Setting Details
@stop

@section('page_title')
Setting Details
@stop

@section('page_title_subtext')
    <a class="ml-10 mb-10" href="{{ route('settings.index') }}" style="font-size:11px;color:blue;">
        <i class="fa fa-angle-double-left"></i> Back to Setting List
    </a>
@stop

@section('page_title_buttons')
<span class="float-end">
    <div class="float-end inline-block dropdown mb-15">
        <a href="#" data-val='{{$id}}' class='btn-edit-mdl-setting-modal'>
            <i class="icon wb-reply" aria-hidden="true"></i>Edit Setting
        </a>
    </div>
</span>
@stop

@section('content')
    <div class="card">
        <div class="card-wrapper collapse in">
            <div class="card-body">
                <div class="form-wrap">
                    <div class="row">
                        @include('pages.settings.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
