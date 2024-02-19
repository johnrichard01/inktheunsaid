document.addEventListener('DOMContentLoaded', function () {
    const replyLinks = document.querySelectorAll('.replies');

    replyLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const commentId = this.getAttribute('data-comment-id');
            const repliesList = document.getElementById(`replies-list-${commentId}`);

            // Toggle the display of replies
            if (repliesList.style.display === 'none') {
                repliesList.style.display = 'block';
                this.classList.add('active-link');
            } else {
                repliesList.style.display = 'none';
                this.classList.remove('active-link'); 
            }
        });
    });
});
