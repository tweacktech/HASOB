

<div class="modal fade" id="mdl-bid-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="lbl-bid-modal-title" class="modal-title">Bid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-bid-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-bid-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline-bids">You are currently offline</span></div>

                            <div id="spinner-bids" class="spinner-border text-primary" role="status"> 
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            <input type="hidden" id="txt-bid-primary-id" value="0" />
                            <div id="div-show-txt-bid-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('dmo-savings-bond-module::pages.bids.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-bid-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('dmo-savings-bond-module::pages.bids.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        
            <div class="modal-footer" id="div-save-mdl-bid-modal">
                <button type="button" class="btn btn-primary" id="btn-save-mdl-bid-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline-bids').hide();

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-bid-modal", function(e) {
        $('#div-bid-modal-error').hide();
        $('#mdl-bid-modal').modal('show');
        $('#frm-bid-modal').trigger("reset");
        $('#txt-bid-primary-id').val(0);

        $('#div-show-txt-bid-primary-id').hide();
        $('#div-edit-txt-bid-primary-id').show();

        $("#spinner-bids").hide();
        $("#div-save-mdl-bid-modal").attr('disabled', false);
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-bid-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-bids').fadeIn(300);
            return;
        }else{
            $('.offline-bids').fadeOut(300);
        }

        $('#div-bid-modal-error').hide();
        $('#mdl-bid-modal').modal('show');
        $('#frm-bid-modal').trigger("reset");

        $("#spinner-bids").show();
        $("#div-save-mdl-bid-modal").attr('disabled', true);

        $('#div-show-txt-bid-primary-id').show();
        $('#div-edit-txt-bid-primary-id').hide();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.bids.show','') }}/"+itemId).done(function( response ) {
			
			$('#txt-bid-primary-id').val(response.data.id);
            		$('#spn_bid_status').html(response.data.status);
		$('#spn_bid_price_per_unit').html(response.data.price_per_unit);
		$('#spn_bid_total_price').html(response.data.total_price);


            $("#spinner-bids").hide();
            $("#div-save-mdl-bid-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-bid-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-bid-modal-error').hide();
        $('#mdl-bid-modal').modal('show');
        $('#frm-bid-modal').trigger("reset");

        $("#spinner-bids").show();
        $("#div-save-mdl-bid-modal").attr('disabled', true);

        $('#div-show-txt-bid-primary-id').hide();
        $('#div-edit-txt-bid-primary-id').show();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.bids.show','') }}/"+itemId).done(function( response ) {     

			$('#txt-bid-primary-id').val(response.data.id);
            		$('#status').val(response.data.status);
		$('#price_per_unit').val(response.data.price_per_unit);
		$('#total_price').val(response.data.total_price);


            $("#spinner-bids").hide();
            $("#div-save-mdl-bid-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-bid-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-bids').fadeIn(300);
            return;
        }else{
            $('.offline-bids').fadeOut(300);
        }

        let itemId = $(this).attr('data-val');
        swal({
                title: "Are you sure you want to delete this Bid?",
                text: "You will not be able to recover this Bid if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('sb-api.bids.destroy','') }}/"+itemId;

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
                                //swal("Deleted", "Bid deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "Bid deleted successfully",
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
    $('#btn-save-mdl-bid-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});


        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-bids').fadeIn(300);
            return;
        }else{
            $('.offline-bids').fadeOut(300);
        }

        $("#spinner-bids").show();
        $("#div-save-mdl-bid-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{ route('sb-api.bids.store') }}";
        let primaryId = $('#txt-bid-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('sb-api.bids.update','') }}/"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif
        // formData.append('', $('#').val());
        		formData.append('status', $('#status').val());
		formData.append('price_per_unit', $('#price_per_unit').val());
		formData.append('total_price', $('#total_price').val());


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
					$('#div-bid-modal-error').html('');
					$('#div-bid-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-bid-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-bid-modal-error').hide();
                    window.setTimeout( function(){

                        $('#div-bid-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "Bid saved successfully",
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

                $("#spinner-bids").hide();
                $("#div-save-mdl-bid-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-bids").hide();
                $("#div-save-mdl-bid-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
