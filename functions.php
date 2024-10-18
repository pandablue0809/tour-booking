<?php 

// Enqueue theme styles and scripts
function tour_booking_enqueue_scripts() {
    wp_enqueue_style('tour-booking-style', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_script('tour-booking-script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'tour_booking_enqueue_scripts');

function disable_admin_bar_for_non_admins() {
    // Check if the user is logged in and not an administrator
    if (is_user_logged_in() && !current_user_can('administrator')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'disable_admin_bar_for_non_admins');

function cptui_register_my_taxes_destinations() {

	/**
	 * Taxonomy: destinations.
	 */

	$labels = [
		"name" => esc_html__( "destinations", "tour-booking" ),
		"singular_name" => esc_html__( "destinations", "tour-booking" ),
	];

	
	$args = [
		"label" => esc_html__( "destinations", "tour-booking" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'destinations', 'with_front' => true, 'hierarchical' => true,],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "destinations",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "destinations", [ "tours" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_destinations' );

function enqueue_signup_ajax_script() {
    // Enqueue the script
    wp_enqueue_script('signup-ajax', get_template_directory_uri() . '/assets/js/signup.js', array('jquery'), null, true);

    // Pass the AJAX URL and nonce to the script
    wp_localize_script('signup-ajax', 'signupAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-register-nonce'),
        'login_url' => home_url('/log-in') 
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_signup_ajax_script');

function ajax_register_user() {
    // Check nonce for security
    check_ajax_referer('ajax-register-nonce', 'nonce');

    // Fetch form data
    $username = sanitize_text_field($_POST['userName']);
    $birthday = sanitize_text_field($_POST['birthday']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];

    // Validate the inputs
    if (username_exists($username)) {
        wp_send_json_error('Username already exists.');
    } elseif (email_exists($email)) {
        wp_send_json_error('Email already in use.');
    } elseif ($password !== $conf_password) {
        wp_send_json_error('Passwords do not match.');
    } else {
        // Register the user
        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            // Update user metadata (e.g., birthday)
            update_user_meta($user_id, 'birthday', $birthday);
            // Generate a random verification code
            $verification_code = wp_rand(100000, 999999);

            // Store the verification code and the current timestamp (for 15-minute expiration)
            update_user_meta($user_id, 'email_verification_code', $verification_code);
            update_user_meta($user_id, 'email_verification_code_timestamp', time());

            // Send verification email
            $subject = 'Email Verification';
            $message = 'Your verification code is: ' . $verification_code . '. This code is valid for 15 minutes.';
            $headers = array('Content-Type: text/html; charset=UTF-8');

            // Attempt to send the email
            if (wp_mail($email, $subject, $message, $headers)) {
                wp_send_json_success('Account created. A verification email has been sent. Please check your inbox.');
            } else {
                wp_send_json_error('User created, but failed to send verification email.');
            }

        } else {
            wp_send_json_error('An error occurred during registration.');
        }
    }

    wp_die();
}

// Hook into AJAX
add_action('wp_ajax_nopriv_register_user', 'ajax_register_user');
add_action('wp_ajax_register_user', 'ajax_register_user');

function ajax_verify_email_code() {
    // Check nonce for security
    check_ajax_referer('ajax-register-nonce', 'nonce');

    // Fetch form data
    $email = sanitize_email($_POST['email']);
    $verification_code = sanitize_text_field($_POST['verification_code']);

    // Get the user by email
    $user = get_user_by('email', $email);
    if (!$user) {
        wp_send_json_error('No user found with that email address.');
    }

    // Retrieve the stored verification code and timestamp
    $stored_code = get_user_meta($user->ID, 'email_verification_code', true);
    $stored_timestamp = get_user_meta($user->ID, 'email_verification_code_timestamp', true);

    // Check if the code matches
    if ($verification_code === $stored_code) {
        // Check if the code is within the 15-minute expiration period
        if ((time() - $stored_timestamp) <= 15 * 60) {
            // Mark the email as verified
            update_user_meta($user->ID, 'email_verified', true);
            delete_user_meta($user->ID, 'email_verification_code');
            delete_user_meta($user->ID, 'email_verification_code_timestamp');
            
            wp_send_json_success('Email verified successfully. You can now log in.');
        } else {
            wp_send_json_error('Verification code has expired. Please request a new code.');
        }
    } else {
        wp_send_json_error('Invalid verification code.');
    }

    wp_die();
}
add_action('wp_ajax_nopriv_verify_email_code', 'ajax_verify_email_code');
add_action('wp_ajax_verify_email_code', 'ajax_verify_email_code');

function ajax_resend_verification_code() {
    // Check nonce for security
    check_ajax_referer('ajax-register-nonce', 'nonce');

    // Fetch form data
    $email = sanitize_email($_POST['email']);

    // Get the user by email
    $user = get_user_by('email', $email);
    if (!$user) {
        wp_send_json_error('No user found with that email address.');
    }

    // Generate a new verification code
    $verification_code = wp_rand(100000, 999999);

    // Update the user meta with the new code and timestamp
    update_user_meta($user->ID, 'email_verification_code', $verification_code);
    update_user_meta($user->ID, 'email_verification_code_timestamp', time());

    // Send the new verification email
    $subject = 'Resend: Email Verification';
    $message = 'Your new verification code is: ' . $verification_code . '. This code is valid for 15 minutes.';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    if (wp_mail($email, $subject, $message, $headers)) {
        wp_send_json_success('A new verification code has been sent to your email.');
    } else {
        wp_send_json_error('Failed to send verification email.');
    }

    wp_die();
}
add_action('wp_ajax_nopriv_resend_verification_code', 'ajax_resend_verification_code');
add_action('wp_ajax_resend_verification_code', 'ajax_resend_verification_code');


function enqueue_login_ajax_script() {
    wp_enqueue_script('login-ajax', get_template_directory_uri() . '/assets/js/login.js', array('jquery'), null, true);

    // Localize the script with AJAX URL and nonce
    wp_localize_script('login-ajax', 'loginAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-login-nonce'),
        'redirect_url' => home_url() // Redirect to the dashboard or another page
    ));
}

add_action('wp_enqueue_scripts', 'enqueue_login_ajax_script');
function ajax_login_user() {
    check_ajax_referer('ajax-login-nonce', 'nonce');

    // Get the posted data
    $email = sanitize_email($_POST['userEmail']);
    $password = $_POST['password'];
    if (!is_email($email)) {
        wp_send_json_error('Invalid email format.');
    }

    $user = get_user_by('email', $email);
    if (!$user) {
        wp_send_json_error('No user found with this email.');
    }

    // Verify the password
    $creds = array(
        'user_login'    => $user->user_login,
        'user_password' => $password,
        'remember'      => true
    );
    $user = wp_signon($creds, false);

    // Handle login result
    if (is_wp_error($user)) {
        wp_send_json_error('Login failed. Incorrect credentials.');
    } else {
        wp_send_json_success();
    }

    wp_die();
}

// Hook the login action to AJAX
add_action('wp_ajax_nopriv_login_user', 'ajax_login_user');
add_action('wp_ajax_login_user', 'ajax_login_user');

function handle_google_login() {
    if (isset($_POST['id_token'])) {
        $id_token = $_POST['id_token'];

        // Validate the ID token with Google
        $client = new Google_Client(['client_id' => 'YOUR_CLIENT_ID']); // Specify the CLIENT_ID of your app
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            $email = $payload['email'];

            // Check if user exists, if not create a new one
            $user = get_user_by('email', $email);
            if (!$user) {
                $user_id = wp_create_user($email, wp_generate_password(), $email);
                $user = get_user_by('id', $user_id);
            }

            // Log the user in
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);

            // Return success response
            wp_send_json_success(['redirect_url' => home_url()]);
        } else {
            // Invalid ID token
            wp_send_json_error('Invalid ID token.');
        }
    }

    wp_send_json_error('No ID token received.');
}
add_action('wp_ajax_google_login', 'handle_google_login');
add_action('wp_ajax_nopriv_google_login', 'handle_google_login');

function enqueue_forgotpassword_ajax_script() {
    wp_enqueue_script('forgotpassword-ajax', get_template_directory_uri() . '/assets/js/forgotpassword.js', array('jquery'), null, true);

    // Localize the script with AJAX URL and nonce
    wp_localize_script('forgotpassword-ajax', 'forgotpasswordAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-forgotpassword-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_forgotpassword_ajax_script');

function send_password_reset_email() {
    // Check nonce for security
    check_ajax_referer('ajax-forgotpassword-nonce', 'nonce');

    if (!isset($_POST['email'])) {
        wp_send_json_error('Email is required.');
    }

    $email = sanitize_email($_POST['email']);

    // Check if the email exists in the database
    if (email_exists($email)) {
        // Get the user by email
        $user = get_user_by('email', $email);
        // Send password reset email
        $reset_key = get_password_reset_key($user);

        if (is_wp_error($reset_key)) {
            wp_send_json_error('Error generating reset key.');
        }

        // Store the reset key in user meta (to be validated later)
        update_user_meta($user->ID, 'password_reset_key', $reset_key);
        
        // Replace with your actual email sending logic
        $reset_link = site_url("reset-password?key=$reset_key&login=" . rawurlencode($user->user_login));
        $subject = 'Reset your password';
        $message = "Click this link to reset your password: $reset_link";

        if (wp_mail($email, $subject, $message)) {
            wp_send_json_success('Password reset email sent.');
        } else {
            wp_send_json_error('Failed to send email.');
        }
    } else {
        wp_send_json_error('Email not found.');
    }

    wp_die();
}

add_action('wp_ajax_nopriv_send_password_reset_email', 'send_password_reset_email');
add_action('wp_ajax_send_password_reset_email', 'send_password_reset_email');

function enqueue_resetpassword_ajax_script() {
    wp_enqueue_script('resetpassword-ajax', get_template_directory_uri() . '/assets/js/resetpassword.js', array('jquery'), null, true);

    // Localize the script with AJAX URL and nonce
    wp_localize_script('resetpassword-ajax', 'resetpasswordAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-resetpassword-nonce'),
        'login_url' => home_url('/log-in') 
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_resetpassword_ajax_script');

function reset_user_password() {
    // Check nonce for security
    check_ajax_referer('ajax-resetpassword-nonce', 'nonce');

    if (!isset($_POST['password']) || !isset($_POST['reset_key']) || !isset($_POST['login'])) {
        wp_send_json_error('Password, reset key, and login are required.');
    }

    $new_password = sanitize_text_field($_POST['password']);
    $reset_key = sanitize_text_field($_POST['reset_key']);
    $login = sanitize_text_field($_POST['login']);

    // Retrieve the user by login
    $user = get_user_by('login', $login);

    if (!$user) {
        wp_send_json_error('Invalid user login.');
    }

    // Retrieve the stored reset key from user meta
    $stored_reset_key = get_user_meta($user->ID, 'password_reset_key', true);

    // Validate the reset key
    if (empty($stored_reset_key) || $reset_key !== $stored_reset_key) {
        wp_send_json_error('Invalid reset key.');
    }

    // Update the user's password
    wp_set_password($new_password, $user->ID);

    // Remove the reset key after successful password reset
    delete_user_meta($user->ID, 'password_reset_key');

    wp_send_json_success('Your password has been reset successfully. You can now log in.');
}

add_action('wp_ajax_nopriv_reset_user_password', 'reset_user_password');
add_action('wp_ajax_reset_user_password', 'reset_user_password');

function enqueue_avatar_upload_script() {
    wp_enqueue_script('avatar-upload-ajax', get_template_directory_uri() . '/assets/js/avatar-upload.js', array('jquery'), null, true);
    wp_localize_script('avatar-upload-ajax', 'avatarUpload', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('avatar-upload-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_avatar_upload_script');

function handle_avatar_upload_ajax() {
    // Verify nonce for security
    check_ajax_referer('avatar-upload-nonce', 'nonce');

    // Check if the file is uploaded and valid
    if (!empty($_FILES['user_avatar']['name'])) {
        $uploaded_file = $_FILES['user_avatar'];
        $upload_dir = wp_upload_dir();

        // Handle the upload
        $uploaded = wp_handle_upload($uploaded_file, array('test_form' => false));

        if (isset($uploaded['url'])) {
            // Get the current user ID and save the avatar URL in user meta
            $current_user_id = get_current_user_id();
            update_user_meta($current_user_id, 'user_avatar', $uploaded['url']);

            // Return success with the avatar URL
            wp_send_json_success(array('avatar_url' => $uploaded['url']));
        } else {
            wp_send_json_error(array('message' => 'Failed to upload the avatar.'));
        }
    } else {
        wp_send_json_error(array('message' => 'No file uploaded.'));
    }

    wp_die();
}
add_action('wp_ajax_upload_avatar', 'handle_avatar_upload_ajax');

function enqueue_user_info_scripts() {
    wp_enqueue_script('jquery');
    
    // Enqueue your script that contains the jQuery code
    wp_enqueue_script('user-info-ajax', get_template_directory_uri() . '/assets/js/user-info.js', array('jquery'), null, true);
  
    // Pass AJAX URL and nonce to the script
    wp_localize_script('user-info-ajax', 'userinfoAjax', array(
      'ajax_url' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('user_info_nonce')
    ));
  }
  add_action('wp_enqueue_scripts', 'enqueue_user_info_scripts');

  function update_user_info() {
    // Verify the nonce for security
    check_ajax_referer('user_info_nonce', 'nonce');

    // Get the current user ID
    $user_id = get_current_user_id();

    // Check if the user is logged in
    if (!$user_id) {
        wp_send_json_error(array('message' => 'User not logged in.'));
        return;
    }

    $updated_value = ''; // This will store the new value to return
    $field_to_update = ''; // This will store the field being updated

    // Update based on which field was passed in the request
    if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        
        // Update first and last name as user meta fields
        update_user_meta($user_id, 'first_name', $first_name);
        update_user_meta($user_id, 'last_name', $last_name);

        $updated_value = $first_name . ' ' . $last_name;
        $field_to_update = 'Full Name';
        
    } elseif (isset($_POST['email'])) {
        $email = sanitize_email($_POST['email']);
        
        // Update email through wp_update_user since it's part of the main user table
        $user_data = array(
            'ID' => $user_id,
            'user_email' => $email,
        );
        $updated_value = $email;
        $field_to_update = 'Email';
        wp_update_user($user_data);

    } elseif (isset($_POST['phone_number'])) {
        $phone_number = sanitize_text_field($_POST['phone_number']);
        update_user_meta($user_id, 'phone_number', $phone_number);
        $updated_value = $phone_number;
        $field_to_update = 'Phone Number';
        
    } elseif (isset($_POST['birthday'])) {
        $birthday = sanitize_text_field($_POST['birthday']);
        update_user_meta($user_id, 'birthday', $birthday);
        $updated_value = $birthday;
        $field_to_update = 'Date of Birth';
        
    } elseif (isset($_POST['home_town'])) {
        $home_town = sanitize_text_field($_POST['home_town']);
        update_user_meta($user_id, 'home_town', $home_town);
        $updated_value = $home_town;
        $field_to_update = 'Home Town';
        
    } else {
        wp_send_json_error(array('message' => 'No valid field to update.'));
        return;
    }

    // Return the updated field value to the front-end
    wp_send_json_success(array('updated_value' => $updated_value, 'field' => $field_to_update));

    wp_die();
}
add_action('wp_ajax_update_user_info', 'update_user_info');

function enqueue_setting_scripts() {
    wp_enqueue_script('jquery');
    
    // Enqueue your script that contains the jQuery code
    wp_enqueue_script('change-password-ajax', get_template_directory_uri() . '/assets/js/setting.js', array('jquery'), null, true);
  
    // Pass AJAX URL and nonce to the script
    wp_localize_script('change-password-ajax', 'changepasswordAjax', array(
      'ajax_url' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('chang_password_nonce')
    ));
  }
  add_action('wp_enqueue_scripts', 'enqueue_setting_scripts');

  function handle_ajax_change_password() {
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        wp_send_json_error('You are not logged in.'); // Send error response
    }

    // Verify nonce for security
    if (!isset($_POST['change_password_nonce']) || !wp_verify_nonce($_POST['change_password_nonce'], 'chang_password_nonce')) {
        wp_send_json_error('Nonce verification failed.'); // Send error response
    }

    // Get current user ID
    $user_id = get_current_user_id();
    $new_password = sanitize_text_field($_POST['password']);

    // Update the user's password
    $result = wp_set_password($new_password, $user_id);

    if (is_wp_error($result)) {
        wp_send_json_error('Password could not be changed.'); // Send error response
    } else {
        wp_send_json_success('Password changed successfully!'); // Send success response
    }

    // Always terminate the script
    wp_die();
}

add_action('wp_ajax_change_password', 'handle_ajax_change_password');

function track_recently_viewed_tours() {
    // Check if it's a single tour page
    if (is_singular('tours')) {
        $current_tour_id = get_the_ID(); // Get the current tour ID

        // Get the existing recent tours from the cookie
        $recent_tours = isset($_COOKIE['recent_tours']) ? json_decode(stripslashes($_COOKIE['recent_tours']), true) : [];

        // If the current tour is not in the array, add it
        if (!in_array($current_tour_id, $recent_tours)) {
            // Limit to 8 recent tours
            if (count($recent_tours) >= 8) {
                array_shift($recent_tours); // Remove the oldest one
            }
            $recent_tours[] = $current_tour_id; // Add the current tour
        }

        // Save the updated array in a cookie (for 30 days)
        setcookie('recent_tours', json_encode($recent_tours), time() + (86400 * 30), COOKIEPATH, COOKIE_DOMAIN, false, true);
    }
}
add_action('wp', 'track_recently_viewed_tours');

function remove_add_new_booking_button() {
    global $submenu;

    // Check if the current post type is 'booking'
    if (isset($submenu['edit.php?post_type=booking'])) {
        unset($submenu['edit.php?post_type=booking'][10]); // Remove 'Add New' from submenu
    }
}
add_action('admin_menu', 'remove_add_new_booking_button');

function prevent_direct_access_to_add_new_booking() {
    global $pagenow;

    // Ensure we're trying to access the 'Add New' page for the 'booking' post type
    if ($pagenow == 'post-new.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'booking') {
        wp_redirect(admin_url('edit.php?post_type=booking')); // Redirect to Bookings list
        exit;
    }
}
add_action('admin_init', 'prevent_direct_access_to_add_new_booking');

function hide_add_new_booking_button_css() {
    $screen = get_current_screen();

    // Ensure we're on the correct post type screen
    if ($screen->post_type === 'booking' && $screen->base === 'edit') {
        echo '<style type="text/css">
            .page-title-action { display: none; }
        </style>';
    }
}
add_action('admin_head', 'hide_add_new_booking_button_css');

function disable_booking_editing($actions, $post) {
    // Check if the post type is 'booking'
    if ($post->post_type === 'booking') {
        // Remove the 'Edit' link from the actions
        unset($actions['edit']);
    }
    return $actions;
}
add_filter('post_row_actions', 'disable_booking_editing', 10, 2);

function prevent_booking_edit_page_access() {
    global $pagenow, $post_type;

    // If the user is trying to edit a booking post
    if ($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) == 'booking') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'prevent_booking_edit_page_access');

function make_booking_content_read_only($post) {
    if ($post->post_type === 'booking') {
        // Disable content editing in the editor
        remove_post_type_support('booking', 'editor');
    }
}
add_action('add_meta_boxes', 'make_booking_content_read_only');

function remove_quick_edit_booking($actions, $post) {
    if ($post->post_type === 'booking') {
        unset($actions['inline hide-if-no-js']); // Remove Quick Edit
    }
    return $actions;
}
add_filter('post_row_actions', 'remove_quick_edit_booking', 10, 2);

function enqueue_booking_script() {
    wp_enqueue_script('jquery'); 
    wp_enqueue_script('booking-script', get_template_directory_uri() . '/assets/js/booking.js', ['jquery'], null, true);

    wp_localize_script('booking-script', 'bookingAjax', [
        'ajaxurl'    => admin_url('admin-ajax.php'),  
        'nonce'      => wp_create_nonce('booking_nonce'),
        'tourID'     => isset($_GET['post_id']) ? intval($_GET['post_id']) : '', 
        'members'    => isset($_GET['members']) ? intval($_GET['members']) : 0, 
        'bookingDate' => isset($_GET['date']) ? sanitize_text_field($_GET['date']) : '', 
        'bookingTime' => isset($_GET['time']) ? sanitize_text_field($_GET['time']) : '',
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_booking_script');

function save_booking() {
    // Check the nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'booking_nonce')) {
        wp_send_json_error(['message' => 'Nonce verification failed']);
        return;
    }

    // Sanitize and validate the input data
    $firstName = isset($_POST['firstName']) ? sanitize_text_field($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? sanitize_text_field($_POST['lastName']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phoneNumber = isset($_POST['phoneNumber']) ? sanitize_text_field($_POST['phoneNumber']) : '';
    $pickupPoint = isset($_POST['pickupPoint']) ? sanitize_text_field($_POST['pickupPoint']) : '';
    $primaryTraveler = isset($_POST['primaryTraveler']) ? sanitize_text_field($_POST['primaryTraveler']) : '';
    $tourID = isset($_POST['tourID']) ? intval($_POST['tourID']) : 0;
    $members = isset($_POST['members']) ? intval($_POST['members']) : 1;
    $bookingDate = isset($_POST['bookingDate']) ? sanitize_text_field($_POST['bookingDate']) : '';
	$bookingTime = isset($_POST['bookingTime']) ? sanitize_text_field($_POST['bookingTime']) : '';

    // Check if all required fields are present
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber) || empty($tourID)) {
        wp_send_json_error(['message' => 'Required fields are missing']);
        return;
    }

    // Prepare the booking data
    $booking_data = [
        'post_title' => $firstName . ' ' . $lastName . ' - ' . current_time('Y-m-d H:i:s'),
        'post_type' => 'booking',
        'post_status' => 'publish', // You can set to 'draft' if you want to review before publishing
        'meta_input' => [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone_number' => $phoneNumber,
            'pickup_point' => $pickupPoint,
            'primary_traveler' => $primaryTraveler,
            'tour_id' => $tourID,
            'members' => $members,
            'booking_date' => $bookingDate,
			'booking_time' => $bookingTime,
        ],
    ];

    // Insert the booking as a custom post type
    $booking_id = wp_insert_post($booking_data);

    if ($booking_id) {
        wp_send_json_success(['message' => 'Booking saved successfully']);
    } else {
        wp_send_json_error(['message' => 'Failed to save the booking']);
    }
}

// Hook the function to handle AJAX request (both for logged-in and non-logged-in users)
add_action('wp_ajax_save_booking', 'save_booking');
add_action('wp_ajax_nopriv_save_booking', 'save_booking');

function add_booking_columns($columns) {
    $new_columns = [];
    
    // Default columns
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = __('Booking', 'textdomain');
    
    // Custom columns
    $new_columns['first_name'] = __('First Name', 'textdomain');
    $new_columns['last_name'] = __('Last Name', 'textdomain');
    $new_columns['email'] = __('Email', 'textdomain');
    $new_columns['phone_number'] = __('Phone Number', 'textdomain');
    $new_columns['pickup_point'] = __('Pickup Point', 'textdomain');
    $new_columns['primary_traveler'] = __('Primary Traveler', 'textdomain');
    $new_columns['tour_id'] = __('Tour ID', 'textdomain');
    $new_columns['members'] = __('Members', 'textdomain');
    $new_columns['booking_date'] = __('Booking Date', 'textdomain');
    $new_columns['booking_time'] = __('Booking Time', 'textdomain');
    
    return $new_columns;
}
add_filter('manage_booking_posts_columns', 'add_booking_columns');

function populate_booking_columns($column, $post_id) {
    switch ($column) {
        case 'first_name':
            echo get_post_meta($post_id, 'first_name', true);
            break;
        case 'last_name':
            echo get_post_meta($post_id, 'last_name', true);
            break;
        case 'email':
            echo get_post_meta($post_id, 'email', true);
            break;
        case 'phone_number':
            echo get_post_meta($post_id, 'phone_number', true);
            break;
        case 'pickup_point':
            echo get_post_meta($post_id, 'pickup_point', true);
            break;
        case 'primary_traveler':
            echo get_post_meta($post_id, 'primary_traveler', true);
            break;
        case 'tour_id':
            echo get_post_meta($post_id, 'tour_id', true);
            break;
        case 'members':
            echo get_post_meta($post_id, 'members', true);
            break;
        case 'booking_date':
            echo get_post_meta($post_id, 'booking_date', true);
            break;
        case 'booking_time':
            echo get_post_meta($post_id, 'booking_time', true);
            break;
    }
}
add_action('manage_booking_posts_custom_column', 'populate_booking_columns', 10, 2);
?>