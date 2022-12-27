@extends(config('hasob-foundation-core.view_layout'))


@section('title_postfix')
Features
@stop

@section('page_title')
Features
@stop

@section('app_css')   
@stop

@section('page_title_subtext')
<a class="ms-1" href="{{ route('dashboard') }}">
    <i class="bx bx-chevron-left"></i> Back to Dashboard
</a> 
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form method="POST" action="{{ route('fc.org-features-process') }}">
            @csrf

            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            @foreach ($features as $item=>$value)
                            <tr>
                                <td class="pa-0 pl-10" width="40%">
                                    {{ ucwords($item) }}
                                </td>
                                <td class="pa-0" width="60%">
                                    <div class="form-check mb-3">
                                        <input id="chk_{{$item}}" name="chk_{{$item}}" data-size="small" type="checkbox" class="js-switch form-check-input" value="1" {{$value?'checked':''}} />
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-xs btn-primary">Save Feature Settings</button>
                </div>
            </div>
        </form>

    </div>
</div>


@push('page_scripts')
<script type="text/javascript">

    var switchery = {};
    $.fn.initComponents = function () {
        var searchBy = ".js-switch";
        $(this).find(searchBy).each(function (i, html) {
            if (!$(html).next().hasClass("switchery")) {
                switchery[html.getAttribute('id')] = new Switchery(html, $(html).data());
            }
        });
    };

    $(document).ready(function(){ 
        $("body").initComponents();
    });

</script>
@endpush


@stop
