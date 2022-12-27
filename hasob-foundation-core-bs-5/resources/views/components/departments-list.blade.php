
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-2">
    @foreach ($departments as $item)
    <div class="col">
        <x-hasob-foundation-core::department-badge :department="$item" />
    </div>
    @endforeach
</div>

<div class="modal fade" id="mdl-department-modal" tabindex="-1" role= "dialog" aria-labelledby="mdl-department-modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="lbl-department-modal-title">Department</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <div class="modal-body">
                <div id="div-department-modal-error" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-department-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                            @csrf

                            

                            <input type="hidden" id="txt-department-primary-id" value="0" />
                            <div id="div-edit-txt-department-primary-id">
                                <div class="">
                                    @include('hasob-foundation-core::departments.fields')
                                </div>
                            </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save-mdl-department-modal" value="add">
                <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="visually-hidden">Loading...</span>  Save</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')

    <script type="text/javascript">
        $(document).ready(function() {
        
            //Show Modal for New Entry
            $(document).on('click', ".btn-new-mdl-department-modal", function(e) {
                $('#spinner').hide();
                $('#div-department-modal-error').hide();
                $('#mdl-department-modal').modal('show');
                $('.modal-footer').show();
                $('#frm-department-modal').trigger("reset");
                $('#txt-department-primary-id').val(0);
        
                $('#div-show-txt-department-primary-id').hide();
                $('#div-edit-txt-department-primary-id').show();
            });
        
            //Show Modal for View
            $(document).on('click', ".btn-show-mdl-department-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

                $('#div-department-modal-error').hide();
                $('#mdl-department-modal').modal('show');
                $('#frm-department-modal').trigger("reset");

                $('#spinner').show();
                $('#btn-save-mdl-department-modal').prop("disabled", true);

                let itemId = $(this).attr('data-val');
                $.get( "{{ route('fc.departments.show','') }}/"+itemId).done(function( response ) {
                    $('#div-department-modal-error').hide();
                    $('#mdl-department-modal').modal('show');
                    $('#frm-department-modal').trigger("reset");
                    $('#txt-department-primary-id').val(response.data.id);
        

                });
            });
        
            //Show Modal for Edit
            $(document).on('click', ".btn-edit-mdl-department-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
                
                $('#div-department-modal-error').hide();
                $('#frm-department-modal').trigger("reset");
                $('#mdl-department-modal').modal('show');

                $('#spinner').show();
                $('#btn-save-mdl-department-modal').prop("disabled", true);

                let itemId = $(this).attr('data-val');        
                $.get( "{{ route('fc.departments.show','') }}/"+itemId).done(function( data ) {

                    $('#txt-department-primary-id').val(data.response.id);
                    $('#email').val(data.response.email);
                    $('#long_name').val(data.response.long_name);
                    $('#telephone').val(data.response.telephone);
                    $('#physical_location').val(data.response.physical_location);
                    if (data.response.parent_id != null){
                        $('#department_id').val(data.response.parent_id);
                    }

                    $('#spinner').hide();
                    $('#btn-save-mdl-department-modal').prop("disabled", false);
                    //$('#is_unit').val(data.response.is_unit));
                });
            });
        
            //Delete action
            $(document).on('click', ".btn-delete-mdl-department-modal", function(e) {
                e.preventDefault();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
        
                let itemId = $(this).attr('data-val');
                 swal({
                title: "Are you sure you want to delete this Department?",
                text: "You will not be able to recover this Department record if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                // if (confirm("Are you sure you want to delete this Department?")){
        
                    let endPointUrl = "{{ route('fc.departments.destroy','') }}/"+itemId;
        
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
                            // if(result.errors){
                            //     console.log(result.errors)
                            // }else{
                            //     window.alert("The Department record has been deleted.");
                            //     location.reload(true);
                            // }
                            if(result.errors){
                                console.log(result.errors)
                                swal("Error", "Oops an error occurred. Please try again.", "error");
                            }else{
                                //swal("Deleted", "Site deleted successfully.", "success");
                                swal({
                                        title: "Deleted",
                                        text: "The Department record has been deleted.",
                                        type: "success",
                                        confirmButtonClass: "btn-success",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: false
                                    })
                                    setTimeout(function(){
                                        location.reload(true);
                                }, 1000);
                            }
                        },
                    });            
                }
            });
        });
            //Save details
            $('#btn-save-mdl-department-modal').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
                $('#spinner').show();
                $('#btn-save-mdl-department-modal').prop("disabled", true);
                let actionType = "POST";
                let endPointUrl = "{{ route('fc.departments.store') }}";
                let primaryId = $('#txt-department-primary-id').val();
                
                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val());
        
                if (primaryId != "0"){
                    actionType = "PUT";
                    endPointUrl = "{{ route('fc.departments.update','') }}/"+primaryId;
                    formData.append('id', primaryId);
                }
                
                formData.append('_method', actionType);
                formData.append('email', $('#email').val());
                formData.append('is_unit', $('#is_unit').val());
                formData.append('long_name', $('#long_name').val());
                formData.append('telephone', $('#telephone').val());
                formData.append('parent_id', $('#department_id').val());
                formData.append('physical_location', $('#physical_location').val());
        
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
                            console.log(result.errors);
                            $('#div-department-modal-error').html('');
                            $('#div-department-modal-error').show();
                            $('#spinner1').hide();
                            $('#btn-save-mdl-department-modal').prop("disabled", false);
                            
                            $.each(result.errors, function(key, value){
                                $('#div-department-modal-error').append('<li class="">'+value+'</li>');
                            });
                        }else{
                            $('#div-department-modal-error').hide();
                            $('#spinner').hide();
                            $('#btn-save-mdl-department-modal').prop("disabled", false);
                            $('#div-department-modal-error').hide();
                            // window.setTimeout( function(){
                            //     window.alert("The Department record saved successfully.");
                            //     location.reload(true);
                            // },20);

                            
                        swal({
                                title: "Saved",
                                text: "The Department record saved successfully.",
                                type: "success",
                                showCancelButton: false,
                                closeOnConfirm: false,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "OK",
                                closeOnConfirm: false
                            })

                            setTimeout(function(){
                                location.reload(true);
                        }, 1000);

                        }
                    }, error: function(data){
                        $('#spinner').hide();
                        $('#btn-save-mdl-department-modal').prop("disabled", false);
                        console.log(data);
                    }
                });
            });
        
        });
    </script>

@endpush