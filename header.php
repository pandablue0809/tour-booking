<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    <meta name="google-signin-client_id" content="190636649070-fg2n4402ihq3kte1abvctbds6relmg2p.apps.googleusercontent.com">
    <?php wp_head(); ?>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-content">
              <div class="logo">
                  <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="">
                  </a>
              </div>
              <div class="header-search">
                  <img src="<?php echo get_template_directory_uri() ?>/assets/img/search.svg" alt="" class="search-button">
                  <input type="text" placeholder="Search destinations or activities" data-translate-key="Search destinations or activities">
              </div>
            </div>
            <div class="navbar">
                <div class="language-selector">
                    <button id="language-btn">
                        <span class="world-icon"><img src="<?php echo get_template_directory_uri() ?>/assets/img/worldIcon.svg" alt=""></span>
                        <span class="dropdown-icon">▼</span>
                    </button>
                    <ul id="language-options" class="dropdown hidden">
                        <li class="language-option" data-language="en" data-translate-key="English">English</li>
                        <li class="language-option" data-language="jp" data-translate-key="Japanese">日本語</li>
                    </ul>
                </div>
                <div class="currency-selector">
                    <button id="currency-btn">
                        <span id="selected-currency">JPY</span>
                        <span class="dropdown-icon">▼</span>
                    </button>
                    <ul id="currency-options" class="currency-dropdown hidden">
                        <li class="currency-option" data-currency="USD">USD</li>
                        <li class="currency-option" data-currency="JPY">JPY</li>
                    </ul>
                </div>
                <div class="nav-item">
                  <a href="" data-translate-key="HELP">HELP</a>
                </div>
                <div class="nav-item">
                  <a href="" data-translate-key="CART">CART</a>
                </div>
                <?php if ( is_user_logged_in() ) : ?>
                    <!-- If the user is logged in, show the avatar -->
                    <div class="nav-item">
                        <a class="nav-item-user" id="navItemUser">
                            <?php
                            $current_user_id = get_current_user_id();
                            $avatar_url = get_user_meta($current_user_id, 'user_avatar', true);
                            if ($avatar_url) {
                                echo '<img class="avatar" src="' . esc_url($avatar_url) . '" alt="User Avatar">';
                            } else {
                                echo '<img class="avatar" src="' . get_template_directory_uri() . '/assets/img/avatar.png" alt="Default Avatar">';
                            }
                            ?>
                        </a>
                        <div class="nav-sub-item" id="navSubItem">
                            <li>
                                <a href="<?php echo home_url(); ?>/my-account/my-info">
                                    <span>
                                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/13924070.png" alt="">
                                    </span>
                                    <span data-translate-key="Profile">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo home_url(); ?>/my-account/my-info">
                                    <span>
                                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/svgviewer-png-output.png" alt="">
                                    </span>
                                    <span data-translate-key="Booking">Booking</span>
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
                <?php else : ?>
                    <!-- If the user is not logged in, show the Log In button -->
                    <div class="nav-item">
                        <a href="<?php echo home_url(); ?>/log-in" data-translate-key="Log In">Log In</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
