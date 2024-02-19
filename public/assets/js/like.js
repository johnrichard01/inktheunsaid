document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const replyLinks = document.querySelectorAll('.reply-link');
    const replyForms = document.querySelectorAll('.reply-form');
    const likeButtons = document.querySelectorAll('.like-button');

    function toggleReplyForms(commentId) {
        replyForms.forEach(form => {
            form.style.display = form.getAttribute('data-comment-id') === commentId ? 'block' : 'none';
        });
    }

    function handleFetch(url, options) {
        return fetch(url, options)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .catch(error => {
                console.error('Fetch error:', error);
                if (error.response) {
                    console.error('Response body:', error.response);
                }
                alert('An error occurred while processing your request. Please try again.');
                throw error; // Rethrow the error for further handling if needed
            });
    }

    replyLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const commentId = this.getAttribute('data-comment-id');
            toggleReplyForms(commentId);
        });
    });

    likeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.getAttribute('data-comment-id');
            const replyId = this.getAttribute('data-reply-id');
            const likeCountSpan = document.getElementById(`like-count-${replyId || commentId}`);

            const apiUrl = replyId ? `/api/like/reply/${replyId}` : `/api/like/comment/${commentId}`;

            handleFetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken,
                },
                body: JSON.stringify({
                    _token: csrfToken,
                }),
            })
            .then(data => {
                console.log(data);

                // Check if the server response indicates success
                if (data.success) {
                    // Update UI or perform additional actions

                    // Example: Display a success message
                    alert('Action successful!');

                    // Example: Update other elements in the UI
                    if (likeCountSpan) {
                        likeCountSpan.innerText = data.likesCount;
                    }

                    // ...
                    // Reload the page after a successful action with a slight delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 500); // You can adjust the delay as needed

                } else {
                    // Handle cases where the server response indicates an error
                    console.error('Server error:', data.error);
                    alert(`Error: ${data.error}`);
                }
            })
            .catch(error => {
                console.error('Error handling like/unlike:', error);

                // Display a generic error message to the user
                alert('An error occurred. Please try again.');
            });
        });
    });

    replyForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const commentId = this.getAttribute('data-comment-id');
            const replyText = this.querySelector('textarea[name="reply_text"]').value;

            handleFetch(`/comments/${commentId}/replies`, {
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
            .then(data => {
                console.log('JSON Response:', data);

                // Check if the server response indicates success
                if (data.success) {
                    // Handle JSON response here

                    // Reload the page after the reply submission is completed with a slight delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 500); // You can adjust the delay as needed

                } else {
                    // Handle cases where the server response indicates an error
                    console.error('Server error:', data.error);
                    alert(`Error: ${data.error}`);
                }
            })
            .catch(error => {
                console.error('Error handling reply submission:', error);

                // Display a generic error message to the user
                alert('An error occurred. Please try again.');
            });

            // Reset the form
            this.querySelector('textarea[name="reply_text"]').value = '';
            this.style.display = 'none';
        });
    });
});



