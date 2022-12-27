
<script type="text/javascript">

$(document).ready(function(){
    $('#spinner').hide();
    $('#div-error-container').append('<div id="errorMsgUserDetails" class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    $('#errorDivUserDetails').hide();
    $('#errorMsgUserDetails').show();
    
    $('#spinner').hide();
        $('#save').attr("disabled", false);
    
    $('.rpd-dataform').css('float','right');

    $('#btnNewUser').click(function(e){

        $('.roleCbx').removeAttr('checked');
        $('#errorDivUserDetails').hide();

        $('#userTitle').val(null);
        $('#firstName').val(null);
        $('#middleName').val(null);
        $('#lastName').val(null);
        $('#phoneNumber').val(null);
        $('#emailAddress').val(null);
        $('#department').val(null);
        $('#jobTitle').val(null);

        $('#idUserDetails').val(-1);
        $('#mdlUserDetails').modal('show');
    });

    $('.btnEditUser').click(function(e){
        $('.roleCbx').removeAttr('checked');
        $('#errorDivUserDetails').hide();

        $('#userTitle').val(null);
        $('#firstName').val(null);
        $('#middleName').val(null);
        $('#lastName').val(null);
        $('#phoneNumber').val(null);
        $('#emailAddress').val(null);
        $('#department').val(null);
        $('#jobTitle').val(null);

        $('#idUserDetails').val($(this).attr('data-val'));
        $.get( "{{ route('fc.user.show',0) }}"+$(this).attr('data-val')).done(function( data ) {
            //$('#errorMsgUserDetails').hide()
            $('#userTitle').val(data.title);
            $('#firstName').val(data.first_name);
            $('#middleName').val(data.middle_name);
            $('#lastName').val(data.last_name);
            $('#phoneNumber').val(data.telephone);
            $('#emailAddress').val(data.email);
            $('#department').val(data.department);
            $('#jobTitle').val(data.job_title);

            for (role in data.roles) {
                $('#userRole'+data.roles[role].name).attr('checked','checked');
            }

            $('#mdlUserDetails').modal('show');
        });
    });

    $("#save").click(function(e){
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}});
        e.preventDefault();

        $('#spinner').show();
        $('#save').attr("disabled", true);

        var selectedRoles = [];
        $('.roleCbx').each(function() {
            if ($(this).prop('checked')==true){
                selectedId = $(this).attr('id');
                selectedRoles.push(selectedId.slice(8));
            }
        });

        $.ajax({
            url: "{{ route('fc.user.store','') }}/"+$(this).attr('data-val'),
            type: 'POST',
            data: {
                'userId':$('#idUserDetails').val(),
                'userTitle':$('#userTitle').val(),
                'firstName':$('#firstName').val(),
                'middleName':$('#middleName').val(),
                'lastName':$('#lastName').val(),
                'phoneNumber':$('#phoneNumber').val(),
                'emailAddress':$('#emailAddress').val(),
                'password1':$('#password1').val(),
                'password1_confirmation':$('#password1_confirmation').val(),
                'department':$('#department').val(),
                'jobTitle':$('#jobTitle').val(),
                // 'selectedRoles':selectedRoles,
            },
            
            success: function(data){
                if(data!=null && data.status=='fail'){
                    $('#errorMsgUserDetails').show();
                    $('#errorMsgUserDetails').empty();
                    console.log(data);
                    $.each(data.response, function(key, value){
                        console.log(data.response);
                        $('#errorMsgUserDetails').append('<li class="">'+value+'</li>');
                    });

                    $('#spinner').hide();
                    $('#save').attr("disabled", false);

                }else{
                    alert('Detail updated successfully');
                    location.reload();
                }
            },
            error: function(data){ 
                $('#spinner').hide();
                    $('#save').attr("disabled", false);
                console.log('Error:', data); }
        });

    });

});
</script>