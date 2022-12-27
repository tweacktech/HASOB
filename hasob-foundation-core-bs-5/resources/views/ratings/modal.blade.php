

<div class="modal fade" id="mdl-rating-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="lbl-rating-modal-title" class="modal-title">Rating</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-rating-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-rating-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline-ratings">You are currently offline</span></div>

                            <div id="spinner-ratings" class="spinner-border text-primary" role="status"> 
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            <input type="hidden" id="txt-rating-primary-id" value="0" />
                            <div id="div-show-txt-rating-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('hasob-foundation-core::pages.ratings.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-rating-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('hasob-foundation-core::pages.ratings.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        
            <div class="modal-footer" id="div-save-mdl-rating-modal">
                <button type="button" class="btn btn-primary" id="btn-save-mdl-rating-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline-ratings').hide();

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-rating-modal", function(e) {
        $('#div-rating-modal-error').hide();
        $('#mdl-rating-modal').modal('show');
        $('#frm-rating-modal').trigger("reset");
        $('#txt-rating-primary-id').val(0);

        $('#div-show-txt-rating-primary-id').hide();
        $('#div-edit-txt-rating-primary-id').show();

        $("#spinner-ratings").hide();
        $("#div-save-mdl-rating-modal").attr('disabled', false);
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-rating-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-ratings').fadeIn(300);
            return;
        }else{
            $('.offline-ratings').fadeOut(300);
        }

        $('#div-rating-modal-error').hide();
        $('#mdl-rating-modal').modal('show');
        $('#frm-rating-modal').trigger("reset");

        $("#spinner-ratings").show();
        $("#div-save-mdl-rating-modal").attr('disabled', true);

        $('#div-show-txt-rating-primary-id').show();
        $('#div-edit-txt-rating-primary-id').hide();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('fc-api.ratings.show','') }}/"+itemId).done(function( response ) {
			
			$('#txt-rating-primary-id').val(response.data.id);
            

            $("#spinner-ratings").hide();
            $("#div-save-mdl-rating-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-rating-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-rating-modal-error').hide();
        $('#mdl-rating-modal').modal('show');
        $('#frm-rating-modal').trigger("reset");

        $("#spinner-ratings").show();
        $("#div-save-mdl-rating-modal").attr('disabled', true);

        $('#div-show-txt-rating-primary-id').hide();
        $('#div-edit-txt-rating-primary-id').show();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('fc-api.ratings.show','') }}/"+itemId).done(function( response ) {     

			$('#txt-rating-primary-id').val(response.data.id);
            

            $("#spinner-ratings").hide();
            $("#div-save-mdl-rating-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-rating-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-ratings').fadeIn(300);
            return;
        }else{
            $('.offline-ratings').fadeOut(300);
        }

        let itemId = $(this).attr('data-val');
        swal({
                title: "Are you sure you want to delete this Rating?",
                text: "You will not be able to recover this Rating if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('fc-api.ratings.destroy','') }}/"+itemId;

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
                                //swal("Deleted", "Rating deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "Rating deleted successfully",
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
    $('#btn-save-mdl-rating-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});


        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-ratings').fadeIn(300);
            return;
        }else{
            $('.offline-ratings').fadeOut(300);
        }

        $("#spinner-ratings").show();
        $("#div-save-mdl-rating-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{ route('fc-api.ratings.store') }}";
        let primaryId = $('#txt-rating-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('fc-api.ratings.update','') }}/"+primaryId;
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
					$('#div-rating-modal-error').html('');
					$('#div-rating-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-rating-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-rating-modal-error').hide();
                    window.setTimeout( function(){

                        $('#div-rating-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "Rating saved successfully",
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

                $("#spinner-ratings").hide();
                $("#div-save-mdl-rating-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-ratings").hide();
                $("#div-save-mdl-rating-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
