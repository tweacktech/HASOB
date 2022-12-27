

<script type="text/javascript">
    $(document).ready(function() {
        let page_total = 0;
        let current_page = 0;
        {{$control_id}}_display_results("{{$control_obj->getJSONDataRouteName()}}");

        function {{$control_id}}_display_results(endpoint_url){
            $.ajaxSetup({
                cache: false, 
                headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"}
            });

            //check for internet status 
            if (!window.navigator.onLine) {
                $('.offline').fadeIn(300);
                return;
            }else{
                $('.offline').fadeOut(300);
            }

            $("#spinner-{{$control_id}}").show();
            $('#{{$control_id}}-div-card-view').empty();
            $('#{{$control_id}}-div-card-view').append("<span class='text-center ma-20 pa-20'>Loading.....</span>");

            $.get(endpoint_url).done(function( response ) {
                console.log(response);
                current_page = parseInt(response.page_number);
                page_total = parseInt(response.pages_total);
                if (response != null && response.cards_html != null){
                    $('#{{$control_id}}-div-card-view').empty();
                    $('#{{$control_id}}-div-card-view').append(response.cards_html);
                }
                if (response != null && response.result_count==0){
                    $('#{{$control_id}}-div-card-view').empty();
                    $('#{{$control_id}}-div-card-view').append("<span class='text-center ma-20 pa-20' style='padding-bottom:100px'>No results found.</span>");
                }
                $("#{{$control_id}}-pagination").empty();
                if (response != null && response.paginate && response.result_count > 0){
                    // $("#{{$control_id}}-pagination").append("<li><span class='pre'> <a href='#' id='pre' data-type='pre' class='{{$control_id}}-pg'><i class='fa fa-angle-left'></i><i class='fa fa-angle-left'></i></a></span></li>"); 
                    $("#{{$control_id}}-pagination").append(`<nav aria-label="Page navigation">
                        <ul class="pagination"><li class="page-item ${current_page == 1 && 'disabled'}"><span class='pre'> <a href='#' id='pre' data-type='pre'  class='{{$control_id}}-pg page-link'><i class='fa fa-angle-left'></i><i class='fa fa-angle-left'></i></a></span></li> </ul>
                        </nav>`); 
                    for(let pg=1;pg<=response.pages_total;pg++){
                        $("#{{$control_id}}-pagination").append(`<li class="page-item"><a data-val='${pg}' data-type='pg' class='{{$control_id}}-pg pg-${pg} page-link' href='#'>${pg}</a></li>`);
                        (current_page == pg) ? $('.pg-'+pg).addClass('cdv-current-page') : $('.pg-'+pg).addClass('text-primary');
                    }
                    // $("#{{$control_id}}-pagination").append("<li><span class='nxt'><a href='#' id='nxt' data-type='nxt'  class='{{$control_id}}-pg'><i class='fa fa-angle-right'></i><i class='fa fa-angle-right'></i></a></span></li>");
                    $("#{{$control_id}}-pagination").append(`<nav aria-label="Page navigation">
                        <ul class="pagination"><li class="page-item ${page_total == current_page && 'disabled'}"><span class='nxt'><a href='#' id='nxt' data-type='nxt'  class='{{$control_id}}-pg page-link'><i class='fa fa-angle-right'></i><i class='fa fa-angle-right'></i></a></span></li> </ul>
                        </nav>`);
                    if(current_page == 1){
                        $('.pre').addClass('disable');
                        $('#pre').addClass('disable-link');
                    }
                    if(page_total == current_page){
                        $('.nxt').addClass('disable');
                        $('#nxt').addClass('disable-link');
                    }  
                           
                    
                    $("#{{$control_id}}-pagination").show();
                  
                    //$("#{{$control_id}}-pagination").show();
                }
                $("#spinner-{{$control_id}}").hide();
            });
        }

        $(document).on('keyup', "#{{$control_id}}-txt-search", function(e) {
            e.preventDefault();
            let search_term = $('#{{$control_id}}-txt-search').val();
            {{$control_id}}_display_results("{{$control_obj->getJSONDataRouteName()}}?st="+search_term);
        });

        $(document).on('click', "#{{$control_id}}-btn-search", function(e) {
            e.preventDefault();
            let search_term = $('#{{$control_id}}-txt-search').val();
            {{$control_id}}_display_results("{{$control_obj->getJSONDataRouteName()}}?st="+search_term);
        });

        $(document).on('click', ".{{$control_id}}-grp", function(e) {
            e.preventDefault();
            let group_term = $(this).attr('data-val');
            $("#{{$control_id}}-pagination").hide();
            {{$control_id}}_display_results("{{$control_obj->getJSONDataRouteName()}}?grp="+group_term);
            
        });

        $(document).on('click', ".{{$control_id}}-pg", function(e) {
            e.preventDefault();
            console.log(e);
            let page_number = 1;
            $("#{{$control_id}}-pagination").hide();
            if($(this).attr('data-type') == 'pg'){
                page_number = $(this).attr('data-val');
            }
            if($(this).attr('data-type') == 'pre'){
               page_number = parseInt(current_page) - 1;
            }
            if($(this).attr('data-type') == 'nxt'){
                page_number = parseInt(current_page) + 1;
            }
           
            {{$control_id}}_display_results("{{$control_obj->getJSONDataRouteName()}}?pg="+page_number);
        });
        
    });
</script>