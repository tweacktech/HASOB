@if ($commentable != null)

    <div id="comment-form" >

        {{ csrf_field() }}
        <input type="hidden" id="comment_primary_id" value="0">
        <div class="input-group">
            <span class="input-group-text"><span class="fa fa-comments-o"></span></span>
            <input id="{{ isset($comment_tag_id)?$comment_tag_id:'comment-text'}}" 
                    type="text" class="form-control input-sm" 
                    placeholder="Type in your comments and press enter to save comments"
            />
            <span class='input-group-text' class="btn-send-comment"><a href="#" id="btn-send-comment" class="btn-send-comment"><i class='img-circle img-sm fa fa-paper-plane' style='font-size:25px;padding-top:2px;'></i></a></span>
        </div>

    </div>
    

    @push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#comment_primary_id').hide()
            $("#comment-text").on('keypress', function(e){
                if (e.which==13 && $('#comment-text').val().length > 2){
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
                    $('#comment_primary_id').show()
                    e.preventDefault();
                    let spinner = '<div class="loader2" id="loader-1"></div>';
                    var formData = new FormData();
                    if( $('#comment_primary_id').val() == "0"){
                        options = JSON.stringify({
                        'commentable_id': '{{ $commentable->id }}',
                        'commentable_type':  String.raw`{{ get_class($commentable) }}`,
                        'comments':$('#comment-text').val(),
                        });
                    }else{
                        options = JSON.stringify({
                        'commentable_id': '{{ $commentable->id }}',
                        'commentable_type':  String.raw`{{ get_class($commentable) }}`,
                        'comments':$('#comment-text').val(),
                        'id': $('#comment_primary_id').val()
                        });
                    }
                   
                    formData.append('options', options);
                    swal({
                        html: true,
                        title: 'Submitting Post Please Wait!',
                        text:  spinner,
                        showCancelButton: false, 
                        showConfirmButton: false
                    });

                    $.ajax({
                        url: "{{ route('fc.comment-add') }}",
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(data){
                            swal.close();
                            if (data!=null && data.status=='fail'){
                                if (data.response!=null){     
                                    alert("Error submitting comments "+data.response);
                                }
                            }else if (data!=null && data.status=='ok'){
                                setTimeout(() => {
                                    alert("Comments have been saved.");
                                    location.reload();
                                }, 1000);
                                
                            }else{
                                alert("Error submitting comments");
                            }
                        },
                        error: function(data){
                            swal.close();
                            console.log(data);
                        }
                    });
                }
            });

            $("#btn-send-comment").on('click', function(e){
                e.preventDefault();
                if ( $('#comment-text').val().length > 2){
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
                    $('#comment_primary_id').show()
                    e.preventDefault();
                    let spinner = '<div class="loader2" id="loader-1"></div>';
                    var formData = new FormData();
                    if( $('#comment_primary_id').val() == "0"){
                        options = JSON.stringify({
                        'commentable_id': '{{ $commentable->id }}',
                        'commentable_type':  String.raw`{{ get_class($commentable) }}`,
                        'comments':$('#comment-text').val(),
                        });
                    }else{
                        options = JSON.stringify({
                        'commentable_id': '{{ $commentable->id }}',
                        'commentable_type':  String.raw`{{ get_class($commentable) }}`,
                        'comments':$('#comment-text').val(),
                        'id': $('#comment_primary_id').val()
                        });
                    }
                   
                    formData.append('options', options);
                    swal({
                        html: true,
                        title: 'Submitting Post Please Wait!',
                        text:  spinner,
                        showCancelButton: false, 
                        showConfirmButton: false
                    });

                    $.ajax({
                        url: "{{ route('fc.comment-add') }}",
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(data){
                            swal.close();
                            if (data!=null && data.status=='fail'){
                                if (data.response!=null){     
                                    alert("Error submitting comments "+data.response);
                                }
                            }else if (data!=null && data.status=='ok'){
                                setTimeout(() => {
                                    alert("Comments have been saved.");
                                    location.reload();
                                }, 1000);
                                
                            }else{
                                alert("Error submitting comments");
                            }
                        },
                        error: function(data){
                            swal.close();
                            console.log(data);
                        }
                    });
                }
            });

            $(".btn-edit-mdl-comment-modal").on('click', function(e){
                e.preventDefault();
                $('#comment_primary_id').val($(this).attr('data-val'))
                let id = $(this).attr('data-val');
                console.log(id);
                let comment = $('#comment_'+id)[0].innerText;
                $('#comment-text').val(comment);      
            });

        });
    </script>
    @endpush

@endif