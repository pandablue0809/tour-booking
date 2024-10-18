<?php get_header()?>
<?php
  $date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : '';
if (!empty($date)) {
    $dateTime = DateTime::createFromFormat('m/d/Y', $date); // Assuming the date is in 'm/d/Y' format
    if ($dateTime) {
        $formatted_date = $dateTime->format('D, M d, Y'); // Format it as 'Thu, Sep 05, 2024'
    } else {
        $formatted_date = 'Invalid Date'; // Handle invalid date format
    }
} else {
    $formatted_date = 'Date Not Provided';
}
  $members = isset($_GET['members']) ? intval($_GET['members']) : '';
  $time = isset($_GET['time']) ? sanitize_text_field($_GET['time']) : '';
  $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : '';
  if (!$post_id) {
    wp_redirect(home_url('/404'));
    exit;
}
  $tour_post = get_post($post_id);
  $tour_poster_email = get_the_author_meta('user_email', $tour_post->post_author);
  $tour_title_en = $tour_post ? get_the_title($tour_post) : 'Tour not found';
  $tour_title_jp = get_post_meta($post_id,'title_jp',true);
  $tour_price =  get_field('price', $post_id);
  $price_usd = isset($tour_price['usd']) ? $tour_price['usd'] : 'N/A';
  $price_jpy = isset($tour_price['jpy']) ? $tour_price['jpy'] : 'N/A';
  $total_price_jpy = intval($members) * floatval($price_jpy);
  $total_price_usd = intval($members) * floatval($price_usd);
  $tour_images =  get_field('images', $post_id);
  $tour_first_image = isset($tour_images['image_01']) ? $tour_images['image_01'] : null;
  $first_image_url = isset($tour_first_image['url']) ? esc_url($tour_first_image['url']) : get_template_directory_uri() . '/assets/img/noImage.png';
 $free_cancellation = get_field('free_cancellation', $post_id);
 $social = get_field('social', $post_id);
 $facebook_link = isset($social['facebook']) ? esc_url($social['facebook']) : '';
 $twitter_link = isset($social['twitter']) ? esc_url($social['twitter']) : '';
 $instagram_link = isset($social['instagram']) ? esc_url($social['instagram']) : '';
 $pickup_points = get_field('pickup_points',  $post_id);
 $pickup_points_address_jp = $pickup_points['pickup_points_address_jp'];
 $pickup_points_address_en = $pickup_points['pickup_points_address_en'];
