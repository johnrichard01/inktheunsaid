$(document).ready(function(){
    $('.deleteBTN').click(function (event){
        event.preventDefault();
        let user_id=$(this).val();
        $('#user_id').val(user_id);
        $('#modalDelete').modal('show');
    })
})