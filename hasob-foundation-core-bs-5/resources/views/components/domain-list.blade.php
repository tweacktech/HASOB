

    <div class="card">
        <div class="card-body">
    
            @if (isset($domains) && count($domains)>0)
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table class="table table-hover table-stripe mb-0">
                            <thead>
                                <tr>
                                    <th width="">Organization/Domain</th>
                                    <th class="">Full URL</th>
                                    <th class="">Subdomain</th>
                                    <th class="">Local Default</th>
                                    <th>Shut Down</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($domains as $item)
                                <tr>
                                    <td width="30%">                                                
                                        <a href="javascript:void(0)" class="pr-5 text-primary btn-edit-mdl-organization-modal" data-val="{{$item->id}}" data-toggle="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip563536">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="pr-10 text-primary btn-delete-mdl-organization-modal" data-val="{{$item->id}}" data-toggle="tooltip" title="" data-original-title="Delete" aria-describedby="tooltip563">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                        {{$item->org}}/{{$item->domain}}
                                    </td>
                                    <td>
                                        {{$item->full_url}}
                                    </td>
                                    <td>
                                        {{$item->subdomain}}
                                    </td>
                                    <td>
                                        {{$item->is_local_default_organization ? 'Yes' : 'No'}}
                                    </td>
                                    <td>
                                        {{$item->is_shut_down ? 'Yes' : 'No'}}
                                        @if ($item->is_shut_down)
                                        <span class="small">
                                            <br/>
                                            {{ $item->shut_down_reason}}
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p>No Domains, use the add button to add a domain.</p>
            @endif

        </div>
    </div>

    <div class="modal fade" id="mdl-organization-modal" tabindex="-1" role="dialog" aria-labelledby="mdl-department-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="lbl-organization-modal-title">Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="div-organization-modal-error" class="alert alert-danger" role="alert"></div>
                    <form id="frm-organization-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                                @csrf

                                <input type="hidden" id="txt-organization-primary-id" value="0" />

                                <div id="div-edit-txt-organization-primary-id">                                        
                                            <!-- Org Field -->
                                            <div id="div-org" class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label col-md-6" for="org">Organization</label>
                                                    {!! Form::text('org', null, ['id'=>'org', 'class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label col-md-6" for="org">Domain</label>
                                                    {!! Form::text('domain', null, ['id'=>'domain', 'placeholder'=>'Domain e.g. test, beta, live', 'class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                                                </div>
                                            </div>

                                            <!-- Full Url Field -->
                                            <div id="div-full_url" class="mb-3">
                                                <label class="form-label " for="full_url">Full Url</label>
                                                <div >
                                                    {!! Form::text('full_url', null, ['id'=>'full_url', 'class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                                                </div>
                                            </div>

                                            <!-- Subdomain Field -->
                                            <div id="div-subdomain" class="mb-3">
                                                <label class="form-label" for="subdomain">Subdomain</label>
                                                <div>
                                                    {!! Form::text('subdomain', null, ['id'=>'subdomain', 'class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
                                                </div>
                                            </div>

                                            <!-- Is Local Default Organization Field -->
                                            <div id="div-is_local_default_organization" class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        {{-- {!! Form::hidden('is_local_default_organization', 0, ['id'=>'is_local_default_organization', 'class' => 'form-check-input']) !!} --}}
                                                        {!! Form::checkbox('is_local_default_organization', '1', null, ['id'=>'is_local_default_organization', 'class' => 'form-check-input']) !!}
                                                        <label class="form-label" for="is_local_default_organization">Is Default</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Is Shut Down Field -->
                                            <div id="div-is_shut_down" class="row mb-3">
                                                <div class="col-md-6">
                                                    
                                                    <div class="form-check">
                                                        {{-- {!! Form::hidden('is_shut_down', 0, ['id'=>'is_shut_down', 'class' => 'form-check-input']) !!} --}}
                                                        {!! Form::checkbox('is_shut_down', '1', null, ['id'=>'is_shut_down', 'class' => 'form-check-input']) !!}
                                                        <label class="form-label" for="is_shut_down">Shut Down</label>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    
                                                </div>
                                            </div>

                                            <!-- Shut Down Reason Field -->
                                            <div id="div-shut_down_reason" class="mb-3">
                                                <label class="form-label" for="shut_down_reason">Shut Down Reason</label>
                                                <div>
                                                    {!! Form::textarea('shut_down_reason', null, ['id'=>'shut_down_reason', 'rows'=>'3', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            


                                        </div>
                    </form>
                </div>

               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-save-mdl-organization-modal" value="add">
                    <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="visually-hidden">Loading...</span>Save</button>
                </div>


            </div>
        </div>
    </div>



@push('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
    
        //Show Modal for New Entry
        $(document).on('click', ".btn-new-mdl-organization-modal", function(e) {
            $('#spinner').hide()
            $('#div-organization-modal-error').hide();
            $('#mdl-organization-modal').modal('show');
            $('#frm-organization-modal').trigger("reset");
            $('#txt-organization-primary-id').val(0);
    
            $('#div-show-txt-organization-primary-id').hide();
            $('#div-edit-txt-organization-primary-id').show();
            $('#spinner').hide()
            $('#btn-save-mdl-organization-modal').attr('disable',false)
        });
    
        //Show Modal for Edit
        $(document).on('click', ".btn-edit-mdl-organization-modal", function(e) {
            e.preventDefault();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
    
            $('#div-show-txt-organization-primary-id').hide();
            $('#div-edit-txt-organization-primary-id').show();
             $('#spinner').hide()
            $('#btn-save-mdl-organization-modal').attr('disable',false)
            $('.btn-edit-mdl-organization-modal').attr('disable',false)
            let itemId = $(this).attr('data-val');
    
            $.get( "{{ route('fc.organizations.show','') }}/"+itemId).done(function( data ) {
        
                $('#div-organization-modal-error').hide();
                $('#mdl-organization-modal').modal('show');
                $('#frm-organization-modal').trigger("reset");

                $('#txt-organization-primary-id').val(data.response.id);    
                $('#org').val(data.response.org);
                $('#domain').val(data.response.domain);
                $('#full_url').val(data.response.full_url);
                $('#subdomain').val(data.response.subdomain);
                $('#shut_down_reason').val(data.response.shut_down_reason);

                $('#is_local_default_organization')[0].checked = false;
                if (data.response.is_local_default_organization == 1){
                    $('#is_local_default_organization')[0].checked = true;
                }

                $('#is_shut_down')[0].checked = false;
                if (data.response.is_shut_down == 1){
                    $('#is_shut_down')[0].checked = true;
                }

            });
        });
    
        //Delete action
        $(document).on('click', ".btn-delete-mdl-organization-modal", function(e) {
            e.preventDefault();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
            $('#spinner').show();
                $('.btn-delete-mdl-organization-modal').attr("disabled", true);
    
            let itemId = $(this).attr('data-val');
            swal({
                title: "Are you sure you want to delete this Domain?",
                text: "You will not be able to recover this Domain record if deleted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
            
    
                let endPointUrl = "{{ route('fc.organizations.destroy','') }}/"+itemId;
    
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
                             $('#spinner').hide();
                $('.btn-delete-mdl-organization-modal').attr("disabled", false);
                            console.log(result.errors)
                        }else{
                           
                            swal({
                                        title: "Deleted",
                                        text: "The Domain record has been deleted.",
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
    })
    
        //Save details
        $('#btn-save-mdl-organization-modal').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
            $('#spinner').show();
            $('#btn-save-mdl-organization-modal').attr("disabled", true);
            let actionType = "POST";
            let endPointUrl = "{{ route('fc.organizations.store') }}";
            let primaryId = $('#txt-organization-primary-id').val();
            
            let formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
    
            if (primaryId != "0"){
                actionType = "PUT";
                endPointUrl = "{{ route('fc.organizations.update','') }}/"+primaryId;
                formData.append('id', primaryId);
            }
            
            formData.append('_method', actionType);
            formData.append('org', $('#org').val());
            formData.append('domain', $('#domain').val());
            formData.append('full_url', $('#full_url').val());
            formData.append('subdomain', $('#subdomain').val());
            formData.append('shut_down_reason', $('#shut_down_reason').val());
            formData.append('is_shut_down', $('#is_shut_down').is(':checked') ? 1:0);
            formData.append('is_local_default_organization', $('#is_local_default_organization').is(':checked') ? 1:0);

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
                        $('#div-organization-modal-error').html('');
                        $('#div-organization-modal-error').show();
                        
                        $.each(result.errors, function(key, value){
                            $('#div-organization-modal-error').append('<li class="">'+value+'</li>');
                        });
                    }else{
                        $('#div-organization-modal-error').hide();
                        $('#spinner').hide();
                        $('#btn-save-mdl-organization-modal').attr("disabled", false);
                       
                           
                        
                            swal({
                                title: "Saved",
                                text: "The Domain saved successfully.",
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
                $('#btn-save-mdl-organization-modal').attr("disabled", false);
                    console.log(data);
                }
            });
        });
    
    });
</script>
@endpush