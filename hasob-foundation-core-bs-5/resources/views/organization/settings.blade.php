@extends(config('hasob-foundation-core.view_layout'))


@section('title_postfix')
Application Settings
@stop

@section('page_title')
Application Settings
@stop


@section('page_title_subtext')
    <a class="ml-10 mb-10" href="{{ URL::previous() }}" style="font-size:11px;color:blue;">
        <i class="fa fa-angle-double-left"></i> Back to Dashboard
    </a>
@stop

@section('page_title_buttons')
<span class="float-end">
    {{-- <a href="#" class="btn btn-xs btn-primary float-end btn-new-mdl-setting-modal">
        <i class="zmdi zmdi-file-plus"></i> Add New Setting
    </a> --}}
</span>
@stop


@section('content')

    <x-hasob-foundation-core::settings-list :groups="$groups" :settings="$settings" />

@stop
