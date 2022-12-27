

<div class="modal fade" id="mdl-subscription-modal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="lbl-subscription-modal-title" class="modal-title">Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="div-subscription-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-subscription-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline-subscriptions">You are currently offline</span></div>

                            <div id="spinner-subscriptions" class="spinner-border text-primary" role="status"> 
                                <span class="visually-hidden">Loading...</span>
                            </div>

                            <input type="hidden" id="txt-subscription-primary-id" value="0" />
                            <div id="div-show-txt-subscription-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('dmo-savings-bond-module::pages.subscriptions.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-subscription-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('dmo-savings-bond-module::pages.subscriptions.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        
            <div class="modal-footer" id="div-save-mdl-subscription-modal">
                <button type="button" class="btn btn-primary" id="btn-save-mdl-subscription-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline-subscriptions').hide();

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-subscription-modal", function(e) {
        $('#div-subscription-modal-error').hide();
        $('#mdl-subscription-modal').modal('show');
        $('#frm-subscription-modal').trigger("reset");
        $('#txt-subscription-primary-id').val(0);

        $('#div-show-txt-subscription-primary-id').hide();
        $('#div-edit-txt-subscription-primary-id').show();

        $("#spinner-subscriptions").hide();
        $("#div-save-mdl-subscription-modal").attr('disabled', false);
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-subscription-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-subscriptions').fadeIn(300);
            return;
        }else{
            $('.offline-subscriptions').fadeOut(300);
        }

        $('#div-subscription-modal-error').hide();
        $('#mdl-subscription-modal').modal('show');
        $('#frm-subscription-modal').trigger("reset");

        $("#spinner-subscriptions").show();
        $("#div-save-mdl-subscription-modal").attr('disabled', true);

        $('#div-show-txt-subscription-primary-id').show();
        $('#div-edit-txt-subscription-primary-id').hide();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.subscriptions.show','') }}/"+itemId).done(function( response ) {
			
			$('#txt-subscription-primary-id').val(response.data.id);
            		$('#spn_subscription_broker_code').html(response.data.broker_code);
		$('#spn_subscription_broker_name').html(response.data.broker_name);
		$('#spn_subscription_status').html(response.data.status);
		$('#spn_subscription_price_per_unit').html(response.data.price_per_unit);
		$('#spn_subscription_total_price').html(response.data.total_price);
		$('#spn_subscription_interest_rate_pct').html(response.data.interest_rate_pct);
		$('#spn_subscription_offer_start_date').html(response.data.offer_start_date);
		$('#spn_subscription_offer_end_date').html(response.data.offer_end_date);
		$('#spn_subscription_offer_settlement_date').html(response.data.offer_settlement_date);
		$('#spn_subscription_offer_maturity_date').html(response.data.offer_maturity_date);
		$('#spn_subscription_tenor_years').html(response.data.tenor_years);
		$('#spn_subscription_investor_email').html(response.data.investor_email);
		$('#spn_subscription_investor_telephone').html(response.data.investor_telephone);
		$('#spn_subscription_first_name').html(response.data.first_name);
		$('#spn_subscription_middle_name').html(response.data.middle_name);
		$('#spn_subscription_last_name').html(response.data.last_name);
		$('#spn_subscription_date_of_birth').html(response.data.date_of_birth);
		$('#spn_subscription_origin_geo_zone').html(response.data.origin_geo_zone);
		$('#spn_subscription_origin_lga').html(response.data.origin_lga);
		$('#spn_subscription_address_street').html(response.data.address_street);
		$('#spn_subscription_address_town').html(response.data.address_town);
		$('#spn_subscription_address_state').html(response.data.address_state);
		$('#spn_subscription_bank_account_name').html(response.data.bank_account_name);
		$('#spn_subscription_bank_account_number').html(response.data.bank_account_number);
		$('#spn_subscription_bank_name').html(response.data.bank_name);
		$('#spn_subscription_bank_verification_number').html(response.data.bank_verification_number);
		$('#spn_subscription_national_id_number').html(response.data.national_id_number);
		$('#spn_subscription_cscs_id_number').html(response.data.cscs_id_number);
		$('#spn_subscription_chn_id_number').html(response.data.chn_id_number);


            $("#spinner-subscriptions").hide();
            $("#div-save-mdl-subscription-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-subscription-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-subscription-modal-error').hide();
        $('#mdl-subscription-modal').modal('show');
        $('#frm-subscription-modal').trigger("reset");

        $("#spinner-subscriptions").show();
        $("#div-save-mdl-subscription-modal").attr('disabled', true);

        $('#div-show-txt-subscription-primary-id').hide();
        $('#div-edit-txt-subscription-primary-id').show();
        let itemId = $(this).attr('data-val');

        $.get( "{{ route('sb-api.subscriptions.show','') }}/"+itemId).done(function( response ) {     

			$('#txt-subscription-primary-id').val(response.data.id);
            		$('#broker_code').val(response.data.broker_code);
		$('#broker_name').val(response.data.broker_name);
		$('#status').val(response.data.status);
		$('#price_per_unit').val(response.data.price_per_unit);
		$('#total_price').val(response.data.total_price);
		$('#interest_rate_pct').val(response.data.interest_rate_pct);
		$('#offer_start_date').val(response.data.offer_start_date);
		$('#offer_end_date').val(response.data.offer_end_date);
		$('#offer_settlement_date').val(response.data.offer_settlement_date);
		$('#offer_maturity_date').val(response.data.offer_maturity_date);
		$('#tenor_years').val(response.data.tenor_years);
		$('#investor_email').val(response.data.investor_email);
		$('#investor_telephone').val(response.data.investor_telephone);
		$('#first_name').val(response.data.first_name);
		$('#middle_name').val(response.data.middle_name);
		$('#last_name').val(response.data.last_name);
		$('#date_of_birth').val(response.data.date_of_birth);
		$('#origin_geo_zone').val(response.data.origin_geo_zone);
		$('#origin_lga').val(response.data.origin_lga);
		$('#address_street').val(response.data.address_street);
		$('#address_town').val(response.data.address_town);
		$('#address_state').val(response.data.address_state);
		$('#bank_account_name').val(response.data.bank_account_name);
		$('#bank_account_number').val(response.data.bank_account_number);
		$('#bank_name').val(response.data.bank_name);
		$('#bank_verification_number').val(response.data.bank_verification_number);
		$('#national_id_number').val(response.data.national_id_number);
		$('#cscs_id_number').val(response.data.cscs_id_number);
		$('#chn_id_number').val(response.data.chn_id_number);


            $("#spinner-subscriptions").hide();
            $("#div-save-mdl-subscription-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-subscription-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-subscriptions').fadeIn(300);
            return;
        }else{
            $('.offline-subscriptions').fadeOut(300);
        }

        let itemId = $(this).attr('data-val');
        swal({
                title: "Are you sure you want to delete this Subscription?",
                text: "You will not be able to recover this Subscription if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('sb-api.subscriptions.destroy','') }}/"+itemId;

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
                                //swal("Deleted", "Subscription deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "Subscription deleted successfully",
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
    $('#btn-save-mdl-subscription-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});


        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline-subscriptions').fadeIn(300);
            return;
        }else{
            $('.offline-subscriptions').fadeOut(300);
        }

        $("#spinner-subscriptions").show();
        $("#div-save-mdl-subscription-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{ route('sb-api.subscriptions.store') }}";
        let primaryId = $('#txt-subscription-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('sb-api.subscriptions.update','') }}/"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif
        // formData.append('', $('#').val());
        		formData.append('broker_code', $('#broker_code').val());
		formData.append('broker_name', $('#broker_name').val());
		formData.append('status', $('#status').val());
		formData.append('price_per_unit', $('#price_per_unit').val());
		formData.append('total_price', $('#total_price').val());
		formData.append('interest_rate_pct', $('#interest_rate_pct').val());
		formData.append('offer_start_date', $('#offer_start_date').val());
		formData.append('offer_end_date', $('#offer_end_date').val());
		formData.append('offer_settlement_date', $('#offer_settlement_date').val());
		formData.append('offer_maturity_date', $('#offer_maturity_date').val());
		formData.append('tenor_years', $('#tenor_years').val());
		formData.append('investor_email', $('#investor_email').val());
		formData.append('investor_telephone', $('#investor_telephone').val());
		formData.append('first_name', $('#first_name').val());
		formData.append('middle_name', $('#middle_name').val());
		formData.append('last_name', $('#last_name').val());
		formData.append('date_of_birth', $('#date_of_birth').val());
		formData.append('origin_geo_zone', $('#origin_geo_zone').val());
		formData.append('origin_lga', $('#origin_lga').val());
		formData.append('address_street', $('#address_street').val());
		formData.append('address_town', $('#address_town').val());
		formData.append('address_state', $('#address_state').val());
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
					$('#div-subscription-modal-error').html('');
					$('#div-subscription-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-subscription-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-subscription-modal-error').hide();
                    window.setTimeout( function(){

                        $('#div-subscription-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "Subscription saved successfully",
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

                $("#spinner-subscriptions").hide();
                $("#div-save-mdl-subscription-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-subscriptions").hide();
                $("#div-save-mdl-subscription-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
