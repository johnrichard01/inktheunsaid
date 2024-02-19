$(document).ready(function(){
    $('.btn-view').click(function(){
        let id = $(this).attr('data-id');
        $.ajax({
            url:'/dashboard/contact/'+id,
            type: 'GET',
            data: {
                "id": id
            },
            success:function(data){
                $('#firstName').val(data.firstName);
                $('#lastName').val(data.lastName);
                $('#email').val(data.email);
                $('#message').val(data.message);
            }
        })
    });
});

$('#blogsView').on('hidden.bs.modal', function () {
    location.reload();
});
$(document).ready(function(){
    $('.deleteBTN').click(function (event){
        event.preventDefault();
        let user_id=$(this).val();
        $('#user_id').val(user_id);
        $('#modalDelete').modal('show');
    })
})