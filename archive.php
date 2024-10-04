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
    <div class="tour-list container">
        <div class="filter-condition-container">
            <div class="filter-condition">
                <div class="date-part">
                    <h2 class="date-part-title" data-translate-key="When are you traveling?">When are you traveling?
                    </h2>
                    <div class="date-selector">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/16390596.png" alt=""
                            class="date-icon">
                        <input type="text" name="daterange" value="" class="daterange" />
                    </div>
                </div>
                <div class="filter-conditon-all">
                    <div class="filter-condition-item">
                        <h2 class="filter-condition-item-title" data-translate-key="Time of Day">Time of Day</h2>
                        <div class="filter-condition-item-subitem">
                            <label for="morning" class="checkbox">
                                <input type="checkbox" name="morning" id="morning">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="Morning">Morning</p>

                            </label>
                            <span class="filter-condition-item-sub-title-after"
                                data-translate-key="Starts before 12pm">Starts before 12pm</span>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="afternoon" class="checkbox">
                                <input type="checkbox" name="afternoon" id="afternoon">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="Afternoon">Afternoon</p>

                            </label>
                            <span class="filter-condition-item-sub-title-after"
                                data-translate-key="Starts after 12pm">Starts before 12pm</span>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="night" class="checkbox">
                                <input type="checkbox" name="night" id="night">
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
                                <input type="checkbox" name="oneHour" id="oneHour">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="Up to 1 hour">Up to 1
                                    hour</p>
                            </label>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="fourHour" class="checkbox">
                                <input type="checkbox" name="fourHour" id="fourHour">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="1 to 4 hours">1 to 4
                                    hours</p>

                            </label>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="oneDay" class="checkbox">
                                <input type="checkbox" name="oneDay" id="oneDay">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="4 hours to 1 day">4 hours
                                    to 1 day</p>
                            </label>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="threeDay" class="checkbox">
                                <input type="checkbox" name="threeDay" id="threeDay">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="1 to 3 days">1 to 3 days
                                </p>
                            </label>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="moreThreeDay" class="checkbox">
                                <input type="checkbox" name="moreThreeDay" id="moreThreeDay">
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
                                            <span class="price-field-value"><span>¥</span><span
                                                    data-translate-key="min">min</span></span>
                                            <input type="number" class="min-input" value="0">
                                        </div>
                                        <div class="price-field">
                                            <span class="price-field-value"><span>¥</span><span
                                                    data-translate-key="max">max</span></span>
                                            <input type="number" class="max-input" value="10000">
                                        </div>
                                    </div>
                                    <div class="slider-container">
                                        <div class="price-slider">
                                        </div>
                                    </div>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="min-range" min="0" max="10000" value="0" step="1">
                                    <input type="range" class="max-range" min="0" max="10000" value="10000" step="1">
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
                                <input type="radio" name="rate" id="rate01" onchange="toggleClearButton()">
                                <span class="custom-radio"></span>
                                <p class="filter-condition-item-sub-title-rate">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                            </label>
                            <label for="rate02" class="radio">
                                <input type="radio" name="rate" id="rate02" onchange="toggleClearButton()">
                                <span class="custom-radio"></span>
                                <p class="filter-condition-item-sub-title-rate">&#9733;&#9733;&#9733;&#9733;<span
                                        class="star-disable">&#9733;</span><span class="more-star"
                                        data-translate-key="moreStar">& up</span></p>
                            </label>
                            <label for="rate03" class="radio">
                                <input type="radio" name="rate" id="rate03" onchange="toggleClearButton()">
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
                                <input type="checkbox" name="discount" id="discount">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="Deals & Discounts">Deals
                                    & Discounts</p>
                            </label>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="cancellation" class="checkbox">
                                <input type="checkbox" name="cancellation" id="cancellation">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="Free Cancellation">Free
                                    Cancellation</p>
                            </label>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="sellOut" class="checkbox">
                                <input type="checkbox" name="sellOut" id="sellOut">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="Likely to Sell Out">
                                    Likely to Sell Out</p>
                            </label>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="Skip-The-Line" class="checkbox">
                                <input type="checkbox" name="Skip-The-Line" id="Skip-The-Line">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="Skip-The-Line">
                                    Skip-The-Line</p>
                            </label>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="privateTour" class="checkbox">
                                <input type="checkbox" name="privateTour" id="privateTour">
                                <span class="custom-checkbox"></span>
                                <p class="filter-condition-item-sub-title" data-translate-key="Private Tour">Private
                                    Tour</p>
                            </label>
                        </div>
                        <div class="filter-condition-item-subitem">
                            <label for="newViator" class="checkbox">
                                <input type="checkbox" name="newViator" id="newViator">
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
        <div class="tour-result">
            <h2 class="tour-result-title">
                Things to do in Japan
                <div class="filter-condition-container-sp">
                    <div class="filter-condition-container-sp-button" id="toggle-filter-button">
                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="icon__UJ21"><path d="M8.06 5.5H2.5a.5.5 0 010-1h5.56a2 2 0 013.88 0h1.56a.5.5 0 010 1h-1.56a2 2 0 01-3.88 0zM7.94 10.5h5.56a.5.5 0 010 1H7.94a2 2 0 01-3.88 0H2.5a.5.5 0 010-1h1.56a2 2 0 013.88 0z"></path></svg>
                        <span>All filters</span>
                    </div>
                </div>
            </h2>            
            <div class="tour-result-summary">
                <span class="tour-result-summary-result-number">1000</span>
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
                    <span data-translate-key="Nationwide's popular activity TOP 10">
                        Nationwide's popular activity TOP 10
                    </span>
                </div>
                <div class="tour-result-slick-list-desc">
                    <li>
                        <a href="" data-translate-key="Blacksmith experience">1：Blacksmith experience</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="2：Guided tour">2：Guided tour</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="3：Blacksmith experience">3：Blacksmith experience</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="4：Guided tour">4：Guided tour</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="5：Blacksmith experience">5：Blacksmith experience</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="6：Guided tour">6：Guided tour</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="7：Blacksmith experience">7：Blacksmith experience</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="8：Blacksmith experience">8：Blacksmith experience</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="9：Blacksmith experience">9：Blacksmith experience</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="10：Blacksmith experience">10：Blacksmith experience</a>
                    </li>
                </div>
            </div>
            <div class="tour-result-slick-list">
                <div class="tour-result-slick-list-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.301" height="10.327" viewBox="0 0 12.301 10.327">
                        <path id="Path_7" data-name="Path 7"
                            d="M2356.427,638.742v4.912l-.294.21v1.973h12.3v-1.973l-.168-.21v-4.912l-2.771,3.484-2.393-4.492.252-.252v-1.091l-1.008-.882-1.008.882v1.091l.21.252-2.309,4.492Z"
                            transform="translate(-2356.133 -635.51)" fill="#212121" />
                    </svg>
                    <span data-translate-key="Nationwide's popular area">
                        Nationwide's popular area
                    </span>
                </div>
                <div class="tour-result-slick-list-desc">
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                    <li>
                        <a href="" data-translate-key="1：Tokyo">1：Tokyo</a>
                    </li>
                </div>
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
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    Essential tour for fashion and art in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    Essential tour for fashion and art in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    Essential tour for fashion and art in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    Essential tour for fashion and art in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    Essential tour for fashion and art in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    Essential tour for fashion and art in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    Essential tour for fashion and art in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    Essential tour for fashion and art in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="block">
                    <div class="tour-result-tour-list-item">
                        <div class="tour-item-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/d7 (1).png" alt="">
                        </div>
                        <div class="tour-item-desc">
                            <div class="tour-item-desc-header">
                                <h2>
                                    Essential tour for fashion and art in Tokyo for 6 hours with local lunch
                                </h2>
                                <div class="tour-item-desc-header-price">
                                    <p>From</p>
                                    <p class="tour-item-from-price">¥66,472</p>
                                    <p>per group</p>
                                </div>
                            </div>
                            <div class="tour-item-desc-star">
                                <span class="tour-item-desc-star-active">★★★★★</span>
                                <span>1</span>
                            </div>
                            <div class="tour-item-desc-overview">
                                If you like to eat where locals eat—rather than international chains and tourist
                                hotspots—then this Nagoya food tour is the one for you. No worries if you have any
                                particular food preferences, as the tour is private and
                            </div>
                            <div class="tour-item-desc-time">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/set_of_glyph_clocks.png" alt="">
                                <span>6<span>hours</span></span>
                            </div>
                            <div class="tour-item-desc-category">
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
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <section class="section02 container">
        <h2 class="section02-title" data-translate-key="Travelers' favorite choice">Travelers' favorite choice</h2>
        <div class="section02-slider">
            <div class="section02-slider-container">
                <div class="section02-tours">
                    <div class="section02-tour">
                        <div class="section02-tour-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/ezgif-7-594f91690c.png"
                                alt="">
                        </div>
                        <div class="section02-tour-desc">
                            <div class="section02-tour-title">item-subttl·Tokyo</div>
                            <div class="section02-tour-content">Item-main-title item-main Japan Item-main-title
                                item-main Japan</div>
                            <div class="section02-tour-tag">Bestseller</div>
                            <div class="section02-tour-review"><span class="section02-star">★ 4.6</span> (6,000) • 100K+
                                booked</div>
                            <div class="section02-tour-price">From ¥ 5,958</div>
                        </div>
                    </div>
                    <div class="section02-tour">
                        <div class="section02-tour-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/ezgif-7-594f91690c.png"
                                alt="">
                        </div>
                        <div class="section02-tour-desc">
                            <div class="section02-tour-title">item-subttl·Tokyo</div>
                            <div class="section02-tour-content">Item-main-title item-main Japan Item-main-title
                                item-main Japan</div>
                            <div class="section02-tour-tag">Bestseller</div>
                            <div class="section02-tour-review"><span class="section02-star">★ 4.6</span> (6,000) • 100K+
                                booked</div>
                            <div class="section02-tour-price">From ¥ 5,958</div>
                        </div>
                    </div>
                    <div class="section02-tour">
                        <div class="section02-tour-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/ezgif-7-594f91690c.png"
                                alt="">
                        </div>
                        <div class="section02-tour-desc">
                            <div class="section02-tour-title">item-subttl·Tokyo</div>
                            <div class="section02-tour-content">Item-main-title item-main Japan Item-main-title
                                item-main Japan</div>
                            <div class="section02-tour-tag">Bestseller</div>
                            <div class="section02-tour-review"><span class="section02-star">★ 4.6</span> (6,000) • 100K+
                                booked</div>
                            <div class="section02-tour-price">From ¥ 5,958</div>
                        </div>
                    </div>
                    <div class="section02-tour">
                        <div class="section02-tour-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/ezgif-7-594f91690c.png"
                                alt="">
                        </div>
                        <div class="section02-tour-desc">
                            <div class="section02-tour-title">item-subttl·Tokyo</div>
                            <div class="section02-tour-content">Item-main-title item-main Japan Item-main-title
                                item-main Japan</div>
                            <div class="section02-tour-tag">Bestseller</div>
                            <div class="section02-tour-review"><span class="section02-star">★ 4.6</span> (6,000) • 100K+
                                booked</div>
                            <div class="section02-tour-price">From ¥ 5,958</div>
                        </div>
                    </div>
                    <div class="section02-tour">
                        <div class="section02-tour-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/ezgif-7-594f91690c.png"
                                alt="">
                        </div>
                        <div class="section02-tour-desc">
                            <div class="section02-tour-title">item-subttl·Tokyo</div>
                            <div class="section02-tour-content">Item-main-title item-main Japan Item-main-title
                                item-main Japan</div>
                            <div class="section02-tour-tag">Bestseller</div>
                            <div class="section02-tour-review"><span class="section02-star">★ 4.6</span> (6,000) • 100K+
                                booked</div>
                            <div class="section02-tour-price">From ¥ 5,958</div>
                        </div>
                    </div>
                    <div class="section02-tour">
                        <div class="section02-tour-img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/ezgif-7-594f91690c.png"
                                alt="">
                        </div>
                        <div class="section02-tour-desc">
                            <div class="section02-tour-title">item-subttl·Tokyo</div>
                            <div class="section02-tour-content">Item-main-title item-main Japan Item-main-title
                                item-main Japan</div>
                            <div class="section02-tour-tag">Bestseller</div>
                            <div class="section02-tour-review"><span class="section02-star">★ 4.6</span> (6,000) • 100K+
                                booked</div>
                            <div class="section02-tour-price">From ¥ 5,958</div>
                        </div>
                    </div>
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