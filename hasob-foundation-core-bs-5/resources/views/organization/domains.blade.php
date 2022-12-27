@extends(config('hasob-foundation-core.view_layout'))


@section('title_postfix')
Domains
@stop

@section('page_title')
Domains
@stop

@section('app_css')   
@stop

@section('page_title_subtext')
<a class="ms-1" href="{{ route('dashboard') }}">
    <i class="bx bx-chevron-left"></i> Back to Dashboard
</a> 
@stop

@section('page_title_buttons')
@if (Auth()->user()->hasAnyRole(['admin']))
<a href="#" class="btn btn-xs btn-primary float-end btn-new-mdl-organization-modal">Add Domain</a>
@endif
@stop

@section('content')

<x-hasob-foundation-core::domain-list :domains="$domains" />

@stop
