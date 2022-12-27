
<a id="btn-mdl-bulk-upload-address-modal" class="btn btn-xs btn-danger btn-mdl-bulk-upload-address-modal">
    <i class="zmdi zmdi-upload"></i> Bulk Upload
</a>

<div class="modal fade" id="mdl-bulk-upload-address-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 id="lbl-address-modal-title-bku" class="modal-title">Bulk Upload</h4>
            </div>

            <div class="modal-body">
                <div id="div-address-modal-error-bku" class="alert alert-danger" role="alert"></div>
                <form class="form-horizontal" id="frm-address-modal-bku" role="form" method="POST" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            @csrf
                            
                            <div class="offline-flag"><span class="offline">You are currently offline</span></div>
                            <div id="spinner-mdl-bulk-upload-address-modal" class="">
                                <div class="loader" id="loader-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-11 ma-10">

                                    <div id="div-value-key" class="form-group">
                                        <div class="col-sm-12">
                                            You may select a comma separated value (csv) file containing data that can be uploaded. The format of the <span style="font-weight:bold;">expected CSV file</span> is indicated below, only properly formatted will be successfully uploaded. 
                                        </div>
                                    </div>

                                    <div id="div-value" class="form-group">
                                        <div class="col-sm-12">
                                            
                                            <div id="div-file-select" class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <div class="form-control" data-trigger="fileinput"> 
                                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                                    <span class="fileinput-filename"></span>
                                                </div>
                                                <span class="input-group-addon fileupload btn btn-primary btn-anim btn-file">
                                                    <i class="fa fa-upload"></i> 
                                                    <span class="fileinput-new btn-text">Select file
                                                </span> 
                                                <span class="fileinput-exists btn-text">Change</span>
                                                    <input type="hidden"><input id="value-file" type="file" name="...">
                                                </span> 
                                                <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput">
                                                    <i class="fa fa-trash"></i><span class="btn-text"> Remove</span>
                                                </a> 
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div id="div-upload-mdl-address-modal-bku" class="modal-footer">
                <hr class="light-grey-hr mb-10" />
                <button type="button" class="btn btn-primary" id="btn-upload-mdl-address-modal" value="add">Upload</button>
            </div>

        </div>
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline').hide();

    //Show Modal for Bulk Upload
    $(document).on('click', ".btn-mdl-bulk-upload-address-modal", function(e) {
        $('#div-address-modal-error-bku').hide();
        $('#mdl-bulk-upload-address-modal').modal('show');
        $('#frm-address-modal-bku').trigger("reset");

        $("#spinner-mdl-bulk-upload-address-modal").hide();
        $("#btn-upload-mdl-address-modal").attr('disabled', false);
    });

    //Save details
    $('#btn-upload-mdl-address-modal').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});

        //check for internet status 
        if (!window.navigator.onLine) {
            $('.offline').fadeIn(300);
            return;
        }else{
            $('.offline').fadeOut(300);
        }

        $("#spinner-mdl-bulk-upload-address-modal").show();
        $("#btn-upload-mdl-address-modal").attr('disabled', true);

        let actionType = "POST";
        let endPointUrl = "###### PATH TO UPLOAD #####";
        
        let formData = new FormData();
        formData.append('_token', $('input[name="_token"]').val());        
        formData.append('_method', actionType);
        formData.append('value', $('#value-file')[0].files[0]);
        @if (isset($organization) && $organization!=null)
            formData.append('organization_id', '{{$organization->id}}');
        @endif

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
                    $('#div-address-modal-error-bku').html('');
                    $("#spinner-mdl-bulk-upload-address-modal").show();
                    
                    $.each(result.errors, function(key, value){
                        $('#div-address-modal-error-bku').append('<li class="">'+value+'</li>');
                    });
                }else{
                    $('#div-address-modal-error-bku').hide();
                    window.setTimeout( function(){

                        $('#div-address-modal-error-bku').hide();
                        swal({
                                title: "Saved",
                                text: "Bulk upload completed successfully",
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

                $("#spinner-mdl-bulk-upload-address-modal").hide();
                $("#btn-upload-mdl-address-modal").attr('disabled', false);
                
            }, error: function(data){
                console.log(data);
                swal("Error", "Oops an error occurred. Please try again.", "error");

                $("#spinner-mdl-bulk-upload-address-modal").hide();
                $("#btn-upload-mdl-address-modal").attr('disabled', false);
            }
        });
    });

});
</script>
@endpush
