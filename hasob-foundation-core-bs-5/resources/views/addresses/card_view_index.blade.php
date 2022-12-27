@extends('layouts.app')

@section('app_css')
    {!! $cdv_addresses->render_css() !!}
@endsection

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
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pt-5">
                    {{ $cdv_addresses->render() }}
                </div>
            </div>
        </div>
    </div>

    @include('hasob-foundation-core::pages.addresses.modal')
    
@endsection

@push('page_scripts')
    {!! $cdv_addresses->render_js() !!}
@endpush