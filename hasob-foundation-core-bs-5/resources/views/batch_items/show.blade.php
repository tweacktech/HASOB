@extends('layouts.app')

@section('title_postfix')
Batch Item Details
@stop

@section('page_title')
Batch Item Details
@stop

@section('page_title_subtext')
    <a class="ml-10 mb-10" href="{{ route('fc.batchItems.index') }}" style="font-size:11px;color:blue;">
        <i class="fa fa-angle-double-left"></i> Back to Batch Item List
    </a>
@stop

@section('page_title_buttons')
<span class="float-end">
    <div class="float-end inline-block dropdown mb-15">
        <a href="#" data-val='{{$batchItem->id}}' class='btn btn-xs btn-primary btn-edit-mdl-batchItem-modal'>
            <i class="icon wb-reply" aria-hidden="true"></i>Edit Batch Item
        </a>
    </div>
</span>
@stop

@section('content')
    <div class="card">
        <div class="card-wrapper collapse in">
            <div class="card-body">
                <div class="form-wrap">
                    <div class="row">
                        @include('hasob-foundation-core::pages.batch_items.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
