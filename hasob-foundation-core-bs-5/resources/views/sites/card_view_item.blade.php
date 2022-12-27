

<div class="col col-md-6 flex-column">
    <div class="card site-item">
        <div class="row g-0">
            <div class="col-lg-1 text-center">
                <!-- <center> -->
                    <a href="{{ route('fc.sites.show',$data_item->id) }}">
                        <i class="fa fa-3x fa-paper-plane-o mt-4 ml-3 fs-2"></i>
                    </a>
                <!-- </center> -->
            </div>
            <div class="col-lg-11">
                <div class="card-body">
                        
    
                    <div class="d-lg-flex align-items-center">
                        <div><h4 class="card-title mb-0"><a href="{{ route('fc.sites.show',$data_item->id) }}">{{ $data_item->site_name }}</a></h4></div>
                        <div class="ms-auto float-end"> 
                            <a data-bs-toggle="tooltip" 
                                title="view" 
                                data-val="{{$data_item->id}}" 
                                data-bs-toggle="tooltip" 
                                data-original-title="view"
                                class="btn-show-mdl-site-modal inline-block mr-5" href="#">
                                <i class="fa fa-files-o txt-primary" style="opacity:80%"></i>
                            </a>

                            @if (\Auth::user()!=null && \Auth::user()->hasAnyRole('admin','department-admin'))
                            <a data-bs-toggle="tooltip" 
                                title="Edit" 
                                data-val="{{$data_item->id}}" 
                                data-bs-toggle="tooltip" 
                                data-original-title="Edit"
                                class="btn-edit-mdl-site-modal inline-block mr-5" href="#">
                                <i class="bx bxs-edit txt-warning" style="opacity:80%"></i>
                            </a>
                            <a data-bs-toggle="tooltip" 
                                title="Delete" 
                                data-val="{{$data_item->id}}" 
                                data-bs-toggle="tooltip" 
                                data-original-title="Delete"
                                class="btn-delete-mdl-site-modal inline-block mr-5" href="#">
                                <i class="bx bxs-trash-alt txt-danger" style="opacity:80%"></i>
                            </a>
                            @endif
                        </div>
                        
                    </div>
    
                    <div class="clearfix">
                        <p class="mb-0 fst-italic"> 
                            @if (empty($data_item->description) == false)
                                {!! \Illuminate\Support\Str::limit($data_item->description,40,' ...') !!}
                            @else
                                No Description
                            @endif
                        </p>
                        <p class="mb-0">
                            <span>
                                @php
                                    $site_id = empty($data_item->site_path) ? $data_item->id : $data_item->site_path;
                                @endphp
                                <a href="{{ route('fc.site-display.index',$site_id) }}">
                                    {!! \Illuminate\Support\Str::limit(route('fc.site-display.index',$site_id),40,' ...') !!}
                                </a>
                            </span>
                        </p>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</div>
