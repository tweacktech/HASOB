@extends('layouts.app')


@section('title_postfix')
Settings
@stop

@section('page_title')
Settings
@stop

@section('page_title_buttons')
<span class="float-end">
    <a id="btn-new-mdl-setting-modal" class="btn btn-xs btn-primary float-end btn-new-mdl-setting-modal" href="#">
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
                <div class="card-body">

                    <div class="table-wrap">
                        <div class="table-responsive">
                            @include('hasob-foundation-core::pages.settings.table')
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('hasob-foundation-core::pages.settings.modal')

@endsection

@push('page_scripts')
@endpush