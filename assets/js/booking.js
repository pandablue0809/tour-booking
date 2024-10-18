function booking() {
    var formData = {
        action: 'save_booking',
        nonce: bookingAjax.nonce,
        firstName : $('#first_name').val(),
        lastName : $('#last_name').val(),// jQuery to get the value of the input field
        email: $('#email').val(), // jQuery to get the value of the input field
        phoneNumber: $('#phone_number').val(), // jQuery to get the value of the input field
        pickupPoint: $('#pickup-point').text(),
        primaryTraveler: $('#primary-traveler').text(),
        tourID: bookingAjax.tourID, // Use tour ID from localized script
        members: bookingAjax.members, // Use members from localized script
        dateTime: bookingAjax.dateTime // Use date and time from localized scrip
    };

    console.log(formData,"_______________________________________________")

    // Send the AJAX request using jQuery
    $.ajax({
        url: bookingAjax.ajaxurl,
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                $('#booking-response').html('<p>' + response.data.message + '</p>'); // jQuery to update the response
            } else {
                $('#booking-response').html('<p>Error: ' + response.data.message + '</p>'); // jQuery to update the response
            }
        },
        error: function(xhr, status, error) {
            $('#booking-response').html('<p>An error occurred: ' + xhr.responseText + '</p>'); // jQuery to update the response
        }
    });
}
