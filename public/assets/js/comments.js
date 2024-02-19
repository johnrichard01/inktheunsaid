document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const replyLinks = document.querySelectorAll('.reply-link');
    const replyForms = document.querySelectorAll('.reply-form');

    function toggleReplyForms(commentId) {
        replyForms.forEach(form => {
            form.style.display = form.getAttribute('data-comment-id') === commentId ? 'block' : 'none';
        });
    }

    
    replyLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const commentId = this.getAttribute('data-comment-id');
            toggleReplyForms(commentId);
        });
    });

    replyForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const commentId = this.getAttribute('data-comment-id');
            const replyText = this.querySelector('textarea[name="reply_text"]').value;

            fetch(`/comments/${commentId}/replies`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken,
                },
                body: JSON.stringify({
                    reply_text: replyText,
                    _token: csrfToken,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('JSON Response:', data);
                // Handle JSON response here

                // Reload the page after the reply submission is completed
                window.location.reload();
            })
            .catch(error => {
                console.error('Error handling reply submission:', error);
            });

            // Reset the form
            this.querySelector('textarea[name="reply_text"]').value = '';
            this.style.display = 'none';
        });
    });
});

