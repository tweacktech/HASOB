@php
$current_user = Auth::user();
@endphp


<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">

        <div class="d-flex flex-column align-items-center text-center">

            <button id="btn-profilePicBtn" class="position-absolute top-0 end-0 btn btn-sm btn btn-outline-primary mt-1 me-2 py-0 px-1 small"><small>Change</small></button>
            

            @if ( $current_user->profile_image == null )
                <img style="max-width:110px;" class="rounded-circle p-1 bg-primary" src="../imgs/bare-profile.png" alt="Change your Profile Picture">
            @else
                <img style="max-width:110px;" class="rounded-circle p-1 bg-primary" src="{{ route('fc.get-profile-picture', $current_user->id) }}" alt="Change your Profile Picture">
            @endif


            <input id="file-profilePic" class="upload" type="file" style="display:none;">

            <div class="mt-3">
                <h4>{{ $current_user->full_name }}</h4>
                <p class="text-secondary mb-1">
                    @php
                        $title_dept = [];
                        if (!empty($current_user->job_title)){
                            $title_dept []= $current_user->job_title;
                        }
                        if ($current_user->department != null && !empty($current_user->department->name)){
                            $title_dept []= $current_user->department->name;
                        }
                    @endphp

                    {{ implode(" | ", $title_dept) }}
                </p>
            </div>
        </div>
        <hr class="my-1" />
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                @php
                    $userRoles = $current_user->getRoleNames();
                @endphp
                @foreach ($userRoles as $idx=>$roleName)
                    <span class="badge bg-primary">{!! $roleName !!}</span>
                @endforeach
            </li>
            @if (isset($current_user->website_url) && empty($current_user->website_url)==false)
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                </h6>
                <span class="text-secondary">{{ $current_user->website_url }} </span>
            </li>
            @endif
        </ul>
    </div>
    <div class="card-footer bg-white text-center"> 
        <small class="text-muted">
            @if ($current_user->last_loggedin_at != null)
                Last logged in {{$current_user->last_loggedin_at->diffForHumans()}}
            @else
                Never Logged in.
            @endif
        </small>
    </div>
</div>



@push('page_scripts')
<script type="text/javascript">
    $(document).ready(function(){

        $('#btn-profilePicBtn').on('click', function() {
            $('#file-profilePic').trigger('click');
        });

        $('#btnPresence').click(function(){

            $('#error_div_availability').hide();
            $('#spinner').hide();
       
            $('#frm_availability').trigger("reset");
            $('#availability-modal').modal('show');
        });

        $('#attach-image').click(function(){
            $('#error_div_attachment').hide();
            $('#upload-form').trigger("reset");
            $('#attachment-modal').modal('show');

            $('#div_attachment_comments').hide();
            $('#div_attachment_file_name').hide();
            $('#attachment-modal-label').html('Upload Profile Picture');
            $('#spinner').show();
            $('#save').attr("disabled", true);
        });

        $("#file-profilePic").change(function(e){
            if (confirm('Are you sure you want to upload this file?')){

                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
                e.preventDefault();

                var formData = new FormData();
                formData.append('file', $(this)[0].files[0]);

                $.ajax({
                    url: "{{ route('fc.upload-profile-picture') }}",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data){

                        if (data!=null && data.status=='fail'){
                            
                            alert('An error has occurred while uploading the file.');
                            console.log(data);
                                
                        }else if (data!=null && data.status=='ok'){
                            alert("File uploaded.")
                            location.reload();

                        }else{
                            alert('An error has occurred while uploading file.');
                        }
                    },
                    error: function(data){
                        console.log(data);
                        $('#spinner').hide();
                        $('#save').attr("disabled", false);
                    }
                });
            }
        });

        $("#btn-add-attachment").click(function(e){
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
            e.preventDefault();

            var formData = new FormData();
            formData.append('file', $('#upload-form')[0][3].files[0]);

            $.ajax({
                url: "{{ route('fc.upload-profile-picture') }}",
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
                                    $('#error_msg_attachment').html('<strong>Errors</strong><br/>'+data.response[x]);
                                }
                            }
                        } else {
                            $('#error_msg_attachment').html('<strong>Error</strong><br/>An error has occurred.');
                        }
                    }else if (data!=null && data.status=='ok'){
                        alert("File uploaded.")
                        location.reload();
                    }else{
                        $('#error_msg_attachment').html('<strong>Error</strong><br/>An error has occurred.');
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        });

    });
</script>
@endpush
