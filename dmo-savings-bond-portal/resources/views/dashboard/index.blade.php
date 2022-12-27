@extends('layouts.app')

@section('title_postfix')
Dashboard
@stop

@section('page_title')
Dashboard
@stop

@push('page_css')
@endpush

@section('content')
    <div class="row">

        <div class="col-lg-12">
        </div>

        <div class="col-lg-12">
            
        </div>

        <div class="col-lg-12">
            
        </div>

        <div class="col-lg-12">
            
        </div>

        
        @include('dashboard.partials.assignments')
        

    </div>
@stop


@push('page_scripts')
    
@endpush