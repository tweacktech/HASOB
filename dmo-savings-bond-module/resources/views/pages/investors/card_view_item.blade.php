

<div class="card">
    
    <div class="row g-0">
        <div class="col-md-1">
            <img src="{{asset('imgs/user.png')}}" alt="..." class="card-img">
        </div>
        <div class="col-md-9">
            <div class="card-body">
                @php
                    $detail_page_url = route('sb.investors.show', $data_item->id);
                @endphp

                <div class="d-flex align-items-center">
                    <div><h4 class="card-title"><a href='{{$detail_page_url}}'>{{$data_item->id}}</a></h4></div>
                    <div class="ms-auto"> 
                        <a data-toggle="tooltip" 
                            title="Edit" 
                            data-val='{{$data_item->id}}' 
                            class="btn-edit-mdl-investor-modal inline-block mr-5" href="#">
                            <i class="bx bxs-edit txt-warning" style="opacity:80%"></i>
                        </a>

                        <a data-toggle="tooltip" 
                            title="Delete" 
                            data-val='{{$data_item->id}}' 
                            class="btn-delete-mdl-investor-modal inline-block mr-5" href="#">
                            <i class="bx bxs-trash-alt txt-danger" style="opacity:80%"></i>
                        </a>
                    </div>
                </div>

                <p class="card-text">Sub Text</p>
                <p class="card-text">
                    <small class="text-muted">
                        Created: {{ \Carbon\Carbon::parse($data_item->created_at)->format('l jS F Y') }} - {!! \Carbon\Carbon::parse($data_item->created_at)->diffForHumans() !!}
                    </small>
                </p>
            </div>
        </div>
    </div>

</div>
