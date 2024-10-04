$(document).ready(function() {
    // Handle Edit Button Click
    $('.edit-btn').on('click', function() {
      const field = $(this).closest('.personal-info-field');
      $(this).hide();
      field.find('.personal-info-field-value').hide();
      field.find('.personal-info-field-value-edit').show();
    });

    // Handle Save Button Click
    $('.personal-info-field-value-edit-save-btn').on('click', function(e) {
      e.preventDefault(); 
      const field = $(this).closest('.personal-info-field');
      const fieldType = field.find('label').attr('data-translate-key');
      let formData = {
        'action': 'update_user_info',
        'nonce': userinfoAjax.nonce // nonce for security
      };
      switch (fieldType) {
        case 'Full Name':
            formData['first_name'] = field.find('#first-name').val();
            formData['last_name'] = field.find('#last-name').val();
            break;
        case 'Email':
            formData['email'] = field.find('#email').val();
            break;
        case 'Phone Number':
            formData['phone_number'] = field.find('#phoneNumber').val();
            break;
        case 'Date of Birth':
            formData['birthday'] = field.find('#birthday').val();
            break;
        case 'Home Town':
            formData['home_town'] = field.find('#home').val();
            break;
      }
      $.ajax({
        url: userinfoAjax.ajax_url,
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                // Update the UI with the new value
                field.find('.personal-info-field-value').text(response.data.updated_value);
                
                // Hide edit fields and show updated info
                field.find('.personal-info-field-value-edit').hide();
                field.find('.personal-info-field-value').show();
                field.find('.edit-btn').show();
                
                alert('Information updated successfully!');
            } else {
                alert('Failed to update. ' + response.data.message);
            }
        },
        error: function(error) {
            alert('An error occurred.');
        }
      });      
    });

    // Handle Cancel Button Click
    $('.personal-info-field-value-edit-cancel-btn').on('click', function() {
      const field = $(this).closest('.personal-info-field');
      field.find('.edit-btn').show();
      field.find('.personal-info-field-value').show();
      field.find('.personal-info-field-value-edit').hide();
    });
  });