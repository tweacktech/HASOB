@if ($artifactable!=null)

    @php
        $artifactables = $artifactable->artifacts();
    @endphp


    <div class="row">
        <div class="col-lg-12">
            <div class="d-xl-flex align-items-center">
                <div class="d-flex align-items-center">
                    <div class="email-toggle-btn">
                        <i class="bx bx-menu"></i>
                    </div>
                    <div class="">
                        <button id="{{$control_id}}-add-attribute" type="button" class="btn btn-primary me-2 ms-2">
                            <i class="bx bx-plus me-0"></i> New Attribute
                        </button>
                    </div>
                    <div class="btn btn-white">
                        <input class="form-check-input" type="checkbox">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-white ms-2">
                            <i class="bx bx-refresh me-0"></i>
                        </button>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-white ms-2">
                            <i class="bx bx-upvote me-0"></i>
                        </button>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-white ms-2">
                            <i class="bx bx-downvote me-0"></i>
                        </button>
                    </div>
                    <div class="d-none d-md-flex">
                        <button type="button" class="btn btn-white ms-2">
                            <i class="bx bx-file me-0"></i>
                        </button>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-white ms-2">
                            <i class="bx bx-trash me-0"></i>
                        </button>
                    </div>
                </div>
                <div class="flex-grow-1 mx-xl-2 my-2 my-xl-0">
                    <div class="input-group">	
                        <span class="input-group-text bg-transparent">
                            <i class="bx bx-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search attributes">
                    </div>
                </div>
            </div>
            <div class="">
                @if (count($artifactables)>0)
                    <div class="">
                        <div class="email-list ps ps--active-y">
                            @foreach ($artifactables as $item)
                            <a href="#">
                                <div class="d-md-flex align-items-center email-message px-3 py-1">
                                    <div class="d-flex align-items-center email-actions">
                                        <input class="form-check-input" type="checkbox" value="" />
                                        <p class="mb-0"><b>{{ $item->key }}</b></p>
                                    </div>
                                    <div class="">
                                        <p class="mb-0">{{ $item->value }}</p>
                                    </div>
                                    <div class="ms-auto">
                                        <p class="mb-0 email-time">5:56 PM</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 530px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 233px;"></div></div></div>
                    </div>
                @else
                    <div class="">
                        <div class="ps ps--active-y">
                            <h6 class="text-center mt-20" style="margin-top:20px!important;">No Attributes</h6>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade" id="{{$control_id}}-attribute-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 id="lbl-{{$control_id}}-modal-title" class="modal-title">New Attribute</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    <div id="div-{{$control_id}}-modal-error" class="alert alert-danger" role="alert"></div>
                    <form class="form-horizontal" id="frm-{{$control_id}}-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                        <div class="row">
                            <div class="col-lg-12 ma-10">
                                
                                @csrf

                                <!-- Name Field -->
                                <div id="div-{{$control_id}}-attribute-name" class="form-group">
                                    <label for="{{$control_id}}-attribute-name" class="col-lg-3 col-form-label">Name</label>
                                    <div class="col-lg-12">
                                        {!! Form::text("{$control_id}-attribute-name", null, ['id'=>"{$control_id}-attribute-name", 'class' => 'form-control','minlength' => 1,'maxlength' => 1000]) !!}
                                    </div>
                                </div>

                                <!-- Value Field -->
                                <div id="div-{{$control_id}}-attribute-value" class="form-group">
                                    <label for="{{$control_id}}-attribute-value" class="col-lg-3 col-form-label"></label>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Attribute Value" id="{{$control_id}}-attribute-value" name="{{$control_id}}-attribute-value" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </form>
                </div>
    
            
                <div class="modal-footer" id="div-save-mdl-{{$control_id}}-modal">
                    <button type="button" class="btn btn-primary px-5" id="btn-save-mdl-{{$control_id}}-modal" value="add">Save</button>
                </div>
    
            </div>
        </div>
    </div>
    

    @push('page_scripts')
        <script type="text/javascript">
            $(document).ready(function() {
            
                function hide_attribute_card(){
                    $("#div-{{$control_id}}-modal-error").html('');
                    $("#div-{{$control_id}}-modal-error").hide();
                }

                hide_attribute_card();

                //Show add new attribute modal
                $(document).on('click', "#{{$control_id}}-add-attribute", function(e) {
                    hide_attribute_card();
                    $('#{{$control_id}}-attribute-modal').modal('show');
                    $('#frm-{{$control_id}}-modal').trigger("reset");
                });

                //Load attribute details in editor on click
                $(document).on('click', ".page-editor-page-selected", function(e) {
                    
                    hide_attribute_card();

                    let itemId = $(this).attr('data-val');
                    $.get( "{{ route('fc-api.attributes.show','') }}/"+itemId).done(function( response ) {

                        $("#div-{{$control_id}}-page-editor").show();

                        $("#{{$control_id}}-selected-page-id").val(response.data.id);
                        $("#{{$control_id}}-page-text-name").val(response.data.page_name);
                        $("#{{$control_id}}-page_contents").summernote("code", response.data.content);

                    });

                });

                //New attribute save button
                $('#btn-save-mdl-{{$control_id}}-modal').click(function(e) {

                    e.preventDefault();
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
                    
                    let formData = new FormData();
                    formData.append('_token', $('input[name="_token"]').val());
                    formData.append('model_primary_id', '{{$artifactable->id}}');
                    formData.append('model_name', String.raw`{{ get_class($artifactable) }}`);            
                    formData.append('key', $('#{{$control_id}}-attribute-name').val());
                    formData.append('value', $('#{{$control_id}}-attribute-value').val());
                    formData.append('creator_user_id', "{{Auth::id()}}");
                    @if (isset($organization) && $organization!=null)
                        formData.append('organization_id', '{{$organization->id}}');
                    @endif

                    $.ajax({
                        url:"{{ route('fc-api.attributes.store') }}",
                        type: "POST",
                        data: formData,
                        cache: false,
                        processData:false,
                        contentType: false,
                        dataType: 'json',
                        success: function(result){
                            if(result.errors){
                                $('#div-{{$control_id}}-modal-error').html('');
                                $('#div-{{$control_id}}-modal-error').show();
                                $.each(result.errors, function(key, value){
                                    $('#div-{{$control_id}}-modal-error').append('<li class="">'+value+'</li>');
                                });
                            }else{
                                $('#div-{{$control_id}}-modal-error').hide();

                                window.setTimeout( function(){
                                    $('#div-{{$control_id}}-modal-error').hide();
                                    swal({
                                            title: "Saved",
                                            text: "Attribute saved successfully",
                                            type: "success",
                                            showCancelButton: false,
                                            confirmButtonClass: "btn-success",
                                            confirmButtonText: "OK",
                                            closeOnConfirm: true
                                        },function(){
                                            //Refresh the attribute list
                                            //Close the modal screen
                                            //$('#{{$control_id}}-new-page-modal').modal('hide');
                                        }
                                    );
                                },20);
                            }
                            
                        }, error: function(data){
                            console.log(data);
                            swal("Error", "Oops an error occurred. Please try again.", "error");

                        }
                    });
                });

                //Save attribute details
                $('#{{$control_id}}-save-page').click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

                    let pagePrimaryId = $("#{{$control_id}}-selected-page-id").val();

                    let formData = new FormData();
                    formData.append('_token', $('input[name="_token"]').val());                
                    formData.append('_method', "PUT");
                    formData.append('id', pagePrimaryId);
                    formData.append('page_name', $('#{{$control_id}}-page-text-name').val());
                    formData.append('content', $('#{{$control_id}}-page_contents').summernote('code'));
                    //formData.append('is_hidden', $('#{{$control_id}}-page-text-is_hidden').val());
                    //formData.append('is_published', $('#{{$control_id}}-page-text-is_published').val());
                    formData.append('creator_user_id', "{{Auth::id()}}");
                    @if (isset($organization) && $organization!=null)
                        formData.append('organization_id', '{{$organization->id}}');
                    @endif

                    $.ajax({
                        url: "{{ route('fc-api.attributes.update','') }}/"+pagePrimaryId,
                        type: "POST",
                        data: formData,
                        cache: false,
                        processData:false,
                        contentType: false,
                        dataType: 'json',
                        success: function(result){
                            if(result.errors){
                                $('#div-{{$control_id}}-page-text-error').html('');
                                $('#div-{{$control_id}}-page-text-error').show();
                                
                                $.each(result.errors, function(key, value){
                                    $('#div-{{$control_id}}-page-text-error').append('<li class="">'+value+'</li>');
                                });
                            }else{
                                $('#div-{{$control_id}}-page-text-error').hide();
                                window.setTimeout(function(){
                                    swal({
                                        title: "Saved",
                                        text: "Page saved successfully",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: true},
                                        function(){}
                                    );
                                },20);
                            }
                        }, error: function(data){
                            console.log(data);
                            swal("Error", "Oops an error occurred. Please try again.", "error");
                        }
                    });
                });

            });
        </script>
    @endpush

@endif