@extends('layouts.app')


@section('title_postfix')
Batch Items
@stop

@section('page_title')
Batch Items
@stop

@section('page_title_buttons')
<span class="float-end">
    <a id="btn-new-mdl-batchItem-modal" class="btn btn-xs btn-primary btn-new-mdl-batchItem-modal" href="#">
        <i class="zmdi zmdi-file-plus"></i> New&nbsp;Batch Item
    </a>
    @if (Auth()->user()->hasAnyRole(['','admin']))
        @include('hasob-foundation-core::pages.batch_items.bulk-upload-modal')
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
                            @include('hasob-foundation-core::pages.batch_items.table')
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('hasob-foundation-core::pages.batch_items.modal')

@endsection

@push('page_scripts')
@endpush