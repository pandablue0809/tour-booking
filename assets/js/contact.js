jQuery(document).ready(function($) {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();

        $('#contactBtn').prop('disabled', true);
        $('#contactBtn .spinner').show(); 

        var formData = {
            action: 'contact',
            nonce: contactAjax.nonce,
            category: $('#category').val(),
            message: $('#message').val(),
            email: $('#email').val(),
            name: $('#name').val(),
            phone: $('#phone').val(),
        };
        // Send the AJAX request
        $.ajax({
            url: contactAjax.ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#formResponse').html('<p class="success">' + response.data + '</p>');
                    $('#contactForm')[0].reset();                   
                } else {
                    $('#formResponse').html('<p class="error">' + response.data + '</p>');
                }
            },
            error: function() {
                $('#formResponse').html('<p class="error">An unexpected error occurred.</p>');
            },
            complete: function() {
                // Re-enable the button and hide the spinner after the request completes
                $('#contactBtn').prop('disabled', false);
                $('#contactBtn .spinner').hide();    // Hide the spinner
            }
        });
    });

});
