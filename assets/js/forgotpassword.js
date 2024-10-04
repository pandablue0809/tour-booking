jQuery(document).ready(function($) {
    $('#passwordForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var email = $('#email').val();
        var button = $('#passwordBtn');
        var spinner = button.find('.spinner');
        var resultDiv = $('#passwordResult');
        var modalTitle = $('#modalTitle');
        var passwordForm = $('#passwordForm')
        var sendemialmessage = $('#send-emial-message')
        var sendemail = $('#send-email')

        // Show loading spinner
        button.prop('disabled', true);
        spinner.show();

        $.ajax({
            type: 'POST',
            url: forgotpasswordAjax.ajaxurl, // Use localized AJAX URL
            data: {
                action: 'send_password_reset_email',
                email: email,
                nonce: forgotpasswordAjax.nonce // Pass nonce for security
            },
            success: function(response) {
                if (response.success) {
                    modalTitle.hide();
                    passwordForm.hide();
                    resultDiv.html('<p class="success">' + response.data + '</p>');
                    sendemialmessage.show();
                    sendemail.html(email)
                } else {
                    resultDiv.html('<p class="error">' + response.data + '</p>');
                }
            },
            error: function() {
                resultDiv.html('<p class="error">An error occurred.</p>');
            },
            complete: function() {
                // Hide loading spinner
                button.prop('disabled', false);
                spinner.hide();
            }
        });
    });
});
