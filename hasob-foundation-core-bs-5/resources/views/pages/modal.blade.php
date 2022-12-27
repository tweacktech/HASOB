

<div class="modal fade" id="mdl-page-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form class="form-horizontal" id="frm-page-modal" role="form" method="POST" enctype="multipart/form-data" action="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 id="lbl-page-modal-title" class="modal-title">Page Editor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="div-page-modal-error" class="alert alert-danger" role="alert"></div>
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                            <div id="spinner-pages" class="">
                                 <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="visually-hidden">Loading...</span>
                                <!-- <div class="loader" id="loader-1"></div> -->
                            </div>

                            <input type="hidden" id="txt-page-primary-id" value="0" />

                            <div class="col-sm-12">
                                {!! Form::text('page_name', null, ['class' => 'form-control','minlength' => 4,'maxlength' => 150, 'placeholder'=>'Page Name']) !!}
                            </div>
                            <div class="col-md-12">
                                <div id="page_contents" name="page_contents"></div>
                            </div>

                            {{-- 
                            <div class="row">
                                <div class="col-md-3">
                                    <div id="div-show-txt-page-primary-id">
                                        <div class="row">
                                            <div class="col-lg-10 ma-10">                            
                                            @include('hasob-foundation-core::pages.show_fields')
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div-edit-txt-page-primary-id">
                                        <div class="row">
                                            <div class="col-lg-10 ma-10">
                                            @include('hasob-foundation-core::pages.fields')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            --}}

                        </div>
                    </div>  
                </div>

                <div id="div-save-mdl-page-modal" class="modal-footer">
                    <hr class="light-grey-hr mb-10" />
                    <button type="button" class="btn btn-primary" id="btn-save-mdl-page-modal" value="add">
                    <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                     <span class="visually-hidden">Loading...</span>    
                    Save</button>
                </div>

            </div>
        </div>
    </form>
</div>


@push('page_css')
<style type="text/css">
    .note-btn {
        padding: 14px 14px !important;
    }

    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width:1200px;
        }
    }
</style>
<link rel="stylesheet" href="{{ asset('hasob-foundation-core/vendor/summernote/summernote.css') }}">
@endpush

@push('page_scripts')
<script src="{{ asset('hasob-foundation-core/vendor/summernote/summernote.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('.offline').hide();
    $('#spinner-pages spinner').hide()
    $('#div-save-mdl-page-modal span').hide();

    $('#page_contents').summernote({
        height: 300,
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
    $(document).on('click', ".btn-new-mdl-page-modal", function(e) {
        $('#div-page-modal-error').hide();
        $('#mdl-page-modal').modal('show');
        $('#frm-page-modal').trigger("reset");
        $('#txt-page-primary-id').val(0);

        $('#div-show-txt-page-primary-id').hide();
        $('#div-edit-txt-page-primary-id').show();

         $('div-save-mdl-page-modal span').hide();
        $("#div-save-mdl-page-modal").attr('disabled', false);
    });

   
    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-page-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $('#div-page-modal-error').hide();
        $('#mdl-page-modal').modal('show');
        $('#frm-page-modal').trigger("reset");

        $('div-save-mdl-page-modal span').show();
        $("#div-save-mdl-page-modal").attr('disabled', true);

        $('#div-show-txt-page-primary-id').show();
        $('#div-edit-txt-page-primary-id').hide();
        let itemId = $(this).attr('data-val');

        $.get("{{ route('fc-api.pages.show','') }}/"+itemId).done(function( response ) {
			
			$('#txt-page-primary-id').val(response.data.id);
            $('#spn_page_page_name').html(response.data.page_name);
            $('#spn_page_page_path').html(response.data.page_path);
            $('#spn_page_content').html(response.data.content);

            $("#spinner-pages").hide();
             $('div-save-mdl-page-modal span').hide();
            $("#div-save-mdl-page-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-page-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-page-modal-error').hide();
        $('#mdl-page-modal').modal('show');
        $('#frm-page-modal').trigger("reset");

        $("#spinner-pages").show();
        $("#div-save-mdl-page-modal").attr('disabled', true);

        $('#div-show-txt-page-primary-id').hide();
        $('#div-edit-txt-page-primary-id').show();
        let itemId = $(this).attr('data-val');

        $.get("{{ route('fc-api.pages.show','') }}/"+itemId).done(function( response ) {     

			$('#txt-page-primary-id').val(response.data.id);
            $('#page_name').val(response.data.page_name);
            $('#page_path').val(response.data.page_path);
            $('#content').val(response.data.content);

            $("#spinner-pages").hide();
            $("#div-save-mdl-page-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-page-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        let itemId = $(this).attr('data-val');
        swal({
                title: "Are you sure you want to delete this Page?",
                text: "You will not be able to recover this Page if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('fc-api.pages.destroy','') }}/"+itemId;

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
                                swal("Error", "Oops an error occurred. Please try again.", "error");
                            }else{
                                //swal("Deleted", "Page deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "Page deleted successfully",
                                        type: "success",
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: false
                                    },function(){
                                        location.reload(true);
                                });
                            }
                        },
                    });
                }
            });

    });

    //Save details
    $('#div-save-mdl-page-modal').click(function(e) {
        e.preventDefault();
        console.log('hello from save');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#spinner-pages spinner').show()
       $('#div-save-mdl-page-modal span').show();
        $('#div-save-mdl-page-modal').attr('disabled',true);

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }
  $('#spinner-pages spinner').show()
       $('#div-save-mdl-page-modal span').show();
        $('#div-save-mdl-page-modal').attr('disabled',true);

        let actionType = "POST";
        let endPointUrl = "{{ route('fc-api.pages.store') }}";
        let primaryId = $('#txt-page-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('fc-api.pages.update','') }}/"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif
        formData.append('page_name', $('#page_name').val());
		formData.append('page_path', $('#page_path').val());
		formData.append('content', $('#page_contents').val());
        formData.append('creator_user_id', "{{Auth::id()}}");
        @if (isset($site) && $site!=null)
        formData.append('site_id', "{{$site->id}}");
        @endif

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
					$('#div-page-modal-error').html('');
					$('#div-page-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        console.log(value);
                        $('#div-page-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-page-modal-error').hide();
                    window.setTimeout( function(){
                        //window.alert("The Page saved successfully.");
                        //swal("Saved", "Page saved successfully.", "success");
                         $('div-save-mdl-page-modal span').hide();
                        $('#btn-save-mdl-page-modal').attr('disabled', false);
                        // $('#div-page-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "Page saved successfully",
                                type: "success",
                                showCancelButton: false,
                                closeOnConfirm: false,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "OK",
                                closeOnConfirm: false
                            },function(){
                                location.reload(true);
                        });

                    },20);
                }

                // $("#spinner-pages").hide();
                 $('div-save-mdl-page-modal span').hide();
                $('#btn-save-mdl-page-modal').attr('disabled', false);
                // $("#div-save-mdl-page-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                // $("#spinner-pages").hide();
                 $('div-save-mdl-page-modal span').hide();
                $('#btn-save-mdl-page-modal').attr('disabled', false);
                // $("#div-save-mdl-page-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
