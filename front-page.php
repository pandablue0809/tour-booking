<?php get_header()?>

<main>
  <div class="sub-header container">
    <li class="sub-header-item">
      <a href="" class="sub-header-item-map">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/map.svg" alt="">
        <span data-translate-key="Explore destinations">Explore destinations</span>
      </a>
      <div class="sub-header-sub-menu">
        <div class="col1">
          <?php 
            $args = array(
              'taxonomy' => 'destinations',
              'hide_empty' => false,
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

                    // Get child destinations
                    $child_args = array(
                      'taxonomy' => 'destinations',
                      'hide_empty' => false,
                      'parent' => $term->term_id,
                    );
                    $child_terms = get_terms($child_args);
                    $child_list = array();

                    if (!empty($child_terms)) {
                        foreach ($child_terms as $child) {
                            $child_name_en = get_field('name_en', 'destinations_' . $child->term_id);
                            $child_name_jp = $child->name;
                            $child_category_image = get_field('category_image', 'destinations_' . $child->term_id);
                            $child_category_image_url = (!empty($child_category_image)) ? esc_url($child_category_image['url']) : get_template_directory_uri() . '/assets/img/32.png'; // Default image
                            $child_list[] = array('name_en' => $child_name_en, 'name_jp' => $child_name_jp, 'image_url' => $child_category_image_url);
                        }
                    }
                    
                    ?>
                    <a href="<?php echo esc_url(get_term_link($term)); ?>" 
                      class="parent-destination" 
                      data-children='<?php echo json_encode($child_list); ?>'>                                             
                      <p class="translate" data-name-en="<?php echo esc_attr($name_en); ?>" 
                      data-name-jp="<?php echo esc_attr($name_jp); ?>"></p>                      
                    </a>
                    <?php
                }
            } else {
                echo '<p>No destinations found.</p>';
            }
          ?>
        </div>
        <div class="col2"></div>
      </div>
    </li>
    <li class="sub-header-item">
      <a href="" class="sub-header-item-category">
        <span data-translate-key="All categories">All categories</span>
      </a>
      <div class="sub-header-sub-menu">
        <div class="col">
          <?php 
            $args = array(
              'taxonomy' => 'activity',
              'hide_empty' => false,
              'parent' => 0,
            );
            $terms = get_terms($args);

            $terms = array_filter($terms, function($term) {
                return $term->slug !== 'uncategorized';
            });

            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $name_en = get_field('name_en', 'activity_' . $term->term_id); 
                    $name_jp = $term->name;
                    
                    ?>
                    <a href="<?php echo esc_url(get_term_link($term)); ?>" 
                      class="parent-destination" 
                      data-children='<?php echo json_encode($child_list); ?>'>                                             
                      <p class="translate" data-name-en="<?php echo esc_attr($name_en); ?>" 
                      data-name-jp="<?php echo esc_attr($name_jp); ?>"></p>                      
                    </a>
                    <?php
                }
            } else {
                echo '<p>No activity found.</p>';
            }
          ?>
        </div>
      </div>
    </li>
    <li class="sub-header-item">
      <a href="" class="sub-header-item-tuor">
        <span data-translate-key="Tours & experience">Tours & experience</span>
      </a>
      <div class="sub-header-sub-menu">
        <div class="col">
          <?php 
            $args = array(
              'taxonomy' => 'attractions',
              'hide_empty' => false,
              'parent' => 0,
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
                    <a href="<?php echo esc_url(get_term_link($term)); ?>" 
                      class="parent-destination">                                             
                      <p class="translate" data-name-en="<?php echo esc_attr($name_en); ?>" 
                      data-name-jp="<?php echo esc_attr($name_jp); ?>"></p>                      
                    </a>
                    <?php
                }
            } else {
                echo '<p>No activity found.</p>';
            }
          ?>
        </div>
      </div>
    </li>
  </div>
  <div class="main-fv">
    <div class="image-slider-container">
      <div class="image-slider">
        <div class="slide">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/fv.png" alt="Image 1">
        </div>
        <div class="slide">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/fv.png" alt="Image 2">
        </div>
        <div class="slide">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/fv.png" alt="Image 3">
        </div>
      </div>
    </div>
    <div class="opacity-image"></div>    
    <div class="main-visual">
        <div class="relative container">
          <div class="main-search">
            <h1 data-translate-key="Journey to Joy">Journey to Joy</h1>
            <p class="main-search-desc" data-translate-key="Embark on a personalized adventure where every moment is tailored to bring happiness and fulfillment into your life.">
              Embark on a personalized adventure where every moment is tailored to bring happiness and fulfillment into your life.
            </p>
            <div class="search-form">
              <form role="search" method="get" action="<?php echo home_url('/tours'); ?>" id="searchForm">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/search.svg" alt="">
                <input class="search-place" type="text" name="s" id="searchInputTopPage" placeholder="Search for a place or activity" autocomplete="off" data-translate-key="Search for a place or activity">
                <button type="submit" class="search-btn" data-translate-key="Search">Search</button>
              </form>
              <ul id="searchResultsDropdownTopPage" class="dropdownTopPage hidden"></ul>
            </div>
          </div>
          <button class="fv-prev"><img src="<?php echo get_template_directory_uri() ?>/assets/img/Group 1.svg" alt=""></button>
          <button class="fv-next"><img src="<?php echo get_template_directory_uri() ?>/assets/img/Group 2.svg" alt=""></button>
        </div>      
    </div>
  </div>
  <section class="section01 container">
    <div class="section01-col">
      <img src="<?php echo get_template_directory_uri() ?>/assets/img/10949712.png" alt="">
      <div class="section01-col-desc">
        <h2 data-translate-key="Stay flexible">Stay flexible</h2>
        <p data-translate-key="Flexible cancellation options on all venues">Flexible cancellation options on all venues</p>
      </div>
    </div>
    <div class="section01-col">
      <img src="<?php echo get_template_directory_uri() ?>/assets/img/16861866.png" alt="">
      <div class="section01-col-desc">
        <h2 data-translate-key="Book with confidence">Book with confidence</h2>
        <p data-translate-key="Easy booking and skip-the-line entry on your phone">Easy booking and skip-the-line entry on 
        your phone</p>
      </div>
    </div>
    <div class="section01-col">
      <img src="<?php echo get_template_directory_uri() ?>/assets/img/17190576.png" alt="">
      <div class="section01-col-desc">
        <h2 data-translate-key="Enjoy culture your way">Enjoy culture your way</h2>
        <p data-translate-key="The best experiences at museums and attractions japan">The best experiences at museums and 
        attractions japan</p>
      </div>
    </div>
  </section>
  <section class="section02 container">
    <h2 class="section02-title" data-translate-key="Travelers' favorite choice">Travelers' favorite choice</h2>
    <div class="section02-slider">
      <div class="section02-slider-container">
        <div class="section02-tours">
          <?php
            // Query for the custom post type 'tours'
            $args = array(
                'post_type' => 'tours',
                'posts_per_page' => 8, // Display all tours
            );
            $tours_query = new WP_Query($args);
            if ($tours_query->have_posts()) : ?>
             <?php while ($tours_query->have_posts()) : $tours_query->the_post(); ?>
              <a href="<?php echo esc_url(get_permalink()); ?>" class="section02-tour">
                <div class="section02-tour-img">
                  <?php
					$images = get_field('images');
					if (!empty($images) && is_array($images)) {
						$first_image = $images['image_01'];
						$first_image_url = isset($first_image['url']) ? esc_url($first_image['url']) : get_template_directory_uri() . '/assets/img/noImage.png';
					} else {
						$first_image_url = get_template_directory_uri() . '/assets/img/noImage.png';
					}
					?>
					<img src="<?php echo $first_image_url; ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                </div>
                <div class="section02-tour-desc">
					<?php
                    // Get the first term of the 'attractions' taxonomy
                    $attractions = get_the_terms(get_the_ID(), 'attractions');
                    if ($attractions && !is_wp_error($attractions)) {
                        // Get ACF fields for English and Japanese terms
                        $attraction_name_en = get_field('name_en', 'attractions_' . $attractions[0]->term_id);
                        $attraction_name_jp = $attractions[0]->name; // Japanese name (default term name)
                    } else {
                        $attraction_name_en = 'tour';
                        $attraction_name_jp = '旅行';
                    }

                    // Get the first term of the 'destinations' taxonomy
                    $destinations = get_the_terms(get_the_ID(), 'destinations');
                    if ($destinations && !is_wp_error($destinations)) {
                        // Get ACF fields for English and Japanese terms
                        $destination_name_en = get_field('name_en', 'destinations_' . $destinations[0]->term_id);
                        $destination_name_jp = $destinations[0]->name; // Japanese name (default term name)
                    } else {
                        $destination_name_en = 'Japan';
                        $destination_name_jp = '日本';
                    }

                    $title_en = get_the_title();
                    $title_jp = get_field('title_jp');
					$price = get_field('price');
					$price_usd = $price['usd'];
					$price_jpy = $price['jpy'];
                  ?>
                  <div class="section02-tour-title translate" 
                      data-name-en="<?php echo esc_attr($attraction_name_en . ' · ' . $destination_name_en); ?>" 
                      data-name-jp="<?php echo esc_attr($attraction_name_jp . ' · ' . $destination_name_jp); ?>">
                      <?php echo esc_html($attraction_name_en . ' · ' . $destination_name_en); ?>
                  </div>
                  <div class="section02-tour-content translate"
					  data-name-en="<?php echo esc_attr($title_en); ?>"
					  data-name-jp="<?php echo esc_attr($title_jp); ?>">
					  <?php echo esc_attr($title_en); ?>
				  </div>
                  <div class="section02-tour-tag">Bestseller</div>
                  <div class="section02-tour-review"><span class="section02-star">★ 4.6</span> (6,000) • 100K+ booked</div>
                  <div class="section02-tour-price">
					  <span data-translate-key="From">From</span>
					  <span class="tour-currency"
						data-price-usd="<?php echo esc_attr($price_usd); ?>"
                    	data-price-jpy="<?php echo esc_attr($price_jpy); ?>">
						  ¥ <?php echo esc_html($price_jpy); ?>
					  </span>
				  </div>
                </div>
              </a>
            <?php endwhile; ?>
            <?php else : ?>
                <p><?php _e('No tours found.'); ?></p>
            <?php endif; ?>

          <?php wp_reset_postdata(); ?>
        </div>
      </div>
      <div class="section02-prev">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/Group 4.png" alt="">
      </div>
      <div class="section02-next">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/Group 5.png" alt="">
      </div>
    </div>
    <div class="more-btn">
      <a href="<?php echo esc_url(get_post_type_archive_link('tours')); ?>" data-translate-key="See more">See more</a>
    </div>
  </section>
  <section class="section03 container">
    <h2 class="section-title" data-translate-key="Top attractions near Japan">Top attractions near Japan</h2>
    <div class="section03-attractions">
      <?php
        $args = array(
            'taxonomy' => 'attractions', 
            'hide_empty' => false,
        );

        $terms = get_terms($args);

        $terms = array_filter($terms, function($term) {
            return $term->slug !== 'uncategorized';
        });

        usort($terms, function($a, $b) {
            return $b->count - $a->count;
        });

        $terms = array_slice($terms, 0, 9);

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $name_en = get_field('name_en', 'attractions_' . $term->term_id);
                $name_jp = $term->name;
                $category_image = get_field('category_image', 'attractions_' . $term->term_id);
                $category_image_url = (!empty($category_image)) ? esc_url($category_image['url']) : get_template_directory_uri() . '/assets/img/32.png'; // Default image
                $tour_count = $term->count; 
                ?>
                <a href="<?php echo esc_url(get_term_link($term)); ?>">
                    <div class="section03-attraction">
                        <div class="section03-img">
                            <img src="<?php echo $category_image_url; ?>" alt="<?php echo esc_attr($term->name); ?>"></div>
                        <div class="section03-attraction-desc">
                            <div class="section03-attraction-title translate" data-name-en="<?php echo esc_attr($name_en); ?>" data-name-jp="<?php echo esc_attr($name_jp); ?>" >
                                
                            </div>
                            <div class="section03-attraction-tourNumber">
                                <?php echo esc_html($tour_count); ?> <span data-translate-key="Tours and Activities">Tours and Activities</span>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
            }
        } else {
            echo '<p>No attractions found.</p>';
        }
      ?>
    </div>
  </section>
  <section class="section04 container">
    <h2 class="section-title" data-translate-key="Inspiration for your itinerary">Inspiration for your itinerary</h2>
    <div class="section04-inspirations">
      <div class="section04-inspiration">
        <div class="inspiration-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/daigoji-temple_1203-3340.png" alt="">
        </div>
        <div class="inspiration-bg1"></div>
        <div class="inspiration-desc">
          <h2 class="inspiration-title" data-translate-key="Best staycation deals">Best staycation deals</h2>
          <p class="inspiration-desc-desc"><span data-translate-key="Enjoy these cool">Enjoy these cool staycation</span><br>
          <span data-translate-key="promotions in Tokyo">promotions in Tokyo</span></p>
        </div>
        <a href="" data-translate-key="See activities" class="inspiration-desc-link">See activities</a>
      </div>
      <div class="section04-inspiration">
        <div class="inspiration-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/medium-shot-friends-holding-wagasa-umbrella_23-2149557154.png" alt="">
        </div>
        <div class="inspiration-bg2"></div>
        <div class="inspiration-desc">
          <h2 class="inspiration-title" data-translate-key="All Time Favourite Activities in Tokyo">All Time Favourite Activities in Tokyo</h2>
          <p class="inspiration-desc-desc" data-translate-key="Don't forget to check out these activities while you're here">Don't forget to check out these activities while you're here</p>
        </div>
        <a href="" data-translate-key="See activities" class="inspiration-desc-link">See activities</a>
      </div>
    </div>
  </section>
  <section class="section05 container">
    <h2 class="section-title" data-translate-key="Where to next?">Where to next?</h2>
    <div class="section05-destinations">
      <?php
        $args = array(
            'taxonomy' => 'destinations',
            'hide_empty' => false,
            'number' => 10, 
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
                $category_image = get_field('category_image', 'destinations_' . $term->term_id); 
                $category_image_url = (!empty($category_image)) ? esc_url($category_image['url']) : get_template_directory_uri() . '/assets/img/b5.png';
                ?>
                <a href="<?php echo esc_url(get_term_link($term)); ?>">
                    <div class="section05-destination">
                        <div class="section05-destination-img">
                            <img src="<?php echo $category_image_url; ?>" alt="<?php echo esc_attr($term->name); ?>">
                        </div>
                        <div class="section05-destination-bg"></div>
                        <p class="section05-destination-title translate" data-name-en="<?php echo esc_attr($name_en); ?>" 
                        data-name-jp="<?php echo esc_attr($name_jp); ?>"></p>
                    </div> 
                </a>
                <?php
            }
        } else {
            echo '<p>No destinations found.</p>';
        }
      ?>     
    </div>
    <div class="more-btn">
      <a href="<?php echo esc_url(get_post_type_archive_link('tours')); ?>" data-translate-key="See more">See more</a>
    </div>
  </section>
  <section class="section06 container">
    <h2 class="section-title" data-translate-key="More to explore">More to explore</h2>
    <div class="section06-explores">
      <div class="section06-explore">
        <div class="section06-explore-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/copywriting-concept-with-male-female-authors-writing-posts-laptop-creative-ideas-notepad-flat-vector-illustration_1284-84237.png" alt="">
        </div>
        <div class="section06-explore-desc">
          <div class="section06-explore-title" data-translate-key="Check out the our blog">Check out the our blog</div>
          <div class="section06-explore-desc-desc" data-translate-key="Follow the team">Follow the team's musings on trends in travel, 
          itinerary ideas and travel tips</div>
          <a href="" data-translate-key="Read now" class="section06-explore-link">Read now</a>
        </div>
      </div>
      <div class="section06-explore">
        <div class="section06-explore-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/Image 2.png" alt="">
        </div>
        <div class="section06-explore-desc">
          <div class="section06-explore-title" data-translate-key="Save on fun with credits">Save on fun with credits</div>
          <div class="section06-explore-desc-desc" data-translate-key="Find out how to save">Find out how to save more when you book and leave a review</div>
          <a href="" data-translate-key="How credits work" class="section06-explore-link">How credits work</a>
        </div>
      </div>
      <div class="section06-explore">
        <div class="section06-explore-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/antigravity-people-background_23-2148089686.png" alt="">
        </div>
        <div class="section06-explore-desc">
          <div class="section06-explore-title" data-translate-key="Share joy & get rewarded">Share joy & get rewarded</div>
          <div class="section06-explore-desc-desc" data-translate-key="After your friend signs up">After your friend signs up and completes a booking, you'll get a ¥500 reward!</div>
          <a href="" data-translate-key="Invite friends" class="section06-explore-link">Invite friends</a>
        </div>
      </div>
    </div>
  </section>
  <section class="section07 container">
    <h2 class="section-title" data-translate-key="Why choose">Why choose "company name"</h2>
    <div class="section07-choose">
      <div class="section07-reason">
        <div class="section07-reason-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/9414292.png" alt="">
        </div>
        <div class="section07-reason-title" data-translate-key="Discover the possibilities">
          Discover the possibilities
        </div>
        <div class="section07-reason-desc" data-translate-key="With nearly half">
          With nearly half a million attractions, 
          hotels & more, you're sure to find joy.
        </div>
      </div>
      <div class="section07-reason">
        <div class="section07-reason-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/5074602.png" alt="">
        </div>
        <div class="section07-reason-title" data-translate-key="Enjoy deals & delights">
          Enjoy deals & delights
        </div>
        <div class="section07-reason-desc" data-translate-key="Quality activities">
        Quality activities. Great prices. Plus, earn "c-name" credits to save more.
        </div>
      </div>
      <div class="section07-reason">
        <div class="section07-reason-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/6034571.png" alt="">
        </div>
        <div class="section07-reason-title" data-translate-key="Exploring made easy">
        Exploring made easy
        </div>
        <div class="section07-reason-desc" data-translate-key="Book last minute">
        Book last minute, skip lines & get free cancellation for easier exploring.
        </div>
      </div>
      <div class="section07-reason">
        <div class="section07-reason-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/15571466.png" alt="">
        </div>
        <div class="section07-reason-title" data-translate-key="Travel you can trust">
        Travel you can trust
        </div>
        <div class="section07-reason-desc" data-translate-key="Read reviews & get reliable">
        Read reviews & get reliable customer support. We're with you at every step.
        </div>
      </div>
    </div>
    <div class="section07-like">
      <div class="section07-title">
        <span data-translate-key="Was this page helpful?">
          Was this page helpful?
        </span>
        <div class="section07-buttons">
          <button>
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/10199574.png" alt="">
          </button>
          <button>
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/10199575.png" alt="">
          </button>
        </div>
      </div>
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