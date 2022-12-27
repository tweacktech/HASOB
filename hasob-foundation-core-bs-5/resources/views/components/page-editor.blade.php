<div class="modal fade" id="mdl-page-editor-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 id="lbl-page-editor-modal-title" class="modal-title">Page Editor</h4>
            </div>

            <div class="modal-body">
                <div id="div-page-editor-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-page-editor-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-5">
                            @csrf

                            <div id="editor-spinner1" class="">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <input type="hidden" id="txt-page-editor-primary-id" value="0" />
                            
                            <div id="div-edit-txt-page-editor-primary-id">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <textarea id="page_contents" name="page_contents" class="summernote"></textarea>
                                    </div>
                                    <div class="col-lg-3">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-primary" id="btn-save-mdl-page-editor-modal" value="add">
                      <span id='spinner' class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      <span class="visually-hidden">Loading...</span>
                      Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_css')
<link rel="stylesheet" href="{{ asset('vendor/summernote/summernote.css') }}">
@endpush

@push('page_scripts')
<script src="{{ asset('vendor/summernote/summernote.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
    
        $('#page_contents').summernote({
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });    

        //Show Modal for New Entry
        $(document).on('click', ".btn-new-mdl-page-editor-modal", function(e) {
            $('#div-page-editor-modal-error').hide();
            $('#mdl-page-editor-modal').modal('show');
            $('#frm-page-editor-modal').trigger("reset");
            $('#txt-page-editor-primary-id').val(0);

            $('#editor-spinner1').hide();
            $('#btn-save-mdl-page-editor-modal').prop("disabled", false);
        });

        //Show Modal for Edit Entry
        $(document).on('click', ".btn-edit-mdl-page-editor-modal", function(e) {
            $('#div-page-editor-modal-error').hide();
            $('#mdl-page-editor-modal').modal('show');
            $('#frm-page-editor-modal').trigger("reset");

            $('#editor-spinner1').show();
            $('#btn-save-mdl-page-editor-modal').prop("disabled", true);

            let itemId = $(this).attr('data-val');        
            $.get( "{{ route('fc.pages.show','') }}/"+itemId).done(function( data ) {

                $('#txt-page-editor-primary-id').val(data.response.id);
                $("#page_contents").summernote("code", data.response.content);

                $('#editor-spinner1').hide();
                $('#btn-save-mdl-page-editor-modal').prop("disabled", false);
            });

        });
        
        //Save details
        $('#btn-save-mdl-page-editor-modal').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
    
            $('#editor-spinner1').show();
            $('#btn-save-mdl-page-editor-modal').prop("disabled", true);

            let actionType = "POST";
            let endPointUrl = "{{ route('fc.pages.store') }}";
            let primaryId = $('#txt-page-editor-primary-id').val();
            
            let formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
    
            if (primaryId != "0"){
                actionType = "PUT";
                endPointUrl = "{{ route('fc.pages.update','') }}/"+primaryId;
                formData.append('id', primaryId);
            }
            
            formData.append('_method', actionType);
            formData.append('page_name', $('#page_name').val());
    
            $.ajax({
                url:endPointUrl,
                type: actionType,
                data: formData,
                cache: false,
                processData:false,
                contentType: false,
                dataType: 'json',
                success: function(result){

                    if(result.errors){
                        $('#div-page-editor-modal-error').html('');
                        $('#div-page-editor-modal-error').show();
                        
                        $.each(result.errors, function(key, value){
                            $('#div-page-editor-modal-error').append('<li class="">'+value+'</li>');
                        });
                    }else{
                        $('#div-page-editor-modal-error').hide();
                        window.setTimeout( function(){
                            window.alert("Page saved successfully.");
                            $('#div-page-editor-modal-error').hide();
                            location.reload(true);
                        },20);
                    }

                    $('#editor-spinner1').hide();
                    $('#btn-save-mdl-page-editor-modal').prop("disabled", false);

                }, error: function(data){
                    console.log(data);

                    $('#editor-spinner1').hide();
                    $('#btn-save-mdl-page-editor-modal').prop("disabled", false);
                }
            });
        });
    
    
    });
    </script>
@endpush