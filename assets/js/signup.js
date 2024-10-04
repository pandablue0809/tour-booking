jQuery(document).ready(function($) {
    $('#signUpForm').on('submit', function(e) {
        e.preventDefault();

        $('#signUpBtn').prop('disabled', true);
        $('#signUpBtn .spinner').show(); 

        var formData = {
            action: 'register_user',
            nonce: signupAjax.nonce,
            userName: $('#userName').val(),
            birthday: $('#birthday').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            conf_password: $('#conf_password').val(),
        };
        // Send the AJAX request
        $.ajax({
            url: signupAjax.ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#signupResult').html('<p class="success">' + response.data + '</p>');                    
                    $('#signup-content').hide();
                    $('#verificationModal').show();
                } else {
                    $('#signupResult').html('<p class="error">' + response.data + '</p>');
                }
            },
            error: function() {
                $('#signupResult').html('<p class="error">An unexpected error occurred.</p>');
            },
            complete: function() {
                // Re-enable the button and hide the spinner after the request completes
                $('#signUpBtn').prop('disabled', false);
                $('#signUpBtn .spinner').hide();    // Hide the spinner
            }
        });
    });

    // Verification code form submission
    $('#verifyCodeForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: signupAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'verify_email_code',
                nonce: signupAjax.nonce,
                email: $('#email').val(),
                verification_code: $('#verification_code').val()
            },
            success: function(response) {
                $('#verificationResult').html(response.data);
                if (response.success) {
                    window.location.href = signupAjax.login_url;
                }
            },
            error: function(xhr, status, error) {
                $('#verificationResult').html('An error occurred.');
            }
        });
    });

    // Resend verification code
    $('#resendCodeBtn').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: signupAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'resend_verification_code',
                nonce: signupAjax.nonce,
                email: $('#email').val()
            },
            success: function(response) {
                $('#verificationResult').html(response.data);
            },
            error: function(xhr, status, error) {
                $('#verificationResult').html('An error occurred.');
            }
        });
    });
});
