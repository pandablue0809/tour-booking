jQuery(document).ready(function($) {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        $('#loginBtn').prop('disabled', true);
        $('#loginBtn .spinner').show();

        var formData = {
            action: 'login_user',
            nonce: loginAjax.nonce,
            userEmail: $('#email').val(),
            password: $('#password').val(),
        };

        $.ajax({
            url: loginAjax.ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#loginResult').html('<p class="success">Login successful. Redirecting...</p>');
                    window.location.href = loginAjax.redirect_url; // Redirect user after successful login
                } else {
                    $('#loginResult').html('<p class="error">' + response.data + '</p>');
                }
            },
            error: function() {
                $('#loginResult').html('<p class="error">An unexpected error occurred.</p>');
            },
            complete: function() {
                $('#loginBtn').prop('disabled', false);
                $('#loginBtn .spinner').hide();
            }
        });
    });
});

function googleLogin() {
    const auth2 = gapi.auth2.getAuthInstance();

    auth2.signIn().then(function (googleUser) {
        const id_token = googleUser.getAuthResponse().id_token;

        $.ajax({
            url: ajaxurl, // Make sure to set this URL correctly
            type: 'POST',
            data: {
                action: 'google_login',
                id_token: id_token
            },
            success: function (response) {
                if (response.success) {
                    // Login successful, redirect or perform actions
                    window.location.href = response.redirect_url;
                } else {
                    $('#loginResult').html('<p class="error">' + response.data + '</p>');
                }
            },
            error: function () {
                $('#loginResult').html('<p class="error">An unexpected error occurred.</p>');
            }
        });
    });
}
