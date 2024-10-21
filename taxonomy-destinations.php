<?php get_header();
$term = get_queried_object();
$destination_name = $term->name;
$destination_name_en = get_field('name_en', $term) ?: $term->name;
$child_destinations = get_terms(array(
    'taxonomy' => 'destinations',  
    'child_of' => $term->term_id,  
    'hide_empty' => false, 
	'orderby' => 'count', 
    'order' => 'DESC',   
    'number' => 10,
));
$activities = get_terms(array(
    'taxonomy' => 'activity',
    'hide_empty' => false,
    'meta_query' => array(
        array(
            'key' => 'related_destination', 
             'value' => '"' . $term->term_id . '"',
            'compare' => 'LIKE'
        ),
    ),
    'orderby' => 'count', 
    'order' => 'DESC',   
    'number' => 10,
));
$meta_query = array('relation' => 'AND'); // Start with AND for all filters

$time_conditions = array();

if (!empty($_GET['time_of_day']) && is_array($_GET['time_of_day'])) {
    $time_of_days = $_GET['time_of_day'];

    foreach ($time_of_days as $time_of_day) {
        switch ($time_of_day) {
            case 'morning':
                $time_conditions = array_merge($time_conditions, array(
                    array('key' => 'tour_time', 'value' => '06:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '07:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '08:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '09:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '10:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '11:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '12:00 PM', 'compare' => 'LIKE'), // Corrected PM time
                ));
                break;

            case 'afternoon':
                $time_conditions = array_merge($time_conditions, array(
                    array('key' => 'tour_time', 'value' => '01:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '02:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '03:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '04:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '05:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '06:00 PM', 'compare' => 'LIKE'),
                ));
                break;

            case 'night':
                $time_conditions = array_merge($time_conditions, array(
                    array('key' => 'tour_time', 'value' => '07:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '08:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '09:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '10:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '11:00 PM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '12:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '01:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '02:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '03:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '04:00 AM', 'compare' => 'LIKE'),
                    array('key' => 'tour_time', 'value' => '05:00 AM', 'compare' => 'LIKE'),
                ));
                break;
        }
    }

    // If there are any time conditions, add them to the meta_query
    if (!empty($time_conditions)) {
        $meta_query[] = array(
            'relation' => 'OR',
            // Instead of wrapping, directly add time conditions
            ...$time_conditions  // Unpacks the array to add conditions individually
        );
    }
}


if (!empty($_GET['duration'])) {
    $durations = $_GET['duration']; 
    $duration_conditions = array();

    foreach ($durations as $duration) {
        switch ($duration) {
            case 'oneHour':
                $duration_conditions[] = array(
                   array(
				    'relation' => 'AND',
                    array(
                        'key'     => 'experience_time_max_time',
                        'value'   => 1,
                        'compare' => '<=',
                    ),
                    array(
                        'key'     => 'experience_time_option',
                        'value'   => 'hour',
                        'compare' => '=',
                    ),
				   )
                );
                break;

            case 'fourHour':
                $duration_conditions[] = array(
                    array(
					'relation' => 'AND',
                    array(
                        'key'     => 'experience_time_max_time',
                        'value'   => 1,
                        'compare' => '>=',
                    ),
                    array(
                        'key'     => 'experience_time_max_time',
                        'value'   => 4,
                        'compare' => '<=',
                    ),
                    array(
                        'key'     => 'experience_time_option',
                        'value'   => 'hour',
                        'compare' => '=',
                    ),
					)
                );
                break;

            case 'oneDay':
                $duration_conditions[] = array(
                    array(
					'relation' => 'AND',
					array(
                        'key'     => 'experience_time_max_time',
                        'value'   => 4,
                        'compare' => '>=',
                    ),
                    array(
                        'key'     => 'experience_time_option',
                        'value'   => 'hour',
                        'compare' => '=',
                    ),
					)
                );
                break;

            case 'threeDay':
                $duration_conditions[] = array(
                    array(
					'relation' => 'AND',
                    array(
                        'key'     => 'experience_time_max_time',
                        'value'   => 3,
                        'compare' => '<=',
                    ),
                    array(
                        'key'     => 'experience_time_option',
                        'value'   => 'day',
                        'compare' => '=',
                    ),
					)
                );
                break;

            case 'moreThreeDay':
                $duration_conditions[] = array(
                   array(
				    'relation' => 'AND',
                    array(
                        'key'     => 'experience_time_max_time',
                        'value'   => 3,
                        'compare' => '>',
                    ),
                    array(
                        'key'     => 'experience_time_option',
                        'value'   => 'day',
                        'compare' => '=',
                    ),
				   )
                );
                break;
        }
    }

    // Combine all duration conditions into a single OR relation
    if (!empty($duration_conditions)) {
        $meta_query[] = array(
            'relation' => 'OR',
            ...$duration_conditions  // Unpacks the array to add conditions individually
        );
    }
}

if (!empty($_GET['min_price']) && !empty($_GET['max_price'])) {
    $min_price = $_GET['min_price'];
    $max_price = $_GET['max_price'];

    if (!empty($min_price) && !empty($_GET['max_price'])) {
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'relation' => 'AND',
               array(
                'key'     => 'price_usd',
                'value'   => $min_price,
                'compare' => '>=',
               ),
               array(
                'key'     => 'price_usd',
                'value'   => $max_price,
                'compare' => '<=',
               )
            )  // Unpacks the array to add conditions individually
        );
    }
}

