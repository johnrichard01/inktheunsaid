document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open(form.method, form.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = JSON.parse(xhr.responseText);

                    // Display flash message
                    var flashMessage = document.createElement('p');
                    flashMessage.textContent = response.message;

                    // Replace the modal body content with the flash message
                    var successModalBody = document.getElementById('successModalBody');
                    successModalBody.innerHTML = ''; // Clear existing content
                    successModalBody.appendChild(flashMessage);

                    // Show the modal
                    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();

                    // Close the modal after a delay (e.g., 3 seconds)
                    setTimeout(function () {
                        successModal.hide();
                    }, 3000); // Adjust the delay as needed
                } else {
                    // Handle error if needed
                }
            };

            xhr.onerror = function () {
                // Handle error if needed
            };

            xhr.send(formData);
        });
    });
});
