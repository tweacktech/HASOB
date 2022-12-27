

<div class="modal fade" id="mdl-address-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 id="lbl-address-modal-title" class="modal-title">Address</h4>
            </div>

            <div class="modal-body">
                <div id="div-address-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-address-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                            <div id="spinner-addresses" class="">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <input type="hidden" id="txt-address-primary-id" value="0" />
                            <div id="div-show-txt-address-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('hasob-foundation-core::pages.addresses.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-address-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('hasob-foundation-core::pages.addresses.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div id="div-save-mdl-address-modal" class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-primary" id="btn-save-mdl-address-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline').hide();

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-address-modal", function(e) {
        $('#div-address-modal-error').hide();
        $('#mdl-address-modal').modal('show');
        $('#frm-address-modal').trigger("reset");
        $('#txt-address-primary-id').val(0);

        $('#div-show-txt-address-primary-id').hide();
        $('#div-edit-txt-address-primary-id').show();

        $("#spinner-addresses").hide();
        $("#div-save-mdl-address-modal").attr('disabled', false);
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-address-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $('#div-address-modal-error').hide();
        $('#mdl-address-modal').modal('show');
        $('#frm-address-modal').trigger("reset");

        $("#spinner-addresses").show();
        $("#div-save-mdl-address-modal").attr('disabled', true);

        $('#div-show-txt-address-primary-id').show();
        $('#div-edit-txt-address-primary-id').hide();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('gb-api.addresses.show','') }}/"+itemId).done(function( response ) {
			
			$('#txt-address-primary-id').val(response.data.id);
            		$('#spn_address_label').html(response.data.label);
		$('#spn_address_contact_person').html(response.data.contact_person);
		$('#spn_address_street').html(response.data.street);
		$('#spn_address_town').html(response.data.town);
		$('#spn_address_state').html(response.data.state);
		$('#spn_address_country').html(response.data.country);
		$('#spn_address_telephone').html(response.data.telephone);


            $("#spinner-addresses").hide();
            $("#div-save-mdl-address-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-address-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-address-modal-error').hide();
        $('#mdl-address-modal').modal('show');
        $('#frm-address-modal').trigger("reset");

        $("#spinner-addresses").show();
        $("#div-save-mdl-address-modal").attr('disabled', true);

        $('#div-show-txt-address-primary-id').hide();
        $('#div-edit-txt-address-primary-id').show();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('gb-api.addresses.show','') }}/"+itemId).done(function( response ) {     

			$('#txt-address-primary-id').val(response.data.id);
            		$('#label').val(response.data.label);
		$('#contact_person').val(response.data.contact_person);
		$('#street').val(response.data.street);
		$('#town').val(response.data.town);
		$('#state').val(response.data.state);
		$('#country').val(response.data.country);
		$('#telephone').val(response.data.telephone);


            $("#spinner-addresses").hide();
            $("#div-save-mdl-address-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-address-modal", function(e) {
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
                title: "Are you sure you want to delete this Address?",
                text: "You will not be able to recover this Address if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('gb-api.addresses.destroy','') }}/"+itemId;

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
                                //swal("Deleted", "Address deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "Address deleted successfully",
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
    $('#btn-save-mdl-address-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});


        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $("#spinner-addresses").show();
        $("#div-save-mdl-address-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{ route('gb-api.addresses.store') }}";
        let primaryId = $('#txt-address-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('gb-api.addresses.update','') }}/"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif
        // formData.append('', $('#').val());
        		formData.append('label', $('#label').val());
		formData.append('contact_person', $('#contact_person').val());
		formData.append('street', $('#street').val());
		formData.append('town', $('#town').val());
		formData.append('state', $('#state').val());
		formData.append('country', $('#country').val());
		formData.append('telephone', $('#telephone').val());


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
					$('#div-address-modal-error').html('');
					$('#div-address-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-address-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-address-modal-error').hide();
                    window.setTimeout( function(){

                        $('#div-address-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "Address saved successfully",
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

                $("#spinner-addresses").hide();
                $("#div-save-mdl-address-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-addresses").hide();
                $("#div-save-mdl-address-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
