<div class="card department-item">
    <div class="row g-0">
        <div class="col-lg-2">
            <center>
                <a href="{{ route('fc.departments.show',$department->id) }}">
                    @if ( $department->logo_image != null )
                        <img class="mx-2 my-4 img-fluid" alt="..." src="../imgs/logo.png" />
                    @else
                        <i class="fa fa-3x fa-hospital-o mt-4 ml-3"></i>
                    @endif
                </a>
            </center>
        </div>
        <div class="col-lg-10">
            <div class="card-body">
                    

                <div class="d-flex align-items-center">
                    <div><h4 class="card-title"><a href="{{ route('fc.departments.show',$department->id) }}">{{ $department->long_name }}</a></h4></div>
                    @if (\Auth::user()!=null && \Auth::user()->hasAnyRole('admin','department-admin'))
                    <div class="ms-auto"> 
                        <a data-toggle="tooltip" 
                            title="Edit" 
                            data-val="{{$department->id}}" 
                            data-toggle="tooltip" 
                            data-original-title="Edit"
                            class="btn-edit-mdl-department-modal inline-block mr-5" href="#">
                            <i class="bx bxs-edit txt-warning" style="opacity:80%"></i>
                        </a>

                        <a data-toggle="tooltip" 
                            title="Delete" 
                            data-val="{{$department->id}}" 
                            data-toggle="tooltip" 
                            data-original-title="Delete"
                            class="btn-delete-mdl-department-modal inline-block mr-5" href="#">
                            <i class="bx bxs-trash-alt txt-danger" style="opacity:80%"></i>
                        </a>
                    </div>
                    @endif
                </div>

                <div class="clearfix">
                    <p class="mb-0 fw-bold"> {!! $department->physical_location !!}</p>
                    <p class="mb-0 fst-italic">
                        <span>
                            @if (isset($department->telephone) && empty($department->telephone) == false)
                                {!! $department->telephone !!} 
                            @endif
                            @if (isset($department->email) && empty($department->email) == false)
                                {!! $department->email !!}
                            @endif
                        </span>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>