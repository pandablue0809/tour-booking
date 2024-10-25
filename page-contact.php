<?php get_header()?>
<?php 
  $receiver_email = isset($_GET['email']) ? $_GET['email'] : get_option('admin_email');
?>
<main>
  <div class="contact-fv">
      <div class="opacity-image"></div>
      <div class="contact-mainvisual container">
          <h1 class="contact-mainvisual-title" data-translate-key="Contact us">Contact us</h1>
          <p class="contact-mainvisual-desc" data-translate-key="See frequently asked questions FAQ">See frequently asked questions FAQ</p>
      </div>
  </div>
  <section class="contact-section01">
      <div class="container contact-section01-desc" data-translate-key="If you would like">
        If you would like to consult or hear more about this, please contact us using the email form below. After reviewing the details, a member of staff will get back to you.
      </div>
  </section>
  <section class="contact-section02">
    <div class="container">
      <div class="contact-form">
        <form id="contactForm" method="POST">
          <input type="email" id="receiver_email" value="<?php echo esc_attr($receiver_email); ?>" hidden>
          <div class="contact-form-item">
            <div class="contact-form-label">
              <span class="required" data-translate-key="Required">Required</span>
              <label for="" data-translate-key="Question categories">Question categories</label>
            </div>
            <div class="contact-form-input">
              <select name="category" id="category" required>
                <option value="" data-translate-key="Please select">Please select</option> 
                <option value="General Inquiry">General Inquiry</option>
                <option value="Technical Support">Technical Support</option>                 
              </select>
            </div>
          </div>  
          <div class="contact-form-item">
            <div class="contact-form-label">
              <span class="required" data-translate-key="Required">Required</span>
              <label for="" data-translate-key="Inquiry contents">Inquiry contents</label>
            </div>
            <div class="contact-form-input">
              <textarea name="message" id="message" rows="3" required></textarea>
              <p class="contact-form-input-desc">
              <span data-translate-key="Please enter your reservation number">※Please enter your reservation number.</span> <br>
              <span data-translate-key="For those who have">(For those who have already made a reservation)</span>
              </p>
            </div>
          </div> 
          <div class="contact-form-item">
            <div class="contact-form-label">
              <span class="required" data-translate-key="Required">Required</span>
              <label for="" data-translate-key="mail address">mail address</label>
            </div>
            <div class="contact-form-input">
              <input type="email" name="email" id="email" required>
            </div>
          </div> 
          <div class="contact-form-item">
            <div class="contact-form-label">
              <span class="optional" data-translate-key="Optional">Optional</span>
              <label for="" data-translate-key="Name">Name</label>
            </div>
            <div class="contact-form-input">
              <input type="text" name="name" id="name">
            </div>
          </div>
          <div class="contact-form-item">
            <div class="contact-form-label">
              <span class="optional" data-translate-key="Optional">Optional</span>
              <label for="" data-translate-key="Phone number">Phone number</label>
            </div>
            <div class="contact-form-input">
              <input type="text" name="phone" id="phone">
            </div>
          </div>
          <div class="contact-form-item">
            <label class="contact-form-checkbox">
              <input type="checkbox" name="agreement" id="agreement" required>
              <span data-translate-key="I agree to the">I agree to the "Personal Information Handling Agreement".</span>
            </label>              
          </div> 
          <div class="contact-form-submit">
            <input type="submit" value="Confirm the contents">
          </div>                    
        </form>
        <div id="formResponse"></div>
      </div>
    </div>
  </section>
  <section class="contact-section03">
    <div class="container">
      <h2 class="contact-section03-title" data-translate-key="About site name">About Wild Tour</h2>
      <p class="contact-section03-desc" data-translate-key="sitedescription">wild Tour is the premier activity booking platform in Japan, offering easy access to a vast selection of experiences across the nation. With partnerships encompassing over 6,000 suppliers, we provide an extensive range of more than 400 activity types, including over 18,000 outdoor adventures, DIY experiences, day trips, leisure pursuits, and online experiences. Available in Japanese, Mandarin (Traditional and Simplified), Korean, and Thai, "site name" caters to a global clientele, whether booking online or through travel agencies. Our network includes over 200 online media outlets that feature popular budget tours and the latest travel tips for both domestic and international destinations. Enjoy exclusive discounts, best-price guarantees, and earn points on every booking. Book today and discover the best-priced outdoor activities, day trips, leisure activities, and online experiences with "site name"!</p>
    </div>
  </section>
  <section class="section08 container">
    <h2 class="section-title" data-translate-key="Popular Cities">Popular Cities</h2>
    <ul class="section08-desc">
      <?php
        $args = array(
            'taxonomy' => 'destinations',
            'hide_empty' => false,
            'number' => 30, 
			'parent' => 0,
        );

        $terms = get_terms($args);

        $terms = array_filter($terms, function($term) {
            return $term->slug !== 'uncategorized';
        });

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $name_en = get_field('name_en', 'destinations_' . $term->term_id); 
                $name_jp = $term->name;
                ?>
                <li class="section08-city">
                  <a href="<?php echo esc_url(get_term_link($term)); ?>" class="translate" data-name-en="Things to do in <?php echo esc_attr($name_en); ?>" data-name-jp="<?php echo esc_attr($name_jp); ?>でやるべきこと" ></a>
                </li>
                <?php
            }
        } else {
            echo '<p>No destinations found.</p>';
        }
      ?>
    </ul>
  </section>
  <section class="section09 container">
    <h2 class="section-title" data-translate-key="Popular Attractions">Popular Attractions</h2>
    <ul class="section08-desc">
      <?php
        $args = array(
            'taxonomy' => 'attractions',
            'hide_empty' => false,
            'number' => 30, 
        );

        $terms = get_terms($args);

        $terms = array_filter($terms, function($term) {
            return $term->slug !== 'uncategorized';
        });

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $name_en = get_field('name_en', 'attractions_' . $term->term_id); 
                $name_jp = $term->name;
                ?>
                <li class="section08-city">
                  <a href="<?php echo esc_url(get_term_link($term)); ?>" class="translate" data-name-en="<?php echo esc_attr($name_en); ?>" data-name-jp="<?php echo esc_attr($name_jp); ?>" ></a>
                </li>
                <?php
            }
        } else {
            echo '<p>No attractions found.</p>';
        }
      ?>
    </ul>
  </section>
</main>

<?php get_footer() ?>