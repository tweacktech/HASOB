@extends('layouts.app')

@section('app_css')
    {!! $cdv_pages->render_css() !!}
@endsection

@section('title_postfix')
Pages
@stop

@section('page_title')
Pages
@stop

@section('page_title_buttons')
<span class="float-end">
    <a id="btn-new-mdl-page-modal" class="btn btn-xs btn-primary btn-new-mdl-page-modal" href="#">
        <i class="zmdi zmdi-file-plus"></i> New&nbsp;Page
    </a>
    @if (Auth()->user()->hasAnyRole(['','admin']))
        @include('hasob-foundation-core::pages.pages.bulk-upload-modal')
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
                    {{ $cdv_pages->render() }}
                </div>
            </div>
        </div>
    </div>

    @include('hasob-foundation-core::pages.pages.modal')
    
@endsection

@push('page_scripts')
    {!! $cdv_pages->render_js() !!}
@endpush