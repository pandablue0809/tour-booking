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
            <a href="" class="active">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/13924070.png" alt="">
              </span>
              <span data-translate-key="Personal Information">Personal Information</span>
            </a>
          </li>
          <li>
            <a href="">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/svgviewer-png-output.png" alt="">
              </span>
              <span data-translate-key="Booking">Booking</span>
            </a>
          </li>
          <li>
            <a href="">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/download (2).png" alt="">
              </span>
              <span data-translate-key="Reviews">Reviews</span>
            </a>
          </li>
          <li>
            <a href="">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/svgviewer-png-output (1).png" alt="">
              </span>
              <span data-translate-key="Favourite list">Favourite list</span>
            </a>
          </li>
          <li>
            <a href="">
              <span>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/download (3).png" alt="">
              </span>
              <span data-translate-key="Setting">Setting</span>
            </a>
          </li>
        </div>
        <div class="account-left-sidebar-item">
          <li>
            <a href="">
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
        <h2 data-translate-key="Personal Information" class="account-main-content-title">Personal Information</h2>
        <div class="personal-info-field">
          <div class="personal-info-field-label">
            <label for="" data-translate-key="Full Name">Full Name</label>
            <button  data-translate-key="Edit">Edit</button>
          </div>
          <div class="personal-info-field-value">
            First name Last name
          </div>
          <div class="personal-info-field-value-edit">
            <form action="">
              <input type="text" id="first-name" name="first-name">
              <input type="text" id="last-name" name="last-name">
            </form>
            <div class="personal-info-field-value-edit-btn">
              <button class="personal-info-field-value-edit-save-btn">Save</button>
              <button class="personal-info-field-value-edit-cancel-btn">Cancel</button>
            </div>
          </div>
        </div>        
        <div class="personal-info-field">
          <div class="personal-info-field-label">
            <label for="" data-translate-key="Email">Email</label>
            <button  data-translate-key="Edit">Edit</button>
          </div>
          <div class="personal-info-field-value">
            example@example.com
          </div>
          <div class="personal-info-field-value-edit">
            <form action="">
              <input type="email" id="email" name="email">
            </form>
            <div class="personal-info-field-value-edit-btn">
              <button class="personal-info-field-value-edit-save-btn">Save</button>
              <button class="personal-info-field-value-edit-cancel-btn">Cancel</button>
            </div>
          </div>
        </div>
        <div class="personal-info-field">
          <div class="personal-info-field-label">
            <label for="" data-translate-key="Phone Number">Phone Number</label>
            <button  data-translate-key="Edit">Edit</button>
          </div>
          <div class="personal-info-field-value">
            Not provided
          </div>
          <div class="personal-info-field-value-edit">
            <form action="">
              <input type="phone" id="phoneNumber" name="phoneNumber">
            </form>
            <div class="personal-info-field-value-edit-btn">
              <button class="personal-info-field-value-edit-save-btn">Save</button>
              <button class="personal-info-field-value-edit-cancel-btn">Cancel</button>
            </div>
          </div>
        </div>
        <div class="personal-info-field">
          <div class="personal-info-field-label">
            <label for="" data-translate-key="Date of Birth">Date of Birth</label>
            <button  data-translate-key="Edit">Edit</button>
          </div>
          <div class="personal-info-field-value">
            Not provided
          </div>
          <div class="personal-info-field-value-edit">
            <form action="">
              <input type="text" id="birthday" name="birthday">
            </form>
            <div class="personal-info-field-value-edit-btn">
              <button class="personal-info-field-value-edit-save-btn">Save</button>
              <button class="personal-info-field-value-edit-cancel-btn">Cancel</button>
            </div>
          </div>
        </div>
        <div class="personal-info-field">
          <div class="personal-info-field-label">
            <label for="" data-translate-key="Home Town">Home Town</label>
            <button  data-translate-key="Edit">Edit</button>
          </div>
          <div class="personal-info-field-value">
          Shinjuku, Tokyo Prefecture, JP
          </div>
          <div class="personal-info-field-value-edit">
            <form action="">
              <input type="phone" id="home" name="home">
            </form>
            <div class="personal-info-field-value-edit-btn">
              <button class="personal-info-field-value-edit-save-btn">Save</button>
              <button class="personal-info-field-value-edit-cancel-btn">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer() ?>