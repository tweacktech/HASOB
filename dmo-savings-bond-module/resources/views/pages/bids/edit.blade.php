@extends('layouts.app')

@section('app_css')
@stop

@section('title_postfix')
Edit Bid
@stop

@section('page_title')
Edit Bid
@stop

@section('page_title_subtext')
<a class="ms-1" href="{{ route('sb.bids.show', $bid->id) }}">
    <i class="bx bx-chevron-left"></i> Back to Bid Details
</a>
@stop

@section('page_title_buttons')
<a href="{{ route('sb.bids.create') }}" id="btn-new-bids" class="btn btn-primary">
    <i class="bx bx-book-add mr-1"></i>New Bid
</a>
@stop

@section('content')
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-4">

        <div class="card-title d-flex align-items-center">
            <div>
                <i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Modify Bid Details</h5>
        </div>

        {!! Form::model($bid, ['class'=>'form-horizontal', 'route' => ['sb.bids.update', $bid->id], 'method' => 'patch']) !!}

            @include('dmo-savings-bond-module::pages.bids.fields')

            <div class="col-lg-offset-3 col-lg-9">
                <hr/>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('sb.bids.show', $bid->id) }}" class="btn btn-warning btn-default">Cancel</a>
            </div>
        {!! Form::close() !!}                

    </div>
</div>
@stop

@section('side-panel')
<div class="card radius-5 border-top border-0 border-4 border-primary">
    <div class="card-body">
        <div><h5 class="card-title">More Information</h5></div>
        <p class="small">
            This is the help message.
            This is the help message.
            This is the help message.
        </p>
    </div>
</div>
@stop

@push('page_scripts')
@endpush