
@if ($attachable!=null)

    @push('page_css')
    <style type="text/css">
        @media (min-width: 768px) {
            .modal-xl {
                width: 90%;
                max-width:1200px;
            }
        }
        #attachment-viewer-modal > .modal {
            height: 100vh;
        }
        #attachment-viewer-modal > .modal-dialog {
            height: 100vh;
        }
        #attachment-viewer-modal > .modal-content {
            height: 95vh;
        }
    </style>
    @endpush


    @php
        $attachments = $attachable->get_attachments($file_types);
    @endphp

    @if (count($attachments) > 0)

        <button class="btn btn-xs btn-danger float-end" id="{{$control_id}}_btnShowAttachmentViewer">Viewer</button>

        <div class="modal fade" id="{{$control_id}}_attachment-viewer-modal" role="dialog" aria-labelledby="attachment-viewer-label" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="{{$control_id}}_attachment-viewer-modal-label"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <small id="{{$control_id}}_attachment-viewer-modal-description"></small>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <embed id="{{$control_id}}_pdfEmbed" src="" width="100%" height="100%" style='height:75vh'/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-xs btn-primary float-start" id="{{$control_id}}_showPrevious"> << Previous </button>
                        <button class="btn btn-xs btn-primary" id="{{$control_id}}_showNext"> Next >> </button>
                    </div>
                </div>
            </div>
        </div>

        @push('page_scripts')
        <script type="text/javascript">
            $(document).ready(function(){

                var attach_list = [];
                var attach_list_names = [];
                var attach_list_descriptions = [];
                var attach_location = 0;
                @foreach ($attachments as $idx => $attach)
                    attach_list.push("{{ route('fc.attachment.show', $attach->id) }}");
                    attach_list_names.push("{{ $attach->label  }}");
                    attach_list_descriptions.push("{{ $attach->description }}");
                @endforeach

                function displayAttachmentDetails(idx){
                    $("#{{$control_id}}_attachment-viewer-modal-label").text(attach_list_names[idx]);
                    $("#{{$control_id}}_attachment-viewer-modal-description").text(attach_list_descriptions[idx]);
                }

                $('#{{$control_id}}_btnShowAttachmentViewer').click(function(){
                    
                    var parent = $('embed#{{$control_id}}_pdfEmbed').parent();
                    var newElement = "<embed src='"+attach_list[attach_location]+"' id='pdfEmbed' height='100%' width='100%' style='height:75vh'>";

                    if (attach_list[attach_location]!=null){
                        $('embed#{{$control_id}}_pdfEmbed').remove();
                        parent.append(newElement);
                        displayAttachmentDetails(attach_location);
                        $('#{{$control_id}}_attachment-viewer-modal').modal('show');
                    }
                });

                $('#{{$control_id}}_showNext').click(function(){
                    if (attach_location<(attach_list.length-1)){
                        var parent = $('embed#pdfEmbed').parent();
                        var newElement = "<embed src='"+attach_list[++attach_location]+"' id='pdfEmbed' height='100%' width='100%' style='height:75vh'>";
                        $('embed#pdfEmbed').remove();

                        if (attach_list[attach_location]!=null){
                            displayAttachmentDetails(attach_location);
                            parent.append(newElement);
                        }
                    }
                });

                $('#{{$control_id}}_showPrevious').click(function(){
                    if (attach_location>0){
                        var parent = $('embed#{{$control_id}}_pdfEmbed').parent();
                        var newElement = "<embed src='"+attach_list[--attach_location]+"' id='pdfEmbed' height='100%' width='100%' style='height:75vh'>";
                        $('embed#{{$control_id}}_pdfEmbed').remove();

                        if (attach_list[attach_location]!=null){
                            displayAttachmentDetails(attach_location);
                            parent.append(newElement);
                        }
                    }
                });

            });
        </script>
        @endpush

    @endif

@endif