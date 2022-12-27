@extends('layouts.app')

@section('title_postfix')
Savings Bond Dashboard
@stop

@section('page_title')
Savings Bond Dashboard
@stop

@push('page_css')
@endpush

@section('content')



    <div class="row">
        <div class="col-lg-12">
            
            <div class="card pa-0">
                    <div class="card-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row pa-10">

                                    <div class="col-lg-12 pa-10">
                                        
                                        Welcome to <span style='font-weight:bold'>DMO SAvings Bond</span> portal.
                                        
                                    </div>

                                </div>	
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            @include('dmo-savings-bond-module::dashboard.partials.assignments')
        </div>
    </div>

@stop


@push('page_scripts')
@endpush