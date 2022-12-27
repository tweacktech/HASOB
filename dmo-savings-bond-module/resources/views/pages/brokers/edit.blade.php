@extends('layouts.app')

@section('app_css')
@stop

@section('title_postfix')
Edit Broker
@stop

@section('page_title')
Edit Broker
@stop

@section('page_title_subtext')
<a class="ms-1" href="{{ route('sb.brokers.show', $broker->id) }}">
    <i class="bx bx-chevron-left"></i> Back to Broker Details
</a>
@stop

@section('page_title_buttons')
<a href="{{ route('sb.brokers.create') }}" id="btn-new-brokers" class="btn btn-primary">
    <i class="bx bx-book-add mr-1"></i>New Broker
</a>
@stop

@section('content')
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-4">

        <div class="card-title d-flex align-items-center">
            <div>
                <i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Modify Broker Details</h5>
        </div>

        {!! Form::model($broker, ['class'=>'form-horizontal', 'route' => ['sb.brokers.update', $broker->id], 'method' => 'patch']) !!}

            @include('dmo-savings-bond-module::pages.brokers.fields')

            <div class="col-lg-offset-3 col-lg-9">
                <hr/>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('sb.brokers.show', $broker->id) }}" class="btn btn-warning btn-default">Cancel</a>
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