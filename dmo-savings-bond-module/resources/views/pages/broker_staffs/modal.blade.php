

<div class="modal fade" id="mdl-brokerStaff-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="lbl-brokerStaff-modal-title" class="modal-title">Broker Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-brokerStaff-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-brokerStaff-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline-broker_staffs">You are currently offline</span></div>

                            <div id="spinner-broker_staffs" class="spinner-border text-primary" role="status"> 
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            <input type="hidden" id="txt-brokerStaff-primary-id" value="0" />
                            <div id="div-show-txt-brokerStaff-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('dmo-savings-bond-module::pages.broker_staffs.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-brokerStaff-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('dmo-savings-bond-module::pages.broker_staffs.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        
            <div class="modal-footer" id="div-save-mdl-brokerStaff-modal">
                <button type="button" class="btn btn-primary" id="btn-save-mdl-brokerStaff-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline-broker_staffs').hide();

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-brokerStaff-modal", function(e) {
        $('#div-brokerStaff-modal-error').hide();
        $('#mdl-brokerStaff-modal').modal('show');
        $('#frm-brokerStaff-modal').trigger("reset");
        $('#txt-brokerStaff-primary-id').val(0);

        $('#div-show-txt-brokerStaff-primary-id').hide();
        $('#div-edit-txt-brokerStaff-primary-id').show();

        $("#spinner-broker_staffs").hide();
        $("#div-save-mdl-brokerStaff-modal").attr('disabled', false);
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-brokerStaff-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-broker_staffs').fadeIn(300);
            return;
        }else{
            $('.offline-broker_staffs').fadeOut(300);
        }

        $('#div-brokerStaff-modal-error').hide();
        $('#mdl-brokerStaff-modal').modal('show');
        $('#frm-brokerStaff-modal').trigger("reset");

        $("#spinner-broker_staffs").show();
        $("#div-save-mdl-brokerStaff-modal").attr('disabled', true);

        $('#div-show-txt-brokerStaff-primary-id').show();
        $('#div-edit-txt-brokerStaff-primary-id').hide();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.broker_staffs.show','') }}/"+itemId).done(function( response ) {
			
			$('#txt-brokerStaff-primary-id').val(response.data.id);
            		$('#spn_brokerStaff_status').html(response.data.status);


            $("#spinner-broker_staffs").hide();
            $("#div-save-mdl-brokerStaff-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-brokerStaff-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-brokerStaff-modal-error').hide();
        $('#mdl-brokerStaff-modal').modal('show');
        $('#frm-brokerStaff-modal').trigger("reset");

        $("#spinner-broker_staffs").show();
        $("#div-save-mdl-brokerStaff-modal").attr('disabled', true);

        $('#div-show-txt-brokerStaff-primary-id').hide();
        $('#div-edit-txt-brokerStaff-primary-id').show();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.broker_staffs.show','') }}/"+itemId).done(function( response ) {     

			$('#txt-brokerStaff-primary-id').val(response.data.id);
            		$('#status').val(response.data.status);


            $("#spinner-broker_staffs").hide();
            $("#div-save-mdl-brokerStaff-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-brokerStaff-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-broker_staffs').fadeIn(300);
            return;
        }else{
            $('.offline-broker_staffs').fadeOut(300);
        }

        let itemId = $(this).attr('data-val');
        swal({
                title: "Are you sure you want to delete this BrokerStaff?",
                text: "You will not be able to recover this BrokerStaff if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('sb-api.broker_staffs.destroy','') }}/"+itemId;

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
                                //swal("Deleted", "BrokerStaff deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "BrokerStaff deleted successfully",
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
    $('#btn-save-mdl-brokerStaff-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});


        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-broker_staffs').fadeIn(300);
            return;
        }else{
            $('.offline-broker_staffs').fadeOut(300);
        }

        $("#spinner-broker_staffs").show();
        $("#div-save-mdl-brokerStaff-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{ route('sb-api.broker_staffs.store') }}";
        let primaryId = $('#txt-brokerStaff-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('sb-api.broker_staffs.update','') }}/"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif
        // formData.append('', $('#').val());
        		formData.append('status', $('#status').val());


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
					$('#div-brokerStaff-modal-error').html('');
					$('#div-brokerStaff-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-brokerStaff-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-brokerStaff-modal-error').hide();
                    window.setTimeout( function(){

                        $('#div-brokerStaff-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "BrokerStaff saved successfully",
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

                $("#spinner-broker_staffs").hide();
                $("#div-save-mdl-brokerStaff-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-broker_staffs").hide();
                $("#div-save-mdl-brokerStaff-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
