

<div class="modal fade" id="mdl-setting-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 id="lbl-setting-modal-title" class="modal-title">Setting</h4>
            </div>

            <div class="modal-body">
                <div id="div-setting-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-setting-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12 ma-10">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                            <div id="spinner-settings" class="">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <input type="hidden" id="txt-setting-primary-id" value="0" />
                            <div id="div-show-txt-setting-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">                            
                                    @include('hasob-foundation-core::pages.settings.show_fields')
                                    </div>
                                </div>
                            </div>
                            <div id="div-edit-txt-setting-primary-id">
                                <div class="row">
                                    <div class="col-lg-10 ma-10">
                                    @include('hasob-foundation-core::pages.settings.fields')
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div id="div-save-mdl-setting-modal" class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-primary" id="btn-save-mdl-setting-modal" value="add">Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline').hide();

    //Show Modal for New Entry
    $(document).on('click', ".btn-new-mdl-setting-modal", function(e) {
        $('#div-setting-modal-error').hide();
        $('#mdl-setting-modal').modal('show');
        $('#frm-setting-modal').trigger("reset");
        $('#txt-setting-primary-id').val(0);

        $('#div-show-txt-setting-primary-id').hide();
        $('#div-edit-txt-setting-primary-id').show();

        $("#spinner-settings").hide();
        $("#div-save-mdl-setting-modal").attr('disabled', false);
    });

    //Show Modal for View
    $(document).on('click', ".btn-show-mdl-setting-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $('#div-setting-modal-error').hide();
        $('#mdl-setting-modal').modal('show');
        $('#frm-setting-modal').trigger("reset");

        $("#spinner-settings").show();
        $("#div-save-mdl-setting-modal").attr('disabled', true);

        $('#div-show-txt-setting-primary-id').show();
        $('#div-edit-txt-setting-primary-id').hide();
        let itemId = $(this).attr('data-val');

        // $.get( "{{ route('fc.settings.show','') }}/"+itemId).done(function( response ) {
        $.get( "{{URL::to('/')}}/api/v1/gb-api/fc_settings/"+itemId).done(function( response ) {
			
			$('#txt-setting-primary-id').val(response.data.id);
            // $('#spn_setting_').html(response.data.);
            		$('#spn_setting_key').html(response.data.key);
		$('#spn_setting_value').html(response.data.value);
		$('#spn_setting_group_name').html(response.data.group_name);
		$('#spn_setting_model_type').html(response.data.model_type);
		$('#spn_setting_model_value').html(response.data.model_value);


            $("#spinner-settings").hide();
            $("#div-save-mdl-setting-modal").attr('disabled', false);
        });
    });

    //Show Modal for Edit
    $(document).on('click', ".btn-edit-mdl-setting-modal", function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        $('#div-setting-modal-error').hide();
        $('#mdl-setting-modal').modal('show');
        $('#frm-setting-modal').trigger("reset");

        $("#spinner-settings").show();
        $("#div-save-mdl-setting-modal").attr('disabled', true);

        $('#div-show-txt-setting-primary-id').hide();
        $('#div-edit-txt-setting-primary-id').show();
        let itemId = $(this).attr('data-val');

        // $.get( "{{ route('fc.settings.show','') }}/"+itemId).done(function( response ) {     
        $.get( "{{URL::to('/')}}/api/v1/gb-api/fc_settings/"+itemId).done(function( response ) {

			$('#txt-setting-primary-id').val(response.data.id);
            // $('#').val(response.data.);
            		$('#key').val(response.data.key);
		$('#value').val(response.data.value);
		$('#group_name').val(response.data.group_name);
		$('#model_type').val(response.data.model_type);
		$('#model_value').val(response.data.model_value);


            $("#spinner-settings").hide();
            $("#div-save-mdl-setting-modal").attr('disabled', false);
        });
    });

    //Delete action
    $(document).on('click', ".btn-delete-mdl-setting-modal", function(e) {
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
                title: "Are you sure you want to delete this Setting record?",
                text: "You will not be able to recover this Setting record if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    let endPointUrl = "{{ route('fc.settings.destroy','') }}/"+itemId;

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
                                //swal("Deleted", "Setting deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "Setting deleted successfully",
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
    $('#btn-save-mdl-setting-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});


        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $("#spinner-settings").show();
        $("#div-save-mdl-setting-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "{{ route('fc.settings.store') }}";
        let primaryId = $('#txt-setting-primary-id').val();
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());

        if (primaryId != "0"){
            actionType = "PUT";
            endPointUrl = "{{ route('fc.settings.update','') }}/"+primaryId;
            formData.append('id', primaryId);
        }
        
        formData.append('_method', actionType);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif
        // formData.append('', $('#').val());
        		formData.append('key', $('#key').val());
		formData.append('value', $('#value').val());
		formData.append('group_name', $('#group_name').val());
		formData.append('model_type', $('#model_type').val());
		formData.append('model_value', $('#model_value').val());


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
					$('#div-setting-modal-error').html('');
					$('#div-setting-modal-error').show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-setting-modal-error').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-setting-modal-error').hide();
                    window.setTimeout( function(){
                        //window.alert("The Setting saved successfully.");
                        //swal("Saved", "Setting saved successfully.", "success");

                        $('#div-setting-modal-error').hide();

                        swal({
                                title: "Saved",
                                text: "Setting saved successfully",
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

                $("#spinner-settings").hide();
                $("#div-save-mdl-setting-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-settings").hide();
                $("#div-save-mdl-setting-modal").attr('disabled', false);

            }
        });
    });

});
</script>
@endpush
