@extends(config('hasob-foundation-core.view_layout'))


@section('title_postfix')
{{ $ledger->name }}
@stop

@section('page_title')
{{ $ledger->name }}
<span class="text-success pull-right">
    Balance: {{ number_format($ledger->balance(),2) }}
</span>
@stop

@section('app_css')   
@endsection

@section('content')

    <x-hasob-foundation-core::ledger-entries :ledger="$ledger" />

@stop
