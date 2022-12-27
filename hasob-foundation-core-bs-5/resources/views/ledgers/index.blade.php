@extends(config('hasob-foundation-core.view_layout'))


@section('title_postfix')
Ledgers
@stop

@section('page_title')
Ledgers
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
<a href="#" class="btn btn-xs btn-primary float-end btn-new-mdl-ledger-modal">Create Ledger</a>
@endif
@stop

@section('content')
    
    <x-hasob-foundation-core::ledgers-list :ledgers="$ledgers" />
    
@stop

