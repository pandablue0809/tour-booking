jQuery(document).ready(function ($) {
    // Handle file input change event to show image preview
    $('#user-avatar').on('change', function (e) {
        let file = this.files[0];

        if (file) {
            let reader = new FileReader();

            // When file is loaded, display it in the image element
            reader.onload = function (e) {
                $('#user-avatar-img').attr('src', e.target.result);
            };

            reader.readAsDataURL(file);
        }
    });

    // Handle AJAX avatar upload on button click
    $('#upload-avatar-btn').on('click', function (e) {
        e.preventDefault();

        let fileInput = $('#user-avatar')[0].files[0];

        if (!fileInput) {
            alert('Please select an image to upload.');
            return;
        }

        let formData = new FormData();
        formData.append('action', 'upload_avatar');
        formData.append('user_avatar', fileInput);
        formData.append('nonce', avatarUpload.nonce);

        $.ajax({
            url: avatarUpload.ajaxurl,
            type: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                if (response.success) {
                    alert('Avatar uploaded successfully!');
                } else {
                    alert(response.data.message);
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
                alert('An error occurred while uploading the avatar.');
            }
        });
    });
});
