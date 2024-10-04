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
            <label for="">
              <input type="file" name="" id="" hidden>
              <img src="<?php echo get_template_directory_uri() ?>/assets/img/avatar.png" alt="">
            </label>
          </div>
          <div class="account-left-sidebar-username">
            F. last name
          </div>
          <p class="" data-translate-key="update personal info">update personal info</p>
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
            <a href="<?php echo home_url(); ?>/my-account/booking-list" class="active">
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
            <a href="<?php echo home_url(); ?>/my-account/setting">
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
        <h2 data-translate-key="Booking list" class="account-main-content-title">Booking list</h2>
        <div class="account-booking-list">
          <div class="tour-booking-detail-section">
            <div class="tour-booking-detail-section-desc">
              <div class="tour-booking-tour-info">
                <div class="tour-info-img">
                  <img src="<?php echo get_template_directory_uri() ?>/assets/img/1b.jpg" alt="">
                </div>
                <div class="tour-info-desc">
                  <h2 class="tour-info-desc-title">Essential tour for fashion and art in Tokyo for 6 hours with
                  local lunch</h2>
                  <div class="tour-info-desc-detail-info">
                    <span>
                      <img src="<?php echo get_template_directory_uri() ?>/assets/img/1077114.png" alt="">
                    </span>
                    <span>2 <span>Travelers</span></span>
                  </div>
                  <div class="tour-info-desc-detail-info">
                    <span>
                      <img src="<?php echo get_template_directory_uri() ?>/assets/img/16390596.png" alt="">
                    </span>
                    <span>Thu, Sep 05, 2024 • 9:00 AM</span>
                  </div>
                  <div class="tour-info-desc-detail-info">
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                        <g id="Group_17" data-name="Group 17" transform="translate(-748 -696)">
                          <g id="Ellipse_4" data-name="Ellipse 4" transform="translate(748 696)" fill="#fff" stroke="#212121" stroke-width="1">
                            <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                            <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                          </g>
                          <line id="Line_160" data-name="Line 160" x2="2.5" y2="2" transform="translate(752.5 704.5)" fill="none" stroke="#212121" stroke-width="1"/>
                          <line id="Line_161" data-name="Line 161" x1="5" y2="5" transform="translate(754.5 701.5)" fill="none" stroke="#212121" stroke-width="1"/>
                        </g>
                      </svg>
                    </span>
                    <span>Free cancellation before 9:00 AM on Sep 04, 2024</span>
                  </div>
                  <div class="tour-info-desc-detail-info">                
                    <span><a href="">Details about the experience operator</a></span>
                  </div>
                </div>
              </div>
              <div class="tour-booking-info-section">
                <h2>Traveler 1 (Adult)</h2>
                <div class="tour-booking-user-info-field">
                  <div class="tour-booking-user-info-field-col">
                    <label for="" data-translate-key="First name">First name</label>
                    <input type="text">
                  </div>
                  <div class="tour-booking-user-info-field-col">
                    <label for="" data-translate-key="Last name">Last name</label>
                    <input type="text">
                  </div>
                </div>
              </div>
              <div class="tour-booking-info-section">
                <h2>Traveler 2 (Adult)</h2>
                <div class="tour-booking-user-info-field">
                  <div class="tour-booking-user-info-field-col">
                    <label for="" data-translate-key="First name">First name</label>
                    <input type="text">
                  </div>
                  <div class="tour-booking-user-info-field-col">
                    <label for="" data-translate-key="Last name">Last name</label>
                    <input type="text">
                  </div>
                </div>
              </div>
              <div class="tour-booking-info-section">
                <h2 data-translate-key="Meeting and pickup">Meeting and pickup</h2> 
                <p data-translate-key="You can make your own way">You can make your own way to the meeting point or request pickup. If you're not sure, 
                you can decide later.</p>
                <div class="tour-booking-info-pickup">
                  <div class="tour-booking-info-pickup-item">
                    <h2>
                      <label for="pickup01" class="radio">
                        <input type="radio" name="pickup" id="pickup01" onchange="toggleClearButton()">
                        <span class="custom-radio"></span>
                        <p class="" data-translate-key="Meeting and pickup">Meeting and pickup</p>
                      </label>
                    </h2>
                    <div class="tour-booking-info-pickup-item-desc">
                      <div class="tour-booking-airline">
                        <span>
                          <img src="<?php echo get_template_directory_uri() ?>/assets/img/5172213.png" alt="">
                        </span>
                        <span>Haneda Airport, 3-3-2 Hanedakuko, Ota 144-0041 Tokyo Prefecture</span>
                      </div>
                      <p data-translate-key="Once your purchase">Once your purchase is complete, you'll be able to contact the provider to coordinate 
                      pickup.</p>
                      <div class="tour-booking-arrival-airline">
                      <label for="" data-translate-key="Arrival airline">Arrival airline</label>
                      <input type="text">
                      </div>
                      <div class="tour-booking-arrival-airline">
                        <label for="" data-translate-key="Arrival airline">Arrival airline</label>
                        <input type="text">
                      </div>
                      <div class="tour-booking-arrival-airline">
                        <label for="" data-translate-key="Arrival airline">Arrival airline</label>
                        <input type="text">
                      </div>
                    </div>                
                  </div>
                  <div class="tour-booking-info-pickup-item">
                    <h2>
                      <label for="pickup02" class="radio">
                        <input type="radio" name="pickup" id="pickup02" onchange="toggleClearButton()">
                        <span class="custom-radio"></span>
                        <p class="" data-translate-key="I’ll decide later">I’ll decide later</p>
                      </label>
                    </h2> 
                    <div class="tour-booking-info-pickup-item-desc"></div>              
                  </div>
                </div>           
              </div>
              <div class="tour-booking-next-button">
                <button data-translate-key="Next" class="next-button">Next</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer() ?>