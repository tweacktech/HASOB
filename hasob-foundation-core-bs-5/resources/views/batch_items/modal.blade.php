

<div class="modal fade" id="mdl-batchItem-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 id="lbl-batchItem-modal-title" class="modal-title">Batch Item</h4>
            </div>

            <div class="modal-body">
                <div id="div-batchItem-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-batchItem-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                            <div id="spinner-batch_items" class="">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <input type="hidden" id="txt-batchItem-primary-id" value="0" />
                            <div id="div-show-txt-batchItem-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('hasob-foundation-core::pages.batch_items.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-batchItem-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('hasob-foundation-core::pages.batch_items.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div id="div-save-mdl-batchItem-modal" class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-primary" id="btn-save-mdl-batchItem-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline').hide();

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-batchItem-modal", function(e) {
        $('#div-batchItem-modal-error').hide();
        $('#mdl-batchItem-modal').modal('show');
        $('#frm-batchItem-modal').trigger("reset");
        $('#txt-batchItem-primary-id').val(0);

        $('#div-show-txt-batchItem-primary-id').hide();
        $('#div-edit-txt-batchItem-primary-id').show();

        $("#spinner-batch_items").hide();
        $("#div-save-mdl-batchItem-modal").attr('disabled', false);
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-batchItem-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $('#div-batchItem-modal-error').hide();
        $('#mdl-batchItem-modal').modal('show');
        $('#frm-batchItem-modal').trigger("reset");

        $("#spinner-batch_items").show();
        $("#div-save-mdl-batchItem-modal").attr('disabled', true);

        $('#div-show-txt-batchItem-primary-id').show();
        $('#div-edit-txt-batchItem-primary-id').hide();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('gb-api.batchItems.show','') }}/"+itemId).done(function( response ) {
			
			$('#txt-batchItem-primary-id').val(response.data.id);
            

            $("#spinner-batch_items").hide();
            $("#div-save-mdl-batchItem-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-batchItem-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-batchItem-modal-error').hide();
        $('#mdl-batchItem-modal').modal('show');
        $('#frm-batchItem-modal').trigger("reset");

        $("#spinner-batch_items").show();
        $("#div-save-mdl-batchItem-modal").attr('disabled', true);

        $('#div-show-txt-batchItem-primary-id').hide();
        $('#div-edit-txt-batchItem-primary-id').show();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('gb-api.batchItems.show','') }}/"+itemId).done(function( response ) {     

			$('#txt-batchItem-primary-id').val(response.data.id);
            

            $("#spinner-batch_items").hide();
            $("#div-save-mdl-batchItem-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-batchItem-modal", function(e) {
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
                title: "Are you sure you want to delete this BatchItem?",
                text: "You will not be able to recover this BatchItem if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('gb-api.batchItems.destroy','') }}/"+itemId;

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
                                //swal("Deleted", "BatchItem deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "BatchItem deleted successfully",
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
    $('#btn-save-mdl-batchItem-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});


        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $("#spinner-batch_items").show();
        $("#div-save-mdl-batchItem-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{ route('gb-api.batchItems.store') }}";
        let primaryId = $('#txt-batchItem-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('gb-api.batchItems.update','') }}/"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif
        // formData.append('', $('#').val());
        

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
					$('#div-batchItem-modal-error').html('');
					$('#div-batchItem-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-batchItem-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-batchItem-modal-error').hide();
                    window.setTimeout( function(){

                        $('#div-batchItem-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "BatchItem saved successfully",
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

                $("#spinner-batch_items").hide();
                $("#div-save-mdl-batchItem-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-batch_items").hide();
                $("#div-save-mdl-batchItem-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
