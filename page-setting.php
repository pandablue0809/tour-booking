<?php
// Check if the user is logged in
if (!is_user_logged_in()) {
    // Redirect to the login page
    wp_redirect(home_url('/log-in'));
    exit; // Always call exit after wp_redirect
}

?>

<?php get_header()?>

<main>
  <div class="sub-header container">
    <li class="sub-header-item">
      <a href="" class="sub-header-item-map">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/map.svg" alt="">
        <span data-translate-key="Explore destinations">Explore destinations</span>
      </a>
    </li>
    <li class="sub-header-item">
      <a href="" class="sub-header-item-category">
        <span data-translate-key="All categories">All categories</span>
      </a>
    </li>
    <li class="sub-header-item">
      <a href="" class="sub-header-item-tuor">
        <span data-translate-key="Tours & experience">Tours & experience</span>
      </a>
    </li>
  </div>
  <div class="account-layout container">
    <div class="account-left-sidebar">
      <div class="border">
        <div class="account-left-sidebar-userinfo">
          <div class="account-left-sidebar-avatar">
            <form id="avatar-form" enctype="multipart/form-data">
              <label for="user-avatar">
                <input type="file" name="user-avatar" id="user-avatar" hidden>
                <?php
                  $current_user_id = get_current_user_id();
                  $avatar_url = get_user_meta($current_user_id, 'user_avatar', true);
                  if ($avatar_url) {
                    echo '<img id="user-avatar-img" src="' . esc_url($avatar_url) . '" alt="User Avatar">';
                  } else {
                    echo '<img id="user-avatar-img" src="' . get_template_directory_uri() . '/assets/img/avatar.png" alt="Default Avatar">';
                  }
                ?>
              </label>
            </form>
            <button id="upload-avatar-btn" class="avatar-upload-btn" data-translate-key="Upload Avatar" >Upload Avatar</button>
          </div>
          <div class="account-left-sidebar-username">
            <?php echo wp_get_current_user()->display_name; ?>
          </div>
          <!-- <p class="" data-translate-key="update personal info">update personal info</p> -->
          <div class="account-left-sidebar-logo">
            <a href="">
              <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="">
            </a>
          </div>
        </div>
        <div class="account-left-sidebar-nav">
          <li>
            <a href="<?php echo home_url(); ?>/my-account/my-info">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/13924070.png" alt="">
              </span>
              <span data-translate-key="Personal Information">Personal Information</span>
            </a>
          </li>
          <li>
            <a href="<?php echo home_url(); ?>/my-account/booking-list">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/svgviewer-png-output.png" alt="">
              </span>
              <span data-translate-key="Booking">Booking</span>
            </a>
          </li>
          <li>
            <a href="<?php echo home_url(); ?>/my-account/reviews">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/download (2).png" alt="">
              </span>
              <span data-translate-key="Reviews">Reviews</span>
            </a>
          </li>
          <li>
            <a href="<?php echo home_url(); ?>/my-account/favourite-list">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/svgviewer-png-output (1).png" alt="">
              </span>
              <span data-translate-key="Favourite list">Favourite list</span>
            </a>
          </li>
          <li>
            <a href="<?php echo home_url(); ?>/my-account/setting" class="active">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/download (3).png" alt="">
              </span>
              <span data-translate-key="Setting">Setting</span>
            </a>
          </li>
        </div>
        <div class="account-left-sidebar-item">
          <li>
            <a href="<?php echo home_url(); ?>/help">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/10275409-removebg-preview.png" alt="">
              </span>
              <span data-translate-key="Help">Help</span>
            </a>
          </li>
        </div>
        <div class="account-left-sidebar-item">
          <li>
            <a href="<?php echo wp_logout_url( home_url() ); ?>">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/logout-8.png" alt="">
              </span>
              <span data-translate-key="Log out">Log out</span>
            </a>
          </li>
        </div>
      </div>
    </div>
    <div class="account-main-content">
      <div class="border">
        <h2 data-translate-key="Change password" class="account-main-content-title">Change password</h2>       
        <form id="changepasswordform" action="" method="post">
          <div class="modal-form-field">
              <span class="modal-form-field-icon">
                  <img src="<?php echo get_template_directory_uri() ?>/assets/img/14562503.png" alt="">
              </span>
              <input type="password" id="password" name="password" data-translate-key="PassWord" placeholder="PassWord" required>
              <span class="modal-form-field-icon toggle-password" data-target="#password">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/8173177.png" alt="" class="hide-eye">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons8-eye-24.png" alt="" class="show-eye">
              </span>
          </div>
          <div class="modal-form-field">
              <span class="modal-form-field-icon">
                  <img src="<?php echo get_template_directory_uri() ?>/assets/img/6115959.png" alt="">
              </span>
              <input type="password" id="conf_password" name="conf_password" data-translate-key="Confirm password" placeholder="Confirm password" required>
              <span class="modal-form-field-icon toggle-password" data-target="#conf_password">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/8173177.png" alt="" class="hide-eye">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons8-eye-24.png" alt="" class="show-eye">
              </span>
          </div> 
          <button type="submit"  id="change-password-btn" class="change-password-save-btn">
            <span class="btn-text" data-translate-key="Save">Save</span>
            <div class="spinner" style="display:none;"></div>
          </button>
          <div id="message"></div> <!-- Message container -->
        </form>
      </div>
    </div>
  </div>
</main>

<?php get_footer() ?>