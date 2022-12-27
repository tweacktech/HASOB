@if ($attachable != null)

@push('page_css')
<link rel="stylesheet" href="{{ asset('hasob-foundation-core/vendor/dropzone-5.7.0/dist/dropzone.css') }}" />
@endpush

<button type="button" class="btn btn-xs btn-danger" id="btnNewUpload" data-toggle="tooltip" title="Upload File"> <span class="fa fa-cloud-upload"></span> Upload</button>

<div class="modal fade" id="file-upload-zone-modal" tabindex="-1" role="dialog" aria-labelledby="file-upload-zone-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 id="lbl-beneficiary-modal-title" class="modal-title">Pictures</h4>
            </div>
            <div class="modal-body">

                <div id="error_div_file-upload-zone" class="alert alert-danger" role="alert">
                    <span id="error_msg_file-upload-zone"></span>
                </div>

                <form action="{{ route('fc.attachment.store') }}" class="dropzone" id="file-upload-dropzone">
                    {{ csrf_field() }}
                    <div class="dz-message needsclick">
                        <i class="fa fa-cloud-upload fa-3x"></i> <br />
                        Drop files here or click to upload<br />
                        <div id="close-uploader" style="margin: 10px 0 10px 0 ; position:absolute; bottom: 10px; right:20px">
                            <button class="btn btn-primary btn-sm close-uploader" type="button">OK</button>
                        </div>
                    </div>
                    
                    <div id="previews" class="table table-striped files"></div>
                    <div id="preview-template" class="file-row" style="display: none;">
                        <div>
                            <span data-dz-name></span> - <span class="size" data-dz-size></span> <span class="success-msg"></span> <span class="error-msg"></span>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="margin-bottom: 0px;">
                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                            </div>
                            <strong class="error text-danger" data-dz-errormessage></strong>
                        </div>
                    </div>        
                </form>

            </div>

        </div>
    </div>
</div>



@push('page_scripts')
<script src="{{ asset('hasob-foundation-core/vendor/dropzone-5.7.0/dist/dropzone.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#btnNewUpload').click(function() {
            $('#close-uploader').hide();
            $('#error_div_file-upload-zone').hide();
            $('#file-upload-zone-modal').modal('show');
        });
        $('.close-uploader').click(function() {
            $('#file-upload-zone-modal').modal('hide');
            location.reload(true);
        });

    });

    var CSRF_TOKEN = document.querySelector('input[name="_token"]').getAttribute("content");
    Dropzone.autoDiscover = false;
    var fileDropzone = new Dropzone(".dropzone", {

        maxFilesize: {{$max_mb_size}},
        timeout: 5000000,
        acceptedFiles: "{{$file_types}}",
        parallelUploads: 2,
        thumbnailHeight: 8,
        thumbnailWidth: 8,

        previewsContainer: "#previews",
        previewTemplate: document.getElementById('preview-template').innerHTML,

        success: function(file, response) {
            file.previewElement.querySelector('.error-msg').innerHTML = "";
            file.previewElement.querySelector('.success-msg').innerHTML = "<strong class='text-blue'>DONE!!</strong>";
            file.previewElement.querySelector(".progress-bar").style.display = "none";
            //location.reload();
            $('#close-uploader').show();
        },
        error: function(file, response) {
            file.previewElement.querySelector('.error-msg').innerHTML = "<strong class='text-red'>ERROR!!</strong>";
            file.previewElement.querySelector('.success-msg').innerHTML = "";
            file.previewElement.querySelector(".progress-bar").style.display = "none";
            console.log(response);
            //alert('Error uploading files');
        }
    });

    fileDropzone.on("sending", function(file, xhr, formData) {

        options = JSON.stringify({
            'name':file.name,
            'attachable_id': '{{ $attachable->id }}',
            'attachable_type':  String.raw`{{ get_class($attachable) }}`,
        });
        formData.append('options', options);
        formData.append("_token", CSRF_TOKEN);

        // document.querySelector("#total-progress").style.opacity = "1";
    });
</script>
@endpush

@endif