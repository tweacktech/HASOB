@extends(config('hasob-foundation-core.view_layout'))


@section('title_postfix')
Sites
@stop

@section('page_title')
Sites 
@stop

@section('app_css')    
@stop

@section('page_title_subtext')
<a class="ms-1" href="{{ route('dashboard') }}">
    <i class="bx bx-chevron-left"></i> Back to Dashboard
</a> 
@stop

@section('page_title_buttons')
@if (Auth()->user()->hasAnyRole(['site-admin','admin']))
<a href="#" class="btn btn-xs btn-primary float-end btn-new-mdl-site-modal">Create Site</a>
@endif
@stop

@section('content')


    <x-hasob-foundation-core::sites-list :sites="$sites" />
        

@stop
