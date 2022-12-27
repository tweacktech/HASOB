@extends('layouts.app')

@section('app_css')
    {!! $cdv_site_artifacts->render_css() !!}
@endsection

@section('title_postfix')
Site Artifacts
@stop

@section('page_title')
Site Artifacts
@stop

@section('page_title_buttons')
<span class="float-end">
    <a id="btn-new-mdl-siteArtifact-modal" class="btn btn-xs btn-primary btn-new-mdl-siteArtifact-modal" href="#">
        <i class="zmdi zmdi-file-plus"></i> New&nbsp;Site Artifact
    </a>
    @if (Auth()->user()->hasAnyRole(['','admin']))
        @include('hasob-foundation-core::pages.site_artifacts.bulk-upload-modal')
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
                    {{ $cdv_site_artifacts->render() }}
                </div>
            </div>
        </div>
    </div>

    @include('hasob-foundation-core::pages.site_artifacts.modal')
    
@endsection

@push('page_scripts')
    {!! $cdv_site_artifacts->render_js() !!}
@endpush