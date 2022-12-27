@extends(config('hasob-foundation-core.view_layout'))


@section('title_postfix')
User Profile
@stop

@section('page_title')
User Profile
@stop

@section('page_title_subtext')
    <a class="ml-10 mb-10" href="{{ route('dashboard') }}" style="font-size:11px;color:blue;">
        <i class="fa fa-angle-double-left"></i> Back to Dashboard
    </a>
@stop


@section('content')

    

    <div class="row">

        <div class="col-lg-4">
            @include('hasob-foundation-core::users.partials.user-badge')
        </div>

        <div class="col-lg-8">
            <div class="card border-top border-0 border-4 border-primary">
                
                <div class="card-body">

                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0 text-primary">Details</h5>
                        <div class="ms-auto">
                            @if ($edit_mode == false)
                            <a href="{{ route('fc.users.profile','edit=1') }}" >
                                
                                <button id="btn-add" class="btn btn-sm btn btn-outline-primary mt-1 me-2 py-1  px-1 small">
                                   <i class="fa  fa-edit fa-fw" aria-hidden="true"></i> Modify
                                </button>
                            </a>
                            @endif
                        </div>
                    </div>

                    <hr class="my-1" />

                    @if ($edit_mode == false)
                        @include('hasob-foundation-core::users.partials.user-display')
                    @else
                        @include('hasob-foundation-core::users.partials.user-detail')

                        <div class="col-xs-9 col-xs-offset-3 card-text mt-3">
                            <button data-val="{{Auth::id()}}" type="button" class="btn btn-primary" id="save">  <span class="glyphicon glyphicon-ok"></span> &nbsp;Save Changes</button>

                            <a href="{{ route('fc.users.profile') }}">
                                <button type="button" class="btn btn-warning"> <span class="glyphicon glyphicon-remove"></span> Cancel </button>
                            </a>

                        </div>
                        <br/>
                    @endif

                    <br/>                
                </div>
            </div>
        </div>


    </div>

@stop


@push('page_scripts')

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>    

@endpush