$tax_query = array();

$args = array(
    'post_type'      => 'tours',
    'posts_per_page' => -1,
    'tax_query'      => array(
        array(
            'taxonomy' => 'destinations',
            'field'    => 'slug',
            'terms'    => $term->slug, 
        ),
    ),
    'meta_query'     => $meta_query, // Use the meta query built above
);

$query = new WP_Query($args);
$tour_count = $query->found_posts;
$wp_query = $query;
?>

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
    <div class="tour-list container">
        <form id="tour-filters" method="GET" action="">
            <div class="filter-condition-container">
                <div class="filter-condition">
                    <div class="date-part">
                        <h2 class="date-part-title" data-translate-key="When are you traveling?">When are you traveling?
                        </h2>
                        <div class="date-selector">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/16390596.png" alt=""
                                class="date-icon">
                            <input type="text" name="daterange" value="<?php echo isset($_GET['daterange']) ? esc_attr($_GET['daterange']) : ''; ?>" class="daterange" />
                        </div>
                    </div>
                    <div class="filter-conditon-all">
                        <div class="filter-condition-item">
                            <h2 class="filter-condition-item-title" data-translate-key="Time of Day">Time of Day</h2>
                            <div class="filter-condition-item-subitem">
                                <label for="morning" class="checkbox">
                                    <input type="checkbox" name="time_of_day[]" value="morning" id="morning" <?php echo (isset($_GET['time_of_day']) && in_array('morning', $_GET['time_of_day'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="Morning">Morning</p>

                                </label>
                                <span class="filter-condition-item-sub-title-after"
                                    data-translate-key="Starts before 12pm">Starts before 12pm</span>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="afternoon" class="checkbox">
                                    <input type="checkbox" name="time_of_day[]" value="afternoon" id="afternoon" <?php echo (isset($_GET['time_of_day']) && in_array('afternoon', $_GET['time_of_day'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="Afternoon">Afternoon</p>

                                </label>
                                <span class="filter-condition-item-sub-title-after"
                                    data-translate-key="Starts after 12pm">Starts before 12pm</span>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="night" class="checkbox">
                                    <input type="checkbox" name="time_of_day[]" value="night" id="night" <?php echo (isset($_GET['time_of_day']) && in_array('night', $_GET['time_of_day'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="Evening and night">
                                        Evening and night</p>
                                </label>
                                <span class="filter-condition-item-sub-title-after"
                                    data-translate-key="Starts after 5pm">Starts after 5pm</span>
                            </div>
                        </div>
                        <div class="filter-condition-item">
                            <h2 class="filter-condition-item-title" data-translate-key="Duration">Duration</h2>
                            <div class="filter-condition-item-subitem">
                                <label for="oneHour" class="checkbox">
                                    <input type="checkbox" name="duration[]" value="oneHour" id="oneHour" <?php echo (isset($_GET['duration']) && in_array('oneHour', $_GET['duration'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="Up to 1 hour">Up to 1
                                        hour</p>
                                </label>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="fourHour" class="checkbox">
                                    <input type="checkbox" name="duration[]" value="fourHour" id="fourHour" <?php echo (isset($_GET['duration']) && in_array('fourHour', $_GET['duration'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="1 to 4 hours">1 to 4
                                        hours</p>

                                </label>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="oneDay" class="checkbox">
                                    <input type="checkbox" name="duration[]" value="oneDay" id="oneDay" <?php echo (isset($_GET['duration']) && in_array('oneDay', $_GET['duration'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="4 hours to 1 day">4 hours
                                        to 1 day</p>
                                </label>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="threeDay" class="checkbox">
                                    <input type="checkbox" name="duration[]" value="threeDay" id="threeDay" <?php echo (isset($_GET['duration']) && in_array('threeDay', $_GET['duration'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="1 to 3 days">1 to 3 days
                                    </p>
                                </label>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="moreThreeDay" class="checkbox">
                                    <input type="checkbox" name="duration[]" value="moreThreeDay" id="moreThreeDay" <?php echo (isset($_GET['duration']) && in_array('moreThreeDay', $_GET['duration'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="3+ days">3+ days</p>
                                </label>
                            </div>
                        </div>
                        <div class="filter-condition-item">
                            <h2 class="filter-condition-item-title" data-translate-key="Price">Price</h2>
                            <div class="filter-condition-item-subitem">
                                <div class="price-custom-wrapper">
                                    <div class="price-input-container">
                                        <div class="price-input">
                                            <div class="price-field">
                                                <span class="price-field-value"><span>$</span><span
                                                        data-translate-key="min">min</span></span>
                                                <input type="number" name="min_price" class="min-input" value="<?php echo isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : '0'; ?>">
                                            </div>
                                            <div class="price-field">
                                                <span class="price-field-value"><span>$</span><span
                                                        data-translate-key="max">max</span></span>
                                                <input type="number" name="max_price" class="max-input" value="<?php echo isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : '10000'; ?>">
                                            </div>
                                        </div>
                                        <div class="slider-container">
                                            <div class="price-slider">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" name="min_price" class="min-range" min="0" max="10000" value="<?php echo isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : '0'; ?>" step="1" id="min-range">
                                        <input type="range" name="max_price" class="max-range" min="0" max="10000" value="<?php echo isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : '10000'; ?>" step="1" id="max-range">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-condition-item">
                            <h2 class="filter-condition-item-title" data-translate-key="Rating">Rating</h2>
                            <button id="clearButton" class="clear-button" type="button" onclick="clearSelection()"
                                data-translate-key="Clear">Clear</button>
                            <div class="filter-condition-item-subitem">
                                <label for="rate01" class="radio">
                                    <input type="radio" name="rate" id="rate01" value="5" <?php echo (isset($_GET['rate']) && $_GET['rate'] == '5') ? 'checked' : ''; ?> onchange="toggleClearButton()">
                                    <span class="custom-radio"></span>
                                    <p class="filter-condition-item-sub-title-rate">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                                </label>
                                <label for="rate02" class="radio">
                                    <input type="radio" name="rate" id="rate02" value="4" <?php echo (isset($_GET['rate']) && $_GET['rate'] == '4') ? 'checked' : ''; ?> onchange="toggleClearButton()">
                                    <span class="custom-radio"></span>
                                    <p class="filter-condition-item-sub-title-rate">&#9733;&#9733;&#9733;&#9733;<span
                                            class="star-disable">&#9733;</span><span class="more-star"
                                            data-translate-key="moreStar">& up</span></p>
                                </label>
                                <label for="rate03" class="radio">
                                    <input type="radio" name="rate" id="rate03" value="3" <?php echo (isset($_GET['rate']) && $_GET['rate'] == '3') ? 'checked' : ''; ?> onchange="toggleClearButton()">
                                    <span class="custom-radio"></span>
                                    <p class="filter-condition-item-sub-title-rate">&#9733;&#9733;&#9733;<span
                                            class="star-disable">&#9733;&#9733;</span><span class="more-star"
                                            data-translate-key="moreStar">& up</span></p>
                                </label>
                            </div>
                        </div>
                        <div class="filter-condition-item">
                            <h2 class="filter-condition-item-title" data-translate-key="Specials">Specials</h2>
                            <div class="filter-condition-item-subitem">
                                <label for="discount" class="checkbox">
                                    <input type="checkbox" name="specials[]" value="discount" id="discount" <?php echo (isset($_GET['specials']) && in_array('discount', $_GET['specials'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="Deals & Discounts">Deals
                                        & Discounts</p>
                                </label>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="cancellation" class="checkbox">
                                    <input type="checkbox" name="specials[]" value="cancellation" id="cancellation" <?php echo (isset($_GET['specials']) && in_array('cancellation', $_GET['specials'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="Free Cancellation">Free
                                        Cancellation</p>
                                </label>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="sellOut" class="checkbox">
                                    <input type="checkbox" name="specials[]" value="sellOut" id="sellOut" <?php echo (isset($_GET['specials']) && in_array('sellOut', $_GET['specials'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="Likely to Sell Out">
                                        Likely to Sell Out</p>
                                </label>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="skipLine" class="checkbox">
                                    <input type="checkbox" name="specials[]" value="skipLine" id="skipLine" <?php echo (isset($_GET['specials']) && in_array('skipLine', $_GET['specials'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="Skip-The-Line">
                                        Skip-The-Line</p>
                                </label>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="privateTour" class="checkbox">
                                    <input type="checkbox" name="specials[]" value="privateTour" id="privateTour" <?php echo (isset($_GET['specials']) && in_array('privateTour', $_GET['specials'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="Private Tour">Private
                                        Tour</p>
                                </label>
                            </div>
                            <div class="filter-condition-item-subitem">
                                <label for="newViator" class="checkbox">
                                <input type="checkbox" name="specials[]" value="newViator" id="newViator" <?php echo (isset($_GET['specials']) && in_array('newViator', $_GET['specials'])) ? 'checked' : ''; ?>>
                                    <span class="custom-checkbox"></span>
                                    <p class="filter-condition-item-sub-title" data-translate-key="New on Viator">New on
                                        Viator</p>
                                </label>
                            </div>
                        </div>
                        <div class="filter-condition-item">
                            <h2 class="filter-condition-item-title" data-translate-key="All Japan Tours">All Japan Tours
                            </h2>
                            <div class="filter-condition-item-subitem marginbotton4">
                                <div class="filter-condition-item-subitem-category">
                                    <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                    <svg class="filter-condition-item-subitem-category-arrow" width="16" height="16"
                                        viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="icon__UJ21">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="filter-condition-item-subitem-category-sub">
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-condition-item-subitem marginbotton4">
                                <div class="filter-condition-item-subitem-category">
                                    <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                    <svg class="filter-condition-item-subitem-category-arrow" width="16" height="16"
                                        viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="icon__UJ21">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="filter-condition-item-subitem-category-sub">
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-condition-item-subitem marginbotton4">
                                <div class="filter-condition-item-subitem-category">
                                    <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                    <svg class="filter-condition-item-subitem-category-arrow" width="16" height="16"
                                        viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="icon__UJ21">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="filter-condition-item-subitem-category-sub">
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-condition-item-subitem marginbotton4">
                                <div class="filter-condition-item-subitem-category">
                                    <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                    <svg class="filter-condition-item-subitem-category-arrow" width="16" height="16"
                                        viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="icon__UJ21">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="filter-condition-item-subitem-category-sub">
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-condition-item-subitem marginbotton4">
                                <div class="filter-condition-item-subitem-category">
                                    <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                    <svg class="filter-condition-item-subitem-category-arrow" width="16" height="16"
                                        viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="icon__UJ21">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="filter-condition-item-subitem-category-sub">
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="filter-condition-item-subitem-category">
                                        <a href="" data-translate-key="Art & Culture">Art & Culture</a>
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            class="icon__UJ21">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.9 5.4c.2-.2.5-.2.7 0l4.15 4.14L11.9 5.4a.5.5 0 01.7.7l-4.5 4.5a.5.5 0 01-.7 0L2.9 6.1a.5.5 0 010-.7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form> 
        <div class="tour-result">
            <h2 class="tour-result-title">
                <span class="translate" data-name-en="Things to do in <?php echo esc_attr($destination_name_en); ?>" 
                data-name-jp="<?php echo esc_attr($destination_name); ?>でやるべきこと"><?php echo esc_attr($destination_name_en); ?></span>
                <div class="filter-condition-container-sp">
                    <div class="filter-condition-container-sp-button" id="toggle-filter-button">
                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="icon__UJ21"><path d="M8.06 5.5H2.5a.5.5 0 010-1h5.56a2 2 0 013.88 0h1.56a.5.5 0 010 1h-1.56a2 2 0 01-3.88 0zM7.94 10.5h5.56a.5.5 0 010 1H7.94a2 2 0 01-3.88 0H2.5a.5.5 0 010-1h1.56a2 2 0 013.88 0z"></path></svg>
                        <span>All filters</span>
                    </div>
                </div>
            </h2>            
            <div class="tour-result-summary">
                <span class="tour-result-summary-result-number"><?php echo esc_html($tour_count); ?></span>
                <span class="tour-result-summary-result" data-translate-key="Results">Results</span>
                <span>|</span>
                <span class="tour-result-summary-rate" data-translate-key="Rating:">Rating:</span>
                <span class="tour-result-summary-rate-score">4.8</span>
                <span class="tour-result-summary-star">
                    ★★★★<span class="star-disable">★</span>
                </span>
                <span class="tour-result-summary-review">1000</span>
                <span class="tour-result-summary-review" data-translate-key="(Reviews)"> (Reviews)</span>
                <button class="tour-result-summary-clear-button" data-translate-key="Clear all filters">Clear all
                    filters</button>
            </div>
            <div class="tour-result-slick-list">
                <div class="tour-result-slick-list-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.301" height="10.327" viewBox="0 0 12.301 10.327">
                        <path id="Path_7" data-name="Path 7"
                            d="M2356.427,638.742v4.912l-.294.21v1.973h12.3v-1.973l-.168-.21v-4.912l-2.771,3.484-2.393-4.492.252-.252v-1.091l-1.008-.882-1.008.882v1.091l.21.252-2.309,4.492Z"
                            transform="translate(-2356.133 -635.51)" fill="#212121" />
                    </svg>
					<span class="translate" data-name-en="<?php echo esc_attr($destination_name_en); ?>'s popular activity" 
                data-name-jp="<?php echo esc_attr($destination_name); ?>で人気のアクティビティ"><?php echo esc_attr($destination_name_en); ?></span>
                </div>
                <div class="tour-result-slick-list-desc">
                    <?php
                        if (!empty($activities)) {
                            foreach ($activities as $activity) {
                                // Get the custom field 'name_en' (assuming you're using ACF for this)
                                $activity_name_en = get_field('name_en', $activity);
                                // Use the default term name for Japanese (or from another custom field if available)
                                $activity_name_jp = $activity->name;

                                // Output each activity with both English and Japanese names
                                echo '<li><a href="' . esc_url(get_term_link($activity)) . '" data-name-en="' . esc_attr($activity_name_en) . '" 
                                    data-name-jp="' . esc_attr($activity_name_jp) . '" class="translate">' . esc_html($activity_name_en) . '</a></li>';
                            }
                        } else {
                            echo '<p data-translate-key="No activities found for this destination.">No activities found for this destination.</p>';
                        }
                    ?>                 
                </div>
            </div>
            <div class="tour-result-slick-list">
				<?php 
					if (!empty($child_destinations) && !is_wp_error($child_destinations)) :
						echo '<div class="tour-result-slick-list-title">
							<svg xmlns="http://www.w3.org/2000/svg" width="12.301" height="10.327" viewBox="0 0 12.301 10.327">
								<path id="Path_7" data-name="Path 7"
									d="M2356.427,638.742v4.912l-.294.21v1.973h12.3v-1.973l-.168-.21v-4.912l-2.771,3.484-2.393-4.492.252-.252v-1.091l-1.008-.882-1.008.882v1.091l.21.252-2.309,4.492Z"
									transform="translate(-2356.133 -635.51)" fill="#212121" />
							</svg>
							<span class="translate" data-name-en="' . esc_attr($destination_name_en) . '\'s popular area" 
							data-name-jp="' . esc_attr($destination_name) . '的に人気のエリア">' . esc_html($destination_name_en) . '</span>
							</div>';

						echo '<div class="tour-result-slick-list-desc">';
						foreach ($child_destinations as $child) {
							$child_name_en = get_field('name_en', $child) ?: $child->name;  // Assuming you have 'name_en' custom field
							$child_name_jp = $child->name;

							// Output each child destination with a link and translated name
							echo '<li><a href="' . esc_url(get_term_link($child)) . '" data-name-en="' . esc_attr($child_name_en) . '" data-name-jp="' . esc_attr($child_name_jp) . '" class="translate">' 
								. esc_html($child_name_en) . '</a></li>';
						}
						echo '</div>';
					else :
						echo '';
					endif;
				?>
			</div>
            <div class="tour-result-summary-list-buttons">
                <div class="tour-result-summary-list-button">
                    Nationwide
                    <svg xmlns="http://www.w3.org/2000/svg" width="10.707" height="20.207" viewBox="0 0 10.707 20.207">
                        <g id="Group_7" data-name="Group 7" transform="translate(0.354 0.354)">
                            <line id="Line_155" data-name="Line 155" x2="10" y2="10" fill="none"
                                stroke="rgba(0,0,0,0.4)" stroke-width="1" />
                            <line id="Line_156" data-name="Line 156" x1="10" y2="10" transform="translate(0 9.5)"
                                fill="none" stroke="rgba(0,0,0,0.4)" stroke-width="1" />
                        </g>
                    </svg>
                </div>
                <div class="tour-result-summary-list-button">
                    Activites
                    <svg xmlns="http://www.w3.org/2000/svg" width="10.707" height="20.207" viewBox="0 0 10.707 20.207">
                        <g id="Group_7" data-name="Group 7" transform="translate(0.354 0.354)">
                            <line id="Line_155" data-name="Line 155" x2="10" y2="10" fill="none"
                                stroke="rgba(0,0,0,0.4)" stroke-width="1" />
                            <line id="Line_156" data-name="Line 156" x1="10" y2="10" transform="translate(0 9.5)"
                                fill="none" stroke="rgba(0,0,0,0.4)" stroke-width="1" />
                        </g>
                    </svg>
                </div>
                <div class="tour-result-summary-list-button">
                    Schedule
                    <svg xmlns="http://www.w3.org/2000/svg" width="10.707" height="20.207" viewBox="0 0 10.707 20.207">
                        <g id="Group_7" data-name="Group 7" transform="translate(0.354 0.354)">
                            <line id="Line_155" data-name="Line 155" x2="10" y2="10" fill="none"
                                stroke="rgba(0,0,0,0.4)" stroke-width="1" />
                            <line id="Line_156" data-name="Line 156" x1="10" y2="10" transform="translate(0 9.5)"
                                fill="none" stroke="rgba(0,0,0,0.4)" stroke-width="1" />
                        </g>
                    </svg>
                </div>
            </div>
            <div class="tour-result-tour-list">
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php
                        $images = get_field('images');
                        if (!empty($images) && is_array($images)) {
                        $first_image = $images['image_01'];
                        $first_image_url = isset($first_image['url']) ? esc_url($first_image['url']) : get_template_directory_uri() . '/assets/img/d7 (1).png';
                        } else {
                        $first_image_url = get_template_directory_uri() . '/assets/img/d7 (1).png';
                        }
                        $title_en = get_the_title();
                        $title_jp = get_field('title_jp');
                        $overView_jp = get_field('content_jp');
                        $overView_en = get_the_content();
                        $price = get_field('price');
                        $price_usd = $price['usd'];
                        $price_jpy = $price['jpy'];
                        $experienceTime = get_field('experience_time');
                        $minTime = $experienceTime['min_time'];
                        $maxTime = $experienceTime['max_time'];
                        $timeOption = $experienceTime['option'];
                        $free_cancellation = get_field('free_cancellation')
                    ?>
                    <a href="<?php the_permalink(); ?>" class="block">
                        <div class="tour-result-tour-list-item">
                            <div class="tour-item-img">                                
                                <img src="<?php echo $first_image_url; ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            </div>
                            <div class="tour-item-desc">
                                <div class="tour-item-desc-header">
                                    <h2 class="translate" data-name-en="<?php echo esc_attr($title_en); ?>" data-name-jp="<?php echo esc_attr($title_jp); ?>">
                                        <?php echo esc_attr($title_en); ?>
                                    </h2>
                                    <div class="tour-item-desc-header-price">
                                        <p data-translate-key="From">From</p>
                                        <p class="tour-item-from-price tour-currency" data-price-usd="<?php echo esc_attr($price_usd); ?>"
                                        data-price-jpy="<?php echo esc_attr($price_jpy); ?>"> ¥ <?php echo esc_html($price_jpy); ?></p>
                                        <p data-translate-key="per group">per group</p>
                                    </div>
                                </div>
                                <div class="tour-item-desc-star">
                                    <span class="tour-item-desc-star-active">★★★★★</span>
                                    <span>1</span>
                                </div>
                                <div class="tour-item-desc-overview translate" data-name-en="<?php echo esc_attr($overView_en); ?>" data-name-jp="<?php echo esc_attr($overView_jp); ?>">
                                    <?php echo esc_html($overView_jp); ?>
                                </div>
                                <div class="tour-item-desc-time">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                    <span><?php echo esc_attr($maxTime); ?><span data-translate-key="<?php echo esc_attr($timeOption); ?>"><?php echo esc_attr($timeOption); ?></span></span>
                                </div>
                                <?php 
                                    if($free_cancellation === true) 
                                        echo '<div class="tour-item-desc-category">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                        <g id="Group_17" data-name="Group 17" transform="translate(-748 -696)">
                                            <g id="Ellipse_4" data-name="Ellipse 4" transform="translate(748 696)"
                                                fill="#fff" stroke="#212121" stroke-width="1">
                                                <circle cx="7.5" cy="7.5" r="7.5" stroke="none" />
                                                <circle cx="7.5" cy="7.5" r="7" fill="none" />
                                            </g>
                                            <line id="Line_160" data-name="Line 160" x2="2.5" y2="2"
                                                transform="translate(752.5 704.5)" fill="none" stroke="#212121"
                                                stroke-width="1" />
                                            <line id="Line_161" data-name="Line 161" x1="5" y2="5"
                                                transform="translate(754.5 701.5)" fill="none" stroke="#212121"
                                                stroke-width="1" />
                                        </g>
                                    </svg>
                                    <span data-translate-key="Free Cancellation" >Free Cancellation</span>
                                </div>';                                    
                                ?>
                                
                            </div>
                        </div>
                    </a>  
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p data-translate-key="No tours found for this destination.">No tours found for this destination.</p>
                <?php endif; ?>              
            </div>
        </div>
    </div>
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
            <a href="" data-translate-key="See more">See more</a>
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

<?php get_footer()?>