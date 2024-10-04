<?php 
function tour_booking_setup() {
    // Enable post thumbnails
    add_theme_support('post-thumbnails');
    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tour-booking-theme'),
    ));
}
add_action('after_setup_theme', 'tour_booking_setup');

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


?>




