

<div class="modal fade" id="mdl-investor-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="lbl-investor-modal-title" class="modal-title">Investor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-investor-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-investor-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline-investors">You are currently offline</span></div>

                            <div id="spinner-investors" class="spinner-border text-primary" role="status"> 
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            <input type="hidden" id="txt-investor-primary-id" value="0" />
                            <div id="div-show-txt-investor-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('dmo-savings-bond-module::pages.investors.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-investor-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('dmo-savings-bond-module::pages.investors.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        
            <div class="modal-footer" id="div-save-mdl-investor-modal">
                <button type="button" class="btn btn-primary" id="btn-save-mdl-investor-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline-investors').hide();

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-investor-modal", function(e) {
        $('#div-investor-modal-error').hide();
        $('#mdl-investor-modal').modal('show');
        $('#frm-investor-modal').trigger("reset");
        $('#txt-investor-primary-id').val(0);

        $('#div-show-txt-investor-primary-id').hide();
        $('#div-edit-txt-investor-primary-id').show();

        $("#spinner-investors").hide();
        $("#div-save-mdl-investor-modal").attr('disabled', false);
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-investor-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-investors').fadeIn(300);
            return;
        }else{
            $('.offline-investors').fadeOut(300);
        }

        $('#div-investor-modal-error').hide();
        $('#mdl-investor-modal').modal('show');
        $('#frm-investor-modal').trigger("reset");

        $("#spinner-investors").show();
        $("#div-save-mdl-investor-modal").attr('disabled', true);

        $('#div-show-txt-investor-primary-id').show();
        $('#div-edit-txt-investor-primary-id').hide();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.investors.show','') }}/"+itemId).done(function( response ) {
			
			$('#txt-investor-primary-id').val(response.data.id);
            		$('#spn_investor_date_of_birth').html(response.data.date_of_birth);
		$('#spn_investor_origin_geo_zone').html(response.data.origin_geo_zone);
		$('#spn_investor_origin_lga').html(response.data.origin_lga);
		$('#spn_investor_address_street').html(response.data.address_street);
		$('#spn_investor_address_town').html(response.data.address_town);
		$('#spn_investor_address_state').html(response.data.address_state);
		$('#spn_investor_status').html(response.data.status);
		$('#spn_investor_bank_account_name').html(response.data.bank_account_name);
		$('#spn_investor_bank_account_number').html(response.data.bank_account_number);
		$('#spn_investor_bank_name').html(response.data.bank_name);
		$('#spn_investor_bank_verification_number').html(response.data.bank_verification_number);
		$('#spn_investor_national_id_number').html(response.data.national_id_number);
		$('#spn_investor_cscs_id_number').html(response.data.cscs_id_number);
		$('#spn_investor_chn_id_number').html(response.data.chn_id_number);


            $("#spinner-investors").hide();
            $("#div-save-mdl-investor-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-investor-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-investor-modal-error').hide();
        $('#mdl-investor-modal').modal('show');
        $('#frm-investor-modal').trigger("reset");

        $("#spinner-investors").show();
        $("#div-save-mdl-investor-modal").attr('disabled', true);

        $('#div-show-txt-investor-primary-id').hide();
        $('#div-edit-txt-investor-primary-id').show();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.investors.show','') }}/"+itemId).done(function( response ) {     

			$('#txt-investor-primary-id').val(response.data.id);
            		$('#date_of_birth').val(response.data.date_of_birth);
		$('#origin_geo_zone').val(response.data.origin_geo_zone);
		$('#origin_lga').val(response.data.origin_lga);
		$('#address_street').val(response.data.address_street);
		$('#address_town').val(response.data.address_town);
		$('#address_state').val(response.data.address_state);
		$('#status').val(response.data.status);
		$('#bank_account_name').val(response.data.bank_account_name);
		$('#bank_account_number').val(response.data.bank_account_number);
		$('#bank_name').val(response.data.bank_name);
		$('#bank_verification_number').val(response.data.bank_verification_number);
		$('#national_id_number').val(response.data.national_id_number);
		$('#cscs_id_number').val(response.data.cscs_id_number);
		$('#chn_id_number').val(response.data.chn_id_number);


            $("#spinner-investors").hide();
            $("#div-save-mdl-investor-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-investor-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-investors').fadeIn(300);
            return;
        }else{
            $('.offline-investors').fadeOut(300);
        }

        let itemId = $(this).attr('data-val');
        swal({
                title: "Are you sure you want to delete this Investor?",
                text: "You will not be able to recover this Investor if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('sb-api.investors.destroy','') }}/"+itemId;

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
                                //swal("Deleted", "Investor deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "Investor deleted successfully",
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
    $('#btn-save-mdl-investor-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});


        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-investors').fadeIn(300);
            return;
        }else{
            $('.offline-investors').fadeOut(300);
        }

        $("#spinner-investors").show();
        $("#div-save-mdl-investor-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{ route('sb-api.investors.store') }}";
        let primaryId = $('#txt-investor-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('sb-api.investors.update','') }}/"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif
        // formData.append('', $('#').val());
        		formData.append('date_of_birth', $('#date_of_birth').val());
		formData.append('origin_geo_zone', $('#origin_geo_zone').val());
		formData.append('origin_lga', $('#origin_lga').val());
		formData.append('address_street', $('#address_street').val());
		formData.append('address_town', $('#address_town').val());
		formData.append('address_state', $('#address_state').val());
		formData.append('status', $('#status').val());
		formData.append('bank_account_name', $('#bank_account_name').val());
		formData.append('bank_account_number', $('#bank_account_number').val());
		formData.append('bank_name', $('#bank_name').val());
		formData.append('bank_verification_number', $('#bank_verification_number').val());
		formData.append('national_id_number', $('#national_id_number').val());
		formData.append('cscs_id_number', $('#cscs_id_number').val());
		formData.append('chn_id_number', $('#chn_id_number').val());


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
					$('#div-investor-modal-error').html('');
					$('#div-investor-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-investor-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-investor-modal-error').hide();
                    window.setTimeout( function(){

                        $('#div-investor-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "Investor saved successfully",
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

                $("#spinner-investors").hide();
                $("#div-save-mdl-investor-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-investors").hide();
                $("#div-save-mdl-investor-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
