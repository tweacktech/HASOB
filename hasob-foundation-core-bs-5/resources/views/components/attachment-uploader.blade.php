@if ($attachable!=null)
   
    <button id='btn-show-attachment-upload' type="button" class="btn btn-xs btn-primary">Upload</button>
    <div class="modal fade" id="attachment-modal" tabindex="-1" role="dialog" aria-labelledby="attachment-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="attachment-modal-label">Add Attachment</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                <div id="error_div_attachment" class="alert alert-danger" role="alert">
                    <span id="error_msg_attachment"></span>
                </div>

                <form class="form-horizontal" id="upload-form" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div id="div_attachment_file_name" class="mb-3">
                        <label class="form-label">File Name</label>
                        <div class="col-xs-9">
                        <div class="{{ $errors->has('attachment_name') ? ' has-error' : '' }}" >
                            <input type='text' class="form-control" id="attachment_name" name="attachment_name" value="{{ old('attachment_name') }}" required />
                        </div>
                        </div>
                    </div>

                    <div id="div_attachment_comments" class="mb-3">
                    <label class="form-label">Comments</label>
                    <!-- <div class="col-sm-9"> -->
                        <div class="{{ $errors->has('attachment_comments') ? ' has-error' : '' }}" >
                        <textarea class="form-control" id="attachment_comments" name="attachment_comments" rows="3" required></textarea>
                        </div>
                    <!-- </div> -->
                    </div>

                    <div class="mb-3">
                    <label class="form-label">Upload File</label>
                    <!-- <div class="col-sm-9">
                        <div class="btn btn-primary teal lighten-1"> -->
                            <input class='form-control' type="file" name="image">
                        <!-- </div>
                    </div> -->
                    </div>

                </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-add-attachment" value="add">
                        <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>Upload</button>
                </div>
            </div>
        </div>
    </div>


    @push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btn-add-attachment span').hide();
            $('#btn-show-attachment-upload').click(function(){
                $('#error_div_attachment').hide();
                $('#upload-form').trigger("reset");
                $('#attachment-modal').modal('show');
            });

            $("#btn-add-attachment").click(function(e){
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
                e.preventDefault();
                 $('#btn-add-attachment span').show();
                 $('#btn-add-attachment').attr('disabled',true);
                var formData = new FormData();
                formData.append('file', $('#upload-form')[0][3].files[0]);
                options = JSON.stringify({
                    'name':$('#attachment_name').val(),
                    'comments':$('#attachment_comments').val(),
                    'attachable_id': '{{ $attachable->id }}',
                    'attachable_type':  String.raw`{{ get_class($attachable) }}`,
                });
                formData.append('options', options);

                $.ajax({
                    url: "{{ route('fc.attachment.store') }}",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data){

                        if (data!=null && data.status=='fail'){
                            $('#error_div_attachment').show();
                            if (data.response!=null){
                                for (x in data.response) {
                                    if ($.isArray(data.response[x])){
                                        $('#error_msg_attachment').html('<strong>Errors</strong><br/>'+data.response[x].join('<br/>'));
                                    }else{
                                        $('#btn-add-attachment span').hide();
                                     $('#btn-add-attachment').attr('disabled',false);
                                        $('#error_msg_attachment').html('<strong>Errors</strong><br/>'+data.response[x]);
                                    }
                                }
                            } else {
                                $('#btn-add-attachment span').hide();
                               $('#btn-add-attachment').attr('disabled',false);
                                $('#error_msg_attachment').html('<strong>Error</strong><br/>An error has occurred.');
                            }
                        }else if (data!=null && data.status=='ok'){
                            alert("File uploaded.")
                            location.reload();
                        }else{
                            $('#btn-add-attachment span').hide();
                            $('#btn-add-attachment').attr('disabled',false);
                            $('#error_msg_attachment').html('<strong>Error</strong><br/>An error has occurred.');
                        }
                    },
                    error: function(data){
                         $('#btn-add-attachment span').hide();
                         $('#btn-add-attachment').attr('disabled',false);
                        console.log(data);
                    }
                });
            });

        });
    </script>
    @endpush

@endif