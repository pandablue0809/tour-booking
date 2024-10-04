jQuery(document).ready(function($) {
    $('#changepasswordform').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get the input values
        var password = $('#password').val();
        var conf_password = $('#conf_password').val();
        var button = $('#change-password-btn');
        var spinner = button.find('.spinner');
        var nonce = changepasswordAjax.nonce; // Use the localized nonce
        console.log(spinner)
        button.prop('disabled', true);
        spinner.show();

        // Validate password fields
        if (password !== conf_password) {
            button.prop('disabled', false);
            spinner.hide();
            $('#message').html('<div class="error-message">Passwords do not match!</div>');
            return;
        }

        // AJAX request
        $.ajax({
            type: 'POST',
            url: changepasswordAjax.ajax_url, // Use the localized ajax_url
            data: {
                action: 'change_password', // Custom action
                password: password,
                change_password_nonce: nonce
            },
            success: function() {
                $('#message').html('<div class="success-message">Password changed successfully!</div>'); // Display response message
            },
            error: function() {
                $('#message').html('<div class="error-message">An error occurred. Please try again.</div>');
            },
            complete: function() {
                button.prop('disabled', false);
                spinner.hide();
            }
        });
    });
});
