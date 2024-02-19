$(document).ready(function(){
    $('.btn-view').click(function(){
        let id = $(this).attr('data-id');
        $.ajax({
            url:'/dashboard/blogs-detail/'+id,
            type: 'GET',
            data: {
                "id": id
            },
            success:function(data){
                $('#modalTitle').html(data.title);
                $('#modalDesc').html(data.description);
                let baseUrl= $('#modalUrl').data('base-url');
                let thumbnailSrc = data.thumbnail ? baseUrl + 'storage/' + data.thumbnail : baseUrl + 'assets/images/nothumbnail.png';
                $('#modalThumb').attr('src', thumbnailSrc);
                $.ajax({
                    url: '/dashboard/user/' + data.user_id,
                    type: 'GET',
                    success: function(user) {
                        $('#modalAuthor').html('by:'+' '+user.username);
                    }
                });

            }
        })
    });
});

$(document).ready(function(){
    $('.deleteBTN').click(function (event){
        event.preventDefault();
        let blog_id=$(this).val();
        $('#blog_id').val(blog_id);
        $('#modalDelete').modal('show');
    })
})