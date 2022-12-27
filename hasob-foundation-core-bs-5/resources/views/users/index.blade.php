@extends(config('hasob-foundation-core.view_layout'))

@php
$hide_right_panel = true;
@endphp

@section('title_postfix')
System Users
@stop

@section('page_title')
System Users
@stop

@section('app_css')
    @include('layouts.datatables_css')
@stop

@section('page_title_subtext')
<a class="ms-1" href="{{ route('dashboard') }}">
    <i class="bx bx-chevron-left"></i> Back to Dashboard
</a> 
@stop

@section('content')

<div class="card">
    <div class="card-body">
        {!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered mt-3']) !!}
    </div>
</div>

@stop


@push('page_scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $(document).ready(function() {
           
            $('.buttons-csv').hide();
            $('.buttons-pdf').hide();
            $('.buttons-print').hide();
            $('.buttons-excel').hide();
        });
    </script>    

@endpush