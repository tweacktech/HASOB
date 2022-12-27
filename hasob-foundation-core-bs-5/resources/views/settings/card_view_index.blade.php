@extends('layouts.app')

@section('app_css')
    {!! $cdv_settings->render_css() !!}
@endsection

@section('title_postfix')
Settings
@stop

@section('page_title')
Settings
@stop

@section('page_title_buttons')
<span class="pull-right">
    <a id="btn-new-mdl-setting-modal" class="btn btn-xs btn-primary pull-right btn-new-mdl-setting-modal" href="#">
        <i class="zmdi zmdi-file-plus"></i> New&nbsp;Setting
    </a>
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
                    {{ $cdv_settings->render() }}
                </div>
            </div>
        </div>
    </div>

    @include('hasob-foundation-core::pages.settings.modal')
    
@endsection

@push('page_scripts')
    {!! $cdv_settings->render_js() !!}
@endpush