
    <div class="card">
        <div class="card-body">
            @if (isset($settings) && count($settings)>0)
                <ul class="nav nav-tabs nav-primary" role="tablist" id="settings_tab">
                    @foreach($groups as $idx=>$group)
                        @if($group)
                            @php
                                $active_str = "";
                                if ($idx == 0){
                                    $active_str = "active";
                                }
                            @endphp
                            <li class="nav-item" role="presentation">
                                <a id="tab_{{$idx}}" class="nav-link {{ $active_str }}" data-bs-toggle="tab" href="#settings_tab_{{$idx}}" role="tab" aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        {{-- <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i></div> --}}
                                        <div class="tab-title">{{ $group }} </div>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="tab-content py-3" id="settins_tab_content">
                    @foreach($groups as $idx=>$group)
                    @php
                        $active_str = "";
                        if ($idx == 0){
                            $active_str = "active";
                        }
                    @endphp
                    <div id="settings_tab_{{$idx}}" class="tab-pane fade show {{ $active_str }}" role="tabpanel">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        @foreach ($settings as $item)
                                        @php
                                            if ($item->group_name != $group){
                                                continue;
                                            }
                                        @endphp
                                        <tr>
                                            <td width="20px" class="text-center">
                                                <a href="javascript:void(0)" class="pr-5 text-primary btn-edit-mdl-setting-modal" data-val="{{$item->id}}" data-toggle="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip563536">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <em>{{$item->display_name}}</em>
                                                @if (empty($item->value))
                                                    &nbsp;<span class="txt-danger small"> - No value set</span>
                                                @else
                                                    <blockquote class="ma-5 small pa-10">
                                                        @if($item->display_type=="boolean")
                                                            @if (filter_var($item->value,FILTER_VALIDATE_BOOLEAN)==true)
                                                            Selected - Enabled
                                                            @else
                                                            Disenabled
                                                            @endif
                                                        @elseif($item->display_type=="file-select")
                                                            <div class="size-container">
                                                                <img src="{{ route('fc.attachment.show', $item->value) }}" />
                                                            </div>
                                                            <a target="_blank" class="small txt-danger ma-5" href="{{ route('fc.attachment.show', $item->value) }}">View Full Image</a>
                                                        @elseif($item->display_type=="textarea")
                                                            {!! nl2br($item->value) !!}
                                                        @else
                                                            {{ $item->value }}
                                                        @endif
                                                    </blockquote>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p>No Settings, use the add button to add a setting.</p>
            @endif
        </div>
    </div>
        
    <div class="modal fade" id="mdl-setting-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Application Setting </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="div-setting-modal-error" class="alert alert-danger" role="alert"></div>
                    <form class="form-horizontal" id="frm-setting-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                        <div class="row">
                            <div class="col-lg-12 ma-10">
                                @csrf

                                

                                <input type="hidden" id="txt-setting-primary-id" value="0" />
                                <input type="hidden" id="txt-setting-display-type" value="0" />

                                <div id="div-edit-txt-setting-primary-id">
                                    <div class="row">
                                        <div class="col-lg-11 ma-10">
                                        
                                            <div id="div-value-key" class="form-group">
                                                <div class="col-sm-12">
                                                    <span id="key" name="key"></span>
                                                </div>
                                            </div>

                                            <div id="div-value" class="form-group">
                                                <div class="col-sm-12">
                                                    
                                                    <textarea id="value-textarea" rows="8" class="form-control"></textarea>
                                                
                                                    <input type="text" id="value-text" class="form-control" />
                                                
                                                    <div id="div-check-box" class="checkbox checkbox-primary">
                                                        <input id="value-cbx" type="checkbox">
                                                        <label for="checkbox2">
                                                            Selected - Enabled
                                                        </label>
                                                    </div>
                                                
                                                    <div id="div-file-select" class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                        <div class="form-control" data-trigger="fileinput"> 
                                                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                                            <span class="fileinput-filename"></span>
                                                        </div>
                                                        <span class="input-group-addon fileupload btn btn-primary btn-anim btn-file">
                                                            <i class="fa fa-upload"></i> 
                                                            <span class="fileinput-new btn-text">Select file
                                                        </span> 
                                                        <span class="fileinput-exists btn-text">Change</span>
                                                            <input type="hidden"><input id="value-file" type="file" name="...">
                                                        </span> 
                                                        <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput">
                                                            <i class="fa fa-trash"></i><span class="btn-text"> Remove</span>
                                                        </a> 
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <hr class="light-grey-hr mb-10" />
                    <button type="button" class="btn btn-primary" id="btn-save-mdl-setting-modal" value="add">
                    <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="visually-hidden">Loading...</span>Save</button>
                </div>

            </div>
        </div>
    </div>


