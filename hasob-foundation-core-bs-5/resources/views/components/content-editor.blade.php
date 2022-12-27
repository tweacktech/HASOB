@if ($pageable!=null)

    @php
        $pages = $pageable->pages();
    @endphp

    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-grid mb-2"> 
                        <a id="{{$control_id}}-add-page" href="javascript:;" class="btn btn-sm btn-primary">+ Add Content Page</a>
                    </div>
                    <div class="fm-menu">
                        <div id="{{$control_id}}-page-list" class="list-group list-group-flush"> 
                            @if ($pages!=null && count($pages)>0)
                                @foreach($pages as $idx=>$page)
                                <a href="javascript:;" class="list-group-item py-1 page-editor-page-selected" data-val="{{$page->id}}">
                                    <i class="bx bx-file me-2"></i><span>{{$page->page_name}}</span>
                                </a>
                                @endforeach
                            @else
                                <br/><br/>
                                <h6 class="text-center text-danger">No Pages</h6>
                                <br/><br/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div id="div-{{$control_id}}-page-editor" class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="div-{{$control_id}}-page-text-error" class="alert alert-danger" role="alert"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-5 mb-2">
                                    <input id="{{$control_id}}-selected-page-id" type="hidden" value="0"/>
                                    {!! Form::text("{$control_id}-page-text-name", null, ['id'=>"{$control_id}-page-text-name", 'class' => 'form-control','minlength' => 1,'maxlength' => 1000]) !!}
                                </div>
                                <div class="col-lg-2 mb-2">
                                    <div class="form-check form-switch pt-2">
                                        <input class="form-check-input" type="checkbox" id="{{$control_id}}-page-text-is_hidden" checked="">
                                        <label class="form-check-label" for="{{$control_id}}-page-text-is_hidden">Hidden</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 mb-2">
                                    <div class="form-check form-switch pt-2">
                                        <input class="form-check-input" type="checkbox" id="{{$control_id}}-page-text-is_published" checked="">
                                        <label class="form-check-label" for="{{$control_id}}-page-text-is_published">Published</label>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-2 text-end">
                                    <a id="{{$control_id}}-save-page" href="javascript:;" class="btn btn-sm btn-primary">Save</a>
                                    <a id="{{$control_id}}-delete-page" href="javascript:;" class="btn btn-sm btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <textarea id="{{$control_id}}-page_contents" name="{{$control_id}}-page_contents" class="summernote"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="{{$control_id}}-new-page-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
    
                <div class="modal-header">
                    <h5 id="lbl-{{$control_id}}-modal-title" class="modal-title">New Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                    <div id="div-{{$control_id}}-modal-error" class="alert alert-danger" role="alert"></div>
                    <form class="form-horizontal" id="frm-{{$control_id}}-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                        <div class="row">
                            <div class="col-lg-12 ma-10">
                                
                                @csrf

                                <!-- Name Field -->
                                <div id="div-{{$control_id}}-name" class="form-group">
                                    <label for="{{$control_id}}-page-name" class="col-lg-3 col-form-label">Name</label>
                                    <div class="col-lg-12">
                                        {!! Form::text("{$control_id}-page-name", null, ['id'=>"{$control_id}-page-name", 'class' => 'form-control','minlength' => 1,'maxlength' => 1000]) !!}
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </form>
                </div>
            
                <div class="modal-footer" id="div-save-mdl-{{$control_id}}-modal">
                    <button type="button" class="btn btn-primary px-5" id="btn-new-page-{{$control_id}}-modal" value="add">Save</button>
                </div>
    
            </div>
        </div>
    </div>
    

    @push('page_css')
    <link rel="stylesheet" href="{{ asset('hasob-foundation-core/assets/summernote-0.8.18-dist/summernote-lite.css') }}">
    @endpush

    @push('page_scripts')
    <script src="{{ asset('hasob-foundation-core/assets/summernote-0.8.18-dist/summernote-lite.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        
            function hide_editor_card(){
                $("#div-{{$control_id}}-page-editor").hide();
                $('#div-{{$control_id}}-modal-error').html('');
                $("#div-{{$control_id}}-page-text-error").hide();
            }

            hide_editor_card();

            $('#{{$control_id}}-page_contents').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    //['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['codeview']]
                    //['insert', ['link', 'picture']],
                    //['view', ['fullscreen', 'codeview']],
                ],
            });

            //Show add new page modal
            $(document).on('click', "#{{$control_id}}-add-page", function(e) {
                $('#div-{{$control_id}}-modal-error').hide();
                $('#{{$control_id}}-new-page-modal').modal('show');
                $('#frm-{{$control_id}}-modal').trigger("reset");
            });

            //Load page details in editor on click
            $(document).on('click', ".page-editor-page-selected", function(e) {
                
                hide_editor_card();

                let itemId = $(this).attr('data-val');        
                $.get( "{{ route('fc-api.pages.show','') }}/"+itemId).done(function( response ) {

                    $("#div-{{$control_id}}-page-editor").show();

                    $("#{{$control_id}}-selected-page-id").val(response.data.id);
                    $("#{{$control_id}}-page-text-name").val(response.data.page_name);
                    $("#{{$control_id}}-page_contents").summernote("code", response.data.content);

                });

            });

            //New page save button
            $('#btn-new-page-{{$control_id}}-modal').click(function(e) {

                e.preventDefault();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
                
                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('page_name', $('#{{$control_id}}-page-name').val());
                formData.append('creator_user_id', "{{Auth::id()}}");
                @if (isset($organization) && $organization!=null)
                    formData.append('organization_id', '{{$organization->id}}');
                @endif

                $.ajax({
                    url:"{{ route('fc-api.pages.store') }}",
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

                            if (result.data!=null && result.data.id!=null){
                                let formData = new FormData();
                                formData.append('_token', $('input[name="_token"]').val());
                                formData.append('page_id', result.data.id);
                                formData.append('pageable_id', '{{$pageable->id}}');
                                formData.append('pageable_type', String.raw`{{ get_class($pageable) }}`);
                                formData.append('creator_user_id', "{{Auth::id()}}");
                                @if (isset($organization) && $organization!=null)
                                    formData.append('organization_id', '{{$organization->id}}');
                                @endif

                                $.ajax({
                                    url:"{{ route('fc-api.pageables.store') }}", 
                                    type: "POST", data: formData, cache: false, 
                                    processData:false, contentType: false, dataType: 'json',
                                    success: function(result){},
                                    error: function(data){},
                                });
                            }
                            window.setTimeout( function(){
                                $('#div-{{$control_id}}-modal-error').hide();
                                swal({
                                        title: "Saved",
                                        text: "Page saved successfully",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: true
                                    },function(){
                                        $('#{{$control_id}}-new-page-modal').modal('hide');
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

            //Save details
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
                    url: "{{ route('fc-api.pages.update','') }}/"+pagePrimaryId,
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