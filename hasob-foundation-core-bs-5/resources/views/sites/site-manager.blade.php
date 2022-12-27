@extends(config('hasob-foundation-core.view_layout'))


@section('title_postfix')
{{ $site->site_name }}
@stop

@section('page_title')
{{ $site->site_name }}
@stop

@section('app_css')   
@endsection

@section('content')

    <x-hasob-foundation-core::site-pages :site="$site" />

@stop
