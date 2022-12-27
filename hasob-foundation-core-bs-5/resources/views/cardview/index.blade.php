

<div class="row mb-15">
    <div class="col-sm-7">
        @if ($data_set_group_list != null && count($data_set_group_list)>0)
        @foreach($data_set_group_list as $key=>$group)
            <button data-val="{{$key}}" class="{{$control_id}}-grp btn btn-xxs btn-primary btn-outline faded mr-5">{{$key}}</button>
        @endforeach
        @endif
    </div>
    <div class="col-sm-5">
        @if ($data_set_enable_search == true)
        <div class="input-group mb-3"> 
            <input type="text" id="{{$control_id}}-txt-search" name="{{$control_id}}-txt-search" class="form-control form-control-sm" placeholder="{{ $search_placeholder_text }}" style="">
            <span class="input-group-btn">
                <button id="{{$control_id}}-btn-search" name="{{$control_id}}-btn-search" type="button" class="btn btn-xs btn-primary btn-outline faded"><i class="fa fa-search"></i></button>
            </span>
        </div>
        @endif
    </div>
</div>
<div class="offline-flag"><span class="offline">You are currently offline</span></div>
<div id="spinner-{{$control_id}}" class="row">
    <div class="loader" id="loader-{{$control_id}}"></div>
</div>
<div id="{{$control_id}}-div-card-view" class="row"></div>

@if ($data_set_enable_pagination == true)
<div class="row">
    <div class="col-xs-12">
        <ul id="{{$control_id}}-pagination" class="pagination ma-0"></ul>
    </div>
</div>
@endif