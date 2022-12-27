@extends(config('hasob-foundation-core.view_layout'))


@section('title_postfix')
{{ $department->long_name }}
@stop

@section('page_title')
{{ $department->long_name }}
@stop

@section('app_css')   
@endsection

@section('content')

    <x-hasob-foundation-core::department-badge :department="$department" />
    <x-hasob-foundation-core::department-members :department="$department" />

@stop
