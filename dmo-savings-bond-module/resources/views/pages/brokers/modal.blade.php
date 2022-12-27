

<div class="modal fade" id="mdl-broker-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="lbl-broker-modal-title" class="modal-title">Broker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-broker-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-broker-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline-brokers">You are currently offline</span></div>

                            <div id="spinner-brokers" class="spinner-border text-primary" role="status"> 
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            <input type="hidden" id="txt-broker-primary-id" value="0" />
                            <div id="div-show-txt-broker-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('dmo-savings-bond-module::pages.brokers.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-broker-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('dmo-savings-bond-module::pages.brokers.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        
            <div class="modal-footer" id="div-save-mdl-broker-modal">
                <button type="button" class="btn btn-primary" id="btn-save-mdl-broker-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline-brokers').hide();

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-broker-modal", function(e) {
        $('#div-broker-modal-error').hide();
        $('#mdl-broker-modal').modal('show');
        $('#frm-broker-modal').trigger("reset");
        $('#txt-broker-primary-id').val(0);

        $('#div-show-txt-broker-primary-id').hide();
        $('#div-edit-txt-broker-primary-id').show();

        $("#spinner-brokers").hide();
        $("#div-save-mdl-broker-modal").attr('disabled', false);
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-broker-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-brokers').fadeIn(300);
            return;
        }else{
            $('.offline-brokers').fadeOut(300);
        }

        $('#div-broker-modal-error').hide();
        $('#mdl-broker-modal').modal('show');
        $('#frm-broker-modal').trigger("reset");

        $("#spinner-brokers").show();
        $("#div-save-mdl-broker-modal").attr('disabled', true);

        $('#div-show-txt-broker-primary-id').show();
        $('#div-edit-txt-broker-primary-id').hide();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.brokers.show','') }}/"+itemId).done(function( response ) {
			
			$('#txt-broker-primary-id').val(response.data.id);
            		$('#spn_broker_status').html(response.data.status);
		$('#spn_broker_broker_code').html(response.data.broker_code);
		$('#spn_broker_full_name').html(response.data.full_name);
		$('#spn_broker_short_name').html(response.data.short_name);


            $("#spinner-brokers").hide();
            $("#div-save-mdl-broker-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-broker-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-broker-modal-error').hide();
        $('#mdl-broker-modal').modal('show');
        $('#frm-broker-modal').trigger("reset");

        $("#spinner-brokers").show();
        $("#div-save-mdl-broker-modal").attr('disabled', true);

        $('#div-show-txt-broker-primary-id').hide();
        $('#div-edit-txt-broker-primary-id').show();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.brokers.show','') }}/"+itemId).done(function( response ) {     

			$('#txt-broker-primary-id').val(response.data.id);
            		$('#status').val(response.data.status);
		$('#broker_code').val(response.data.broker_code);
		$('#full_name').val(response.data.full_name);
		$('#short_name').val(response.data.short_name);


            $("#spinner-brokers").hide();
            $("#div-save-mdl-broker-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-broker-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-brokers').fadeIn(300);
            return;
        }else{
            $('.offline-brokers').fadeOut(300);
        }

        let itemId = $(this).attr('data-val');
        swal({
                title: "Are you sure you want to delete this Broker?",
                text: "You will not be able to recover this Broker if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('sb-api.brokers.destroy','') }}/"+itemId;

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
                                //swal("Deleted", "Broker deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "Broker deleted successfully",
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
    $('#btn-save-mdl-broker-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});


        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-brokers').fadeIn(300);
            return;
        }else{
            $('.offline-brokers').fadeOut(300);
        }

        $("#spinner-brokers").show();
        $("#div-save-mdl-broker-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{ route('sb-api.brokers.store') }}";
        let primaryId = $('#txt-broker-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('sb-api.brokers.update','') }}/"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif
        // formData.append('', $('#').val());
        		formData.append('status', $('#status').val());
		formData.append('broker_code', $('#broker_code').val());
		formData.append('full_name', $('#full_name').val());
		formData.append('short_name', $('#short_name').val());


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
					$('#div-broker-modal-error').html('');
					$('#div-broker-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-broker-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-broker-modal-error').hide();
                    window.setTimeout( function(){

                        $('#div-broker-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "Broker saved successfully",
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

                $("#spinner-brokers").hide();
                $("#div-save-mdl-broker-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-brokers").hide();
                $("#div-save-mdl-broker-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
