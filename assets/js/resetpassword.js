jQuery(document).ready(function($) {
    $('#resetpasswordForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var password = $('#password').val();
        var resetKey = $('#resetKey').val();
        var login = $('#login').val();
        var button = $('#passwordBtn');
        var spinner = button.find('.spinner');
        var resultDiv = $('#passwordResult');        

        // Show loading spinner
        button.prop('disabled', true);
        spinner.show();

        $.ajax({
            type: 'POST',
            url: resetpasswordAjax.ajaxurl, // Use the localized AJAX URL
            data: {
                action: 'reset_user_password',
                password: password,
                reset_key: resetKey,
                login:login,
                nonce: resetpasswordAjax.nonce // Pass nonce for security
            },
            success: function(response) {
                if (response.success) {
                    resultDiv.html('<p class="success">' + response.data + '</p>');

                } else {
                    resultDiv.html('<p class="error">' + response.data + '</p>');
                }
            },
            error: function() {
                resultDiv.html('<p class="error">An error occurred. Please try again.</p>');
            },
            complete: function() {
                // Hide loading spinner
                button.prop('disabled', false);
                spinner.hide();
            }
        });
    });
});
