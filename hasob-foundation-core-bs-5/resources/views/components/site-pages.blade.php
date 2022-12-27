



<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-wrapper collapse in">
            
                <div class="card-body pt-0">

                    <div class="row">
                        <div class="col-md-12 mb-15">

                            <a id="btn-site-options" href="#" class="text-primary" data-toggle="tooltip" title="Site Settings" style=""><span class="fa fa-cogs mr-5"></span></a>    
                            <a id="btn-site-add-page" href="#" class="text-primary btn-new-mdl-page-modal" data-toggle="tooltip" title="Add Page" style=""><span class="fa fa-file-text-o mr-5"></span></a>    
                            <a id="btn-site-delete" href="#" class="text-primary" data-toggle="tooltip" title="Delete Site" style=""><span class="fa fa-trash mr-5"></span></a>
                            <a id="btn-site-rename" href="#" class="text-primary" data-toggle="tooltip" title="Rename Site" style=""><span class="fa fa-edit mr-5"></span></a>
                    
                        </div>
                    </div>

                    @if (isset($site) && $site!=null && count($site->pages)>0)
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th width="50%">Page</th>
                                            <th class="text-center">Path</th>
                                            <th></th>
                                            <th>Creator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($site->pages as $item)
                                        <tr>
                                            <td width="50%">
                                                
                                                <a href="javascript:void(0)" class="pr-5 text-danger" data-toggle="tooltip" title="" data-original-title="Delete" aria-describedby="">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="pr-5 text-success btn-edit-mdl-page-editor-modal" data-val="{{$item->id}}" data-toggle="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip563536">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                {{$item->page_name}}
                                            </td>
                                            <td class="text-center">
                                                {{$item->page_path}}
                                            </td>
                                            <td class="text-center">
                                                
                                            </td>
                                            <td>
                                                @if ($item->creator != null)
                                                {{$item->creator->full_name}}
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p>No Pages, use the create button to create a page.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdl-page-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 id="lbl-page-modal-title" class="modal-title">Page</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="div-page-modal-error" class="alert alert-danger" role="alert"></div>
                    <form class="form-horizontal" id="frm-page-modal" role="form" method="POST" enctype="multipart/form-data" action="">
                        <div class="row">
                            <div class="col-lg-12 ma-10">
                                @csrf

                                <div id="spinner1" class="">
                                    <div class="loader" id="loader-1"></div>
                                </div>

                                <input type="hidden" id="txt-page-primary-id" value="0" />

                                <div id="div-edit-txt-page-primary-id">
                                    <div class="row">
                                        <div class="col-lg-10 ma-10">
                                        
                                            <div id="div-name" class="form-group">
                                                <label class="control-label mb-10 col-sm-3" for="ledger_name">Name</label>
                                                <div class="col-sm-9">
                                                    {!! Form::text('page_name',null,['id'=>'page_name','class'=>'form-control','maxlength'=>100,'maxlength'=>100]) !!}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <hr class="light-grey-hr mb-10" />
                    <button type="button" class="btn btn-primary" id="btn-save-mdl-page-modal" value="add">Save</button>
                </div>

            </div>
        </div>
    </div>    

    <x-hasob-foundation-core::page-editor />

</div>



@push('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
    
        //Show Modal for New Entry
        $(document).on('click', ".btn-new-mdl-page-modal", function(e) {
            $('#div-page-modal-error').hide();
            $('#mdl-page-modal').modal('show');
            $('#frm-page-modal').trigger("reset");
            $('#txt-page-primary-id').val(0);
    
            $('#div-edit-txt-page-primary-id').show();
        });
        
        //Save details
        $('#btn-save-mdl-page-modal').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
    
            let actionType = "POST";
            let endPointUrl = "{{ route('fc.pages.store') }}";
            let primaryId = $('#txt-page-primary-id').val();
            
            let formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
    
            if (primaryId != "0"){
                actionType = "PUT";
                endPointUrl = "{{ route('fc.pages.update','') }}/"+primaryId;
                formData.append('id', primaryId);
            }
            
            formData.append('_method', actionType);
            formData.append('site_id', '{{ $site->id }}');
            formData.append('page_name', $('#page_name').val());
    
            $.ajax({
                url:endPointUrl,
                type: actionType,
                data: formData,
                cache: false,
                processData:false,
                contentType: false,
                dataType: 'json',
                success: function(result){
                    if(result.errors){
                        $('#div-page-modal-error').html('');
                        $('#div-page-modal-error').show();
                        
                        $.each(result.errors, function(key, value){
                            $('#div-page-modal-error').append('<li class="">'+value+'</li>');
                        });
                    }else{
                        $('#div-page-modal-error').hide();
                        window.setTimeout( function(){
                            window.alert("Page saved successfully.");
                            $('#div-page-modal-error').hide();
                            location.reload(true);
                        },20);
                    }
                }, error: function(data){
                    console.log(data);
                }
            });
        });
    
    
    });
    </script>
@endpush