@push('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
    
        //Show Modal for New Entry
        $(document).on('click', "#btn-save-mdl-setting-modal", function(e) {
            // $('.btn-new-mdl-setting-modal').hide()
            $('#div-setting-modal-error').hide();
            $('#mdl-setting-modal').modal('show');
            $('#frm-setting-modal').trigger("reset");
            $('#txt-setting-primary-id').val(0);

            $('#div-show-txt-setting-primary-id').hide();
            $('#div-edit-txt-setting-primary-id').show();

            $(".spinner-settings").hide();
            $("#spinner").hide();
            $("#btn-save-mdl-setting-modal").attr('disabled', false);
        });

        //Show Modal for Edit
        $(document).on('click', ".btn-edit-mdl-setting-modal", function(e) {
            e.preventDefault();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

            $('#div-setting-modal-error').hide();
            $('#mdl-setting-modal').modal('show');
            $('#frm-setting-modal').trigger("reset");

            $(".spinner-settings").hide();
            $("#spinner").hide();
            $("#btn-save-mdl-setting-modal").attr('disabled', false);

            $('#div-show-txt-setting-primary-id').hide();
            $('#div-edit-txt-setting-primary-id').show();
            let itemId = $(this).attr('data-val');

            $('#key').empty();
            $('#value-text').hide();
            $('#div-check-box').hide();
            $('#value-textarea').hide();
            $('#div-file-select').hide();

            $.get( "{{ route('fc-api.settings.show','') }}/"+itemId).done(function( data ) {     

                console.log(data, data.data);
                $(".spinner-settings").hide();

                $('#txt-setting-primary-id').val(data.data.id);
                $('#txt-setting-display-type').val(data.data.display_type);
               $('#key').append(data.data.display_name);

                if (data.data.display_type=="file-select"){
                    $('#div-file-select').show();

                } else if (data.data.display_type=="textarea"){
                    $('#value-textarea').show();
                    $('#value-textarea').val(data.response.value);

                } else if (data.data.display_type=="boolean"){
                    $('#div-check-box').show();
                    if (data.data.value && data.data.value==true){
                        $('#value-cbx').prop("checked", true);
                    }

                } else {
                    $('#value-text').show();
                    $('#value-text').val(data.data.value);
                } 
            $("#spinner").hide();
            $("#btn-save-mdl-setting-modal").attr('disabled', false);
                
                // $("btn-save-mdl-setting-modal").attr('disabled', false);  
            });
        });

        //Delete action
        $(document).on('click', ".btn-delete-mdl-setting-modal", function(e) {
            e.preventDefault();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

            let itemId = $(this).attr('data-val');
             swal({
                title: "Are you sure you want to delete this Setting?",
                text: "You will not be able to recover this Setting record if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                let endPointUrl = "{{ route('fc-api.settings.destroy',0) }}"+itemId;

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('_method', 'DELETE');
                
                $.ajax({
                    url:endPointUrl,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData:false,
                    contentType: false,
                    dataType: 'json',
                    success: function(result){
                        if(result.errors){
                            console.log(result.errors)
                        }else{
                             swal({
                                        title: "Deleted",
                                        text: "The Setting has been deleted.",
                                        type: "success",
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: false
                                    })
                                    setTimeout(function(){
                                        location.reload(true);
                                }, 1000);
                        }
                    },
                });            
            }
        });
    });
        //Save details
        $('#btn-save-mdl-setting-modal').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

            $("#spinner").show();
            $("#btn-save-mdl-setting-modal").attr('disabled', true);

            let actionType = "POST";
            let endPointUrl = "{{ route('fc-api.settings.store') }}";
            let primaryId = $('#txt-setting-primary-id').val();
            
            let formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());

            if (primaryId != "0"){
                actionType = "PUT";
                endPointUrl = "{{ route('fc-api.settings.update','') }}/"+primaryId;
                formData.append('id', primaryId);
            }
            
            formData.append('_method', actionType);
            
            @if (isset($organization) && $organization!=null)
                formData.append('organization_id', '{{$organization->id}}');
            @endif

            display_type = $('#txt-setting-display-type').val();
            if (display_type=="file-select"){
                $('#div-file-select').show();
                formData.append('value', $('#value-file')[0].files[0]);

            } else if (display_type=="textarea"){
                formData.append('value', $('#value-textarea').val());

            } else if (display_type=="boolean"){
                $('#div-check-box').show();
                formData.append('value', $('#value-cbx').prop("checked"));

            } else {
                formData.append('value', $('#value-text').val());
            }

            $.ajax({
                url:endPointUrl,
                type: "POST",
                data: formData,
                cache: false,
                processData:false,
                contentType: false,
                dataType: 'json',
                success: function(result){
                    if(result.errors){
                        $('#div-setting-modal-error').html('');
                        $('#div-setting-modal-error').show();
                        
                        $.each(result.errors, function(key, value){
                            $('#div-setting-modal-error').append('<li class="">'+value+'</li>');
                        });
                    }else{
                        $('#div-setting-modal-error').hide();
                       
                           
                            swal({
                                title: "Saved",
                                text: "The Setting saved successfully.",
                                type: "success",
                                showCancelButton: false,
                                closeOnConfirm: false,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "OK",
                                closeOnConfirm: false
                            })

                            setTimeout(function(){
                                location.reload(true);
                        }, 1000)
                        
                    }

                    $("#spinner").hide();
                    $("#btn-save-mdl-setting-modal").attr('disabled', false);
                    
                }, error: function(data){
                    console.log(data);

                    $("#spinner").hide();
                    $("#btn-save-mdl-setting-modal").attr('disabled', false);

                }
            });
        });    

    });
</script>
@endpush