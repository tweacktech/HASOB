
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="card pa-0" style="border-radius:7px;">
        <div class="card-wrapper collapse in">
            <div class="card-body pa-0">
                <div class="sm-data-box">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 pa-10">

                                <div class="float-start">
                                    <div class="float-start user-img-wrap mr-15">
                                        <img class="user-auth-img card-user-img img-circle float-start" src="{{asset('imgs/user.png')}}" alt="user">
                                    </div>
                                    <div class="float-start user-detail-wrap pt-5">	
                                        @php
                                            $detail_page_url = route('fc.addresses.show', $data_item->id);
                                        @endphp
                                        <span class="block card-user-name">
                                            <a href='{{$detail_page_url}}'>{{$data_item->id}}</a><br/>
                                            <span class="small">Sub text</span>
                                        </span>
                                    </div>
                                </div>

                                <div class="float-end pt-5">
                                    <a data-toggle="tooltip" 
                                        title="Edit" 
                                        data-val='{{$data_item->id}}' 
                                        class="btn-edit-mdl-address-modal inline-block mr-5" href="#">
                                        <i class="zmdi zmdi-border-color txt-warning" style="opacity:80%"></i>
                                    </a>

                                    <a data-toggle="tooltip" 
                                        title="Delete" 
                                        data-val='{{$data_item->id}}' 
                                        class="btn-delete-mdl-address-modal inline-block mr-5" href="#">
                                        <i class="zmdi zmdi-delete txt-danger" style="opacity:80%"></i>
                                    </a>
                                </div>

                                <div class="clearfix"></div>

                            </div>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>