?>
<main>
  <div class="tour-booking-detail container">
    <div class="tour-booking-detail-main-container">
      <div class="tour-booking-detail-section step available" data-step="1">
        <h2 class="tour-booking-detail-section-title">
          <span class="tour-booking-detail-section-title-mark">1</span>
          <span data-translate-key="Contact details">Contact details</span>
		  <span class="tour-booking-detail-edit-btn">Edit</span>
        </h2>
        <div class="before-confirmation available">
          <p class="tour-contact-detail-desc" data-translate-key="We'll use this information">
            We'll use this information to send you confirmation and updates about your booking
          </p>
          <div class="tour-switch-user">
            <?php if (is_user_logged_in()) :
                $current_user = wp_get_current_user();
                ?>
                <p class="tour-switch-user-current-user">
                    <span class="tour-switch-user-current-user-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10" height="10" viewBox="0 0 10 10">
                        <image id="_1077114" data-name="1077114" width="10" height="10" xlink:href="data:image/png;base64,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"/>
                      </svg>
                    </span>
                    <span>
                        <span data-translate-key="Signed in as">Signed in as:</span>
                        <span class="tour-switch-user-current-user-name"><?php echo esc_html($current_user->display_name); ?></span>
                    </span>
                </p>
                <p class="tour-switch-user-button">
                    <a href="<?php echo wp_logout_url(home_url()); ?>" data-translate-key="Switch user">Switch user</a>
                </p>
            <?php else : ?>
                <p class="tour-switch-user-current-user">
                    <span data-translate-key="Not signed in.">Not signed in.</span>
                </p>
                <p class="tour-switch-user-button">
                    <a href="<?php echo home_url(); ?>/log-in" data-translate-key="Sign in">Sign in</a>
                </p>
            <?php endif; ?>
          </div>
          <div class="tour-booking-user-info">
            <div class="tour-booking-user-info-field">
              <div class="tour-booking-user-info-field-col">
                <label for="" data-translate-key="First name">First name</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo is_user_logged_in() ? esc_attr(get_user_meta($current_user->ID, 'first_name', true)) : ''; ?>" />
              </div>
              <div class="tour-booking-user-info-field-col">
                <label for="" data-translate-key="Last name">Last name</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo is_user_logged_in() ? esc_attr(get_user_meta($current_user->ID, 'last_name', true)) : ''; ?>" />
              </div>
            </div>
            <div class="tour-booking-user-info-field">
              <div class="tour-booking-user-info-field-col">
                <label for="" data-translate-key="Email">Email</label>
              <input type="email" name="email" id="email" value="<?php echo is_user_logged_in() ? esc_attr($current_user->user_email) : ''; ?>" <?php echo is_user_logged_in() ? 'disabled' : ''; ?> />
              </div>
            </div>
            <div class="tour-booking-user-info-field">
              <div class="tour-booking-user-info-field-col">
                <label for="" data-translate-key="Phone number">Phone number</label>
                <input type="text" name="phone_number" id="phone_number" value="<?php echo is_user_logged_in() ? esc_attr(get_user_meta($current_user->ID, 'phone_number', true)) : ''; ?>" />
              </div>
            </div>
          </div>
          <div class="tour-booking-next-button">
            <button data-translate-key="Next" class="next-button">Next</button>
          </div>
        </div>
        <div class="after-confirmation">
          <div class="guest-name">

          </div>
          <div class="guest-email">
            <span data-translate-key="Email:">Email: </span>
            <span>
              <?php esc_attr($current_user->user_email); ?>
            </span>
          </div>
          <div class="GUEST-PHONE">
            <span data-translate-key="Phone:">Phone: </span>
            <span></span>
          </div>
        </div>        
      </div>
      <div class="tour-booking-detail-section step" data-step="2">
        <h2 class="tour-booking-detail-section-title">
          <span class="tour-booking-detail-section-title-mark">2</span>
          <span data-translate-key="Activity details">Activity details</span>
		  <span class="tour-booking-detail-edit-btn">Edit</span>
        </h2>
        <div class="tour-booking-detail-section-desc">
          <div class="tour-booking-tour-info">
            <div class="tour-info-img">
              <img src="<?php echo esc_url($first_image_url); ?>" alt="">
            </div>
            <div class="tour-info-desc">
              <h2 class="tour-info-desc-title translate" data-name-en="<?php echo esc_html($tour_title_en); ?>" data-name-jp="<?php echo esc_html($tour_title_jp); ?>"><?php echo esc_html($tour_title_en); ?></h2>
              <div class="tour-info-desc-detail-info">
                <span>
                  <img src="<?php echo get_template_directory_uri() ?>/assets/img/1077114.png" alt="">
                </span>
                <span><?php echo esc_html($members); ?> <span data-translate-key="Travelers">Travelers</span></span>
              </div>
              <div class="tour-info-desc-detail-info">
                <span>
                  <img src="<?php echo get_template_directory_uri() ?>/assets/img/16390596.png" alt="">
                </span>
                <span><?php echo esc_html($formatted_date . ' • ' . $time); ?></span>
              </div>
              <?php 
              if ($free_cancellation) {
                echo '
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
                  <span class="translate" data-name-en="Free cancellation before ' . esc_html($time . ' on ' . $formatted_date) . '" data-name-jp="' . esc_html($time . ' on ' . $formatted_date) . 'キャンセル無料">Free cancellation before ' . esc_html($time . ' on ' . $formatted_date) . '</span>
                </div>
                ';
              }	
              ?>     
            </div>
          </div>
          <div class="before-confirmation">
            <div class="tour-booking-info-section">
              <h2>Traveler 1 (Adult)</h2>
              <div class="tour-booking-user-info-field">
                <div class="tour-booking-user-info-field-col">
                  <label for="" data-translate-key="First name">First name</label>
                  <input type="text" id="travelerOneFirstName">
                </div>
                <div class="tour-booking-user-info-field-col">
                  <label for="" data-translate-key="Last name">Last name</label>
                  <input type="text" id="travelerOneLastName">
                </div>
              </div>
            </div>
            <div class="tour-booking-info-section">
              <h2>Traveler 2 (Adult)</h2>
              <div class="tour-booking-user-info-field">
                <div class="tour-booking-user-info-field-col">
                  <label for="" data-translate-key="First name">First name</label>
                  <input type="text" id="travelerTwoFirstName">
                </div>
                <div class="tour-booking-user-info-field-col">
                  <label for="" data-translate-key="Last name">Last name</label>
                  <input type="text" id="travelerTwoLastName">
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
                      <input type="radio" name="pickup" id="pickup01" onchange="toggleClearButton()" checked>
                      <span class="custom-radio"></span>
                      <p class="" data-translate-key="Meeting and pickup">Meeting and pickup</p>
                    </label>
                  </h2>
                  <div class="tour-booking-info-pickup-item-desc">
                    <div class="tour-booking-airline">
                      <span>
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/5172213.png" alt="">
                      </span>
					 <span class="translate" data-name-en="<?php echo esc_attr($pickup_points_address_en); ?>" data-name-jp="<?php echo esc_attr($pickup_points_address_jp); ?>"><?php echo esc_attr($pickup_points_address_en); ?></span>
                    </div>
                    <p data-translate-key="Once your purchase">Once your purchase is complete, you'll be able to contact the provider to coordinate 
                    pickup.</p>
                    <div class="tour-booking-arrival-airline">
                    <label for="" data-translate-key="Arrival airline">Arrival airline</label>
                    <input type="text" id="arrival-airline-01">
                    </div>
<!--                     <div class="tour-booking-arrival-airline">
                      <label for="" data-translate-key="Arrival airline">Arrival airline</label>
                      <input type="text" id="arrival-airline-02">
                    </div>
                    <div class="tour-booking-arrival-airline">
                      <label for="" data-translate-key="Arrival airline">Arrival airline</label>
                      <input type="text" id="arrival-airline-03">
                    </div> -->
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
          <div class="after-confirmation">
            <div>
              <p class="after-confirmation-title" data-translate-key="Primary traveler">Primary traveler</p>
              <p id="primary-traveler"></p>
            </div>
            <div>
              <p class="after-confirmation-title" data-translate-key="Pickup point">
                Pickup point
              </p>
              <p id="pickup-point"></p>
            </div>
          </div>
        </div>
      </div>
      <div class="tour-booking-detail-section step" data-step="3">
        <h2 class="tour-booking-detail-section-title">
          <span class="tour-booking-detail-section-title-mark">3</span>
          <span data-translate-key="Payment details">Payment details</span>
		  <span class="tour-booking-detail-edit-btn">Edit</span>
        </h2>
        <div class="before-confirmation">
          <div class="tour-booking-info-payment">
            <div class="tour-booking-info-payment-item">
              <h2>
                <label for="payment01" class="radio">
                  <input type="radio" name="payment" id="payment01" onchange="toggleClearButton()">
                  <span class="custom-radio"></span>
                  <p class="" data-translate-key="Debit/Credit Card">Debit/Credit Card</p>
                </label>
              </h2>
              <div class="tour-booking-info-payment-item-desc">
                
              </div>                
            </div>
            <div class="tour-booking-info-payment-item">
              <h2>
                <label for="payment02" class="radio">
                  <input type="radio" name="payment" id="payment02" onchange="toggleClearButton()">
                  <span class="custom-radio"></span>
                  <p class="" data-translate-key="Paypal">Paypal</p>
                </label>
              </h2> 
              <div class="tour-booking-info-payment-item-desc">

              </div>              
            </div>
          </div> 
          <p class="tour-booking-detail-agree">
          You will be charged the total amount once your order is confirmed by the Operator.
          </p>
          <p class="tour-booking-detail-agree">
          By clicking 'Book Now', you agree to "company-name" ’s Customer Terms of Use and Privacy Statement, plus the third 
          party operator’s terms & conditions. "company-name". facilitates your booking, but the operator provides the 
          experience directly to you. You also consent to receive updates from "company-name", including inspirations, tips, 
          and other information, from which you can unsubscribe at any time.
          </p>
          <div class="tour-booking-button">
            <button data-translate-key="BOOK NOW" onclick="booking()">BOOK NOW</button>
          </div>
          <div id="#booking-response"></div>
        </div>
        <div class="after-confirmation">

        </div>
      </div> 
    </div>
    <div class="tour-booking-sidebar">
      <div class="tour-detail-book-container">
        <div class="tour-booking-sidebar-tourInfo">
          <div class="tourInfo-img">
            <img src="<?php echo esc_url($first_image_url); ?>" alt="">
          </div>
          <div class="tourInfo-title">
            <h2 class="translate" data-name-en="<?php echo esc_html($tour_title_en); ?>" data-name-jp="<?php echo esc_html($tour_title_jp); ?>"><?php echo esc_html($tour_title_en); ?></h2>
          </div>
          <div class="tourInfo-price tour-currency" data-price-usd="<?php echo esc_attr($price_usd); ?>"
          data-price-jpy="<?php echo esc_attr($price_jpy); ?>">
           ¥ <?php echo esc_html($price_jpy); ?>
          </div>
        </div>
        <div class="tour-info-desc-detail-info">
          <span>
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/1077114.png" alt="">
          </span>
          <span><?php echo esc_html($members); ?> <span data-translate-key="Travelers">Travelers</span></span>
        </div>
        <div class="tour-info-desc-detail-info">
          <span>
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/16390596.png" alt="">
          </span>
          <span><?php echo esc_html($formatted_date . ' • ' . $time); ?></span>
        </div>
		  <?php 
		  if ($free_cancellation) {
				echo '
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
					<span class="translate" data-name-en="Free cancellation before ' . esc_html($time . ' on ' . $formatted_date) . '" data-name-jp="' . esc_html($time . ' on ' . $formatted_date) . 'キャンセル無料">Free cancellation before ' . esc_html($time . ' on ' . $formatted_date) . '</span>
				</div>
				';
			}	
		  ?>        
        <div class="tour-info-traveler-number-price">
          <span><?php echo esc_html($members); ?> <span data-translate-key="Travelers">Travelers</span></span>
          <span class="tour-currency last-span"  data-price-usd="<?php echo esc_attr($total_price_usd); ?>"
          data-price-jpy="<?php echo esc_attr($total_price_jpy); ?>"> ¥ <?php echo esc_html($total_price_jpy); ?></span>
        </div>
        <div class="tour-info-desc-contact">
			<a href="<?php echo esc_url(home_url('/contact')); ?>?email=<?php echo esc_attr($tour_poster_email); ?>" data-translate-key="Contact us">Contact us</a>
        </div>
        <div class="tour-detail-social-button">
          <span data-translate-key="Share">Share</span>
          <a href="<?php echo esc_url($facebook_link); ?>">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/social-media-logos-set_1.png" alt="">
          </a>
          <a href="<?php echo esc_url($twitter_link); ?>">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/social-media-logos-set_69286.png" alt="">
          </a>
          <a href="<?php echo esc_url($instagram_link); ?>">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/social-media-logos-set_69286-518.png" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer() ?>