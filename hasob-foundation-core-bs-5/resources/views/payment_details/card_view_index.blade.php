@extends('layouts.app')

@section('app_css')
    {!! $cdv_payment_details->render_css() !!}
@endsection

@section('title_postfix')
Payment Details
@stop

@section('page_title')
Payment Details
@stop

@section('page_title_buttons')
<span class="float-end">
    <a id="btn-new-mdl-paymentDetail-modal" class="btn btn-xs btn-primary btn-new-mdl-paymentDetail-modal" href="#">
        <i class="zmdi zmdi-file-plus"></i> New&nbsp;Payment Detail
    </a>
    @if (Auth()->user()->hasAnyRole(['','admin']))
        @include('hasob-foundation-core::pages.payment_details.bulk-upload-modal')
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
                <div class="card-body pt-5">
                    {{ $cdv_payment_details->render() }}
                </div>
            </div>
        </div>
    </div>

    @include('hasob-foundation-core::pages.payment_details.modal')
    
@endsection

@push('page_scripts')
    {!! $cdv_payment_details->render_js() !!}
@endpush