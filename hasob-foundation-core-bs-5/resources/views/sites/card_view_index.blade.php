@extends('layouts.app')

@section('app_css')
    {!! $cdv_sites->render_css() !!}
@endsection

@section('title_postfix')
Sites
@stop

@section('page_title')
Sites
@stop

@section('page_title_subtext')
<a class="ms-1" href="{{ route('dashboard') }}">
    <i class="bx bx-chevron-left"></i> Back to Dashboard
</a> 
@stop

@section('page_title_buttons')
@if (Auth()->user()->hasAnyRole(['site-admin','admin']))
<a id="btn-new-mdl-site-modal" class="btn btn-xs btn-primary btn-new-mdl-site-modal" href="#">
    <i class="zmdi zmdi-file-plus"></i> New&nbsp;Site
</a>
@endif
@stop

@section('content')

    <div class="row hidden-sm hidden-xs">
        {{-- Summary Row --}}
    </div>

    <div>

        {{ $cdv_sites->render() }} 

    </div>



    

    @include('hasob-foundation-core::sites.modal')
    
@endsection

@push('page_scripts')
    {!! $cdv_sites->render_js() !!}
@endpush