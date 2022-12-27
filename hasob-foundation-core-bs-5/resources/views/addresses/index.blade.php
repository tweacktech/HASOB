@extends('layouts.app')


@section('title_postfix')
Addresses
@stop

@section('page_title')
Addresses
@stop

@section('page_title_buttons')
<span class="float-end">
    <a id="btn-new-mdl-address-modal" class="btn btn-xs btn-primary btn-new-mdl-address-modal" href="#">
        <i class="zmdi zmdi-file-plus"></i> New&nbsp;Address
    </a>
    @if (Auth()->user()->hasAnyRole(['','admin']))
        @include('hasob-foundation-core::pages.addresses.bulk-upload-modal')
    @endif
</span>
@stop


@section('content')
    
    <div class="row hidden-sm hidden-xs">
        {{-- Summary Row --}}
    </div>

    <div class="row">
        <div class="card">
            <div class="card-wrapper collapse in">
                <div class="card-body">

                    <div class="table-wrap">
                        <div class="table-responsive">
                            @include('hasob-foundation-core::pages.addresses.table')
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('hasob-foundation-core::pages.addresses.modal')

@endsection

@push('page_scripts')
@endpush