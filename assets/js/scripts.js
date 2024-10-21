document.addEventListener('DOMContentLoaded', function() {
    const languageBtn = document.getElementById('language-btn');
    const languageOptions = document.getElementById('language-options');

    // Show/hide dropdown on button click
    languageBtn.addEventListener('click', function() {
        languageOptions.classList.toggle('hidden');
    });

    // Handle language selection
    const languageItems = document.querySelectorAll('.language-option');
    languageItems.forEach(item => {
        item.addEventListener('click', function() {
            const selectedLanguage = item.getAttribute('data-language');
            setLanguage(selectedLanguage);
            languageOptions.classList.add('hidden');
        });
    });

    document.addEventListener('click', function(event) {
        if (!languageOptions.classList.contains('hidden') && !languageBtn.contains(event.target)) {
            languageOptions.classList.add('hidden');
        }
    });

    // Function to change language
    function setLanguage(language) {
        sessionStorage.setItem('language', language);
        applyLanguage(language); // Apply immediately without reloading
    }

    // Function to apply the selected language
    function applyLanguage(language) {
        const lang = sessionStorage.getItem('language') || 'en'; // Default to 'en'
        fetch(`/wp-content/themes/wildtour/languages/${lang}.json`)
            .then(response => response.json())
            .then(translations => {
                document.documentElement.lang = lang;
                // Apply translations to your page
                document.querySelectorAll('[data-translate-key]').forEach(element => {
                    const key = element.getAttribute('data-translate-key');
                    const translation = translations[key] || key;

                    if (element.tagName === 'INPUT' && element.hasAttribute('placeholder')) {
                        element.setAttribute('placeholder', translation);
                    } else {
                        element.textContent = translation;
                    }
                });
            })
            .catch(error => console.error('Error loading translations:', error));
            document.querySelectorAll('.translate').forEach(element => {
                const text = element.getAttribute(`data-name-${lang}`); 
                if (text) {
                   element.innerHTML = text;
                }
            });
    }

    
    applyLanguage(sessionStorage.getItem('language'));
});

// currency

document.addEventListener('DOMContentLoaded', function() {
    const currencyBtn = document.getElementById('currency-btn');
    const selectedCurrencyDisplay = document.getElementById('selected-currency');
    const currencyOptions = document.getElementById('currency-options');

    // Show/hide dropdown on button click
    currencyBtn.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent immediate dropdown closing
        currencyOptions.classList.toggle('hidden');
    });

    // Handle currency selection
    const currencyItems = document.querySelectorAll('.currency-option');
    currencyItems.forEach(item => {
        item.addEventListener('click', function() {
            const selectedCurrency = item.getAttribute('data-currency');
            setCurrency(selectedCurrency);

            // Update the button with the selected currency
            selectedCurrencyDisplay.textContent = selectedCurrency;
            
            // Hide the dropdown after selection
            currencyOptions.classList.add('hidden');
        });
    });

    // Close the dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!currencyOptions.classList.contains('hidden') && !currencyBtn.contains(event.target)) {
            currencyOptions.classList.add('hidden');
        }
    });

    // Function to set the selected currency and save it in sessionStorage
    function setCurrency(currency) {
        sessionStorage.setItem('currency', currency);
        applyCurrency(currency); // Apply immediately
    }

    // Function to apply the selected currency to the page
    function applyCurrency(currency) {
        const prices = document.querySelectorAll('.tour-currency');
        prices.forEach(price => {
            const priceJpy = price.getAttribute('data-price-jpy');
            const priceUsd = price.getAttribute('data-price-usd');

            if (currency === 'USD') {
                price.textContent = `$ ${priceUsd}`;
            } else {
                price.textContent = `¥ ${priceJpy}`;
            }
        });
    }
    // On page load, apply the saved currency
    applyCurrency(sessionStorage.getItem('currency') || 'JPY');
});


// slider

const slider = document.querySelector('.image-slider');
const slides = document.querySelectorAll('.slide');
let currentIndex = 0;

// Only run slider logic if the slider element exists on the page
if (slider && slides.length > 0) {
    // Function to update slider position
    function updateSlider() {
        const offset = -currentIndex * 100;
        slider.style.transform = `translateX(${offset}%)`;
    }

    // Move to the next slide
    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlider();
    }

    // Auto-slide every 5 seconds
    setInterval(nextSlide, 5000);

    // Manual control for next and previous buttons
    const nextButton = document.querySelector('.fv-next');
    const prevButton = document.querySelector('.fv-prev');

    if (nextButton) {
        nextButton.addEventListener('click', nextSlide);
    }

    if (prevButton) {
        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateSlider();
        });
    }
}

// section02-tours slider

const tourSlider = document.querySelector('.section02-tours');
const nextTourButton = document.querySelector('.section02-next');
const prevTourButton = document.querySelector('.section02-prev');
const totalSlides = document.querySelectorAll('.section02-tour').length;
let tourCurrentIndex = 0;

// Only run tour slider logic if the tour slider element exists on the page
if (tourSlider && totalSlides > 0) {
    // Get the width of a single slide, including the gap (assuming 20px gap)
    const itemWidth = tourSlider.querySelector('.section02-tour').offsetWidth + 20;

    if (nextTourButton) {
        nextTourButton.addEventListener('click', () => {
            tourCurrentIndex++;
            // Check if the current index exceeds the total slides
            if (tourCurrentIndex >= totalSlides) {
                tourCurrentIndex = 0; // Loop back to the first slide
            }
            tourSlider.style.transition = 'transform 0.3s ease-in-out';
            tourSlider.style.transform = `translateX(-${tourCurrentIndex * itemWidth}px)`;
        });
    }

    if (prevTourButton) {
        prevTourButton.addEventListener('click', () => {
            tourCurrentIndex--;
            // Check if the current index is less than 0
            if (tourCurrentIndex < 0) {
                tourCurrentIndex = totalSlides - 1; // Loop back to the last slide
            }
            tourSlider.style.transition = 'transform 0.3s ease-in-out';
            tourSlider.style.transform = `translateX(-${tourCurrentIndex * itemWidth}px)`;
        });
    }
}

$(document).ready(function() {
    const $destinations = $('.section05-destinations');

    $destinations.on('wheel', function(event) {
        event.preventDefault(); // Prevent the default vertical scroll
        this.scrollLeft += event.originalEvent.deltaY; // Scroll horizontally based on vertical scroll
    });
});



$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    $('input[name="daterange"]').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
    $('#tour-filters').submit();
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});

const rangevalue = 
    document.querySelector(".slider-container .price-slider");
const rangeInputvalue = 
    document.querySelectorAll(".range-input input");

// Set the price gap
let priceGap = 500;

// Adding event listners to price input elements
const priceInputvalue = 
    document.querySelectorAll(".price-input input");
for (let i = 0; i < priceInputvalue.length; i++) {
    priceInputvalue[i].addEventListener("input", e => {

        // Parse min and max values of the range input
        let minp = parseInt(priceInputvalue[0].value);
        let maxp = parseInt(priceInputvalue[1].value);
        let diff = maxp - minp

        if (minp < 0) {
            alert("minimum price cannot be less than 0");
            priceInputvalue[0].value = 0;
            minp = 0;
        }

        // Validate the input values
        if (maxp > 10000) {
            alert("maximum price cannot be greater than 10000");
            priceInputvalue[1].value = 10000;
            maxp = 10000;
        }

        if (minp > maxp - priceGap) {
            priceInputvalue[0].value = maxp - priceGap;
            minp = maxp - priceGap;

            if (minp < 0) {
                priceInputvalue[0].value = 0;
                minp = 0;
            }
        }

        // Check if the price gap is met 
        // and max price is within the range
        if (diff >= priceGap && maxp <= rangeInputvalue[1].max) {
            if (e.target.className === "min-input") {
                rangeInputvalue[0].value = minp;
                let value1 = rangeInputvalue[0].max;
                rangevalue.style.left = `${(minp / value1) * 100}%`;
            }
            else {
                rangeInputvalue[1].value = maxp;
                let value2 = rangeInputvalue[1].max;
                rangevalue.style.right = 
                    `${100 - (maxp / value2) * 100}%`;
            }
        }
    });

    // Add event listeners to range input elements
    for (let i = 0; i < rangeInputvalue.length; i++) {
        rangeInputvalue[i].addEventListener("input", e => {
            let minVal = 
                parseInt(rangeInputvalue[0].value);
            let maxVal = 
                parseInt(rangeInputvalue[1].value);

            let diff = maxVal - minVal
            
            // Check if the price gap is exceeded
            if (diff < priceGap) {
            
                // Check if the input is the min range input
                if (e.target.className === "min-range") {
                    rangeInputvalue[0].value = maxVal - priceGap;
                }
                else {
                    rangeInputvalue[1].value = minVal + priceGap;
                }
            }
            else {
            
                // Update price inputs and range progress
                priceInputvalue[0].value = minVal;
                priceInputvalue[1].value = maxVal;
                rangevalue.style.left =
                    `${(minVal / rangeInputvalue[0].max) * 100}%`;
                rangevalue.style.right =
                    `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`;
            }
        });
    }
}

function toggleClearButton() {
    const radios = document.querySelectorAll('input[name="rate"]');
    const clearButton = document.getElementById('clearButton');

    let isAnyChecked = false;
    radios.forEach((radio) => {
      if (radio.checked) {
        isAnyChecked = true;
      }
    });

    // Show clear button if any radio is checked, otherwise hide it
    clearButton.style.display = isAnyChecked ? 'block' : 'none';
  }

  function clearSelection() {
    const radios = document.querySelectorAll('input[name="rate"]');
    radios.forEach((radio) => {
      radio.checked = false;
    });

    // Hide the clear button after clearing the selection
    document.getElementById('clearButton').style.display = 'none';
}

const arrowElements = document.querySelectorAll('.filter-condition-item-subitem-category-arrow');

arrowElements.forEach(arrow => {
    arrow.addEventListener('click', function() {
      // Find the nearest sub-category element to toggle the class
      const subCategory = this.closest('.filter-condition-item-subitem').querySelector('.filter-condition-item-subitem-category-sub');
      
      // Toggle the 'show' class
      if (subCategory) {
        subCategory.classList.toggle('show');
      }
    });
});

$(document).ready(function() {
    const $sliderContainer = $(".tour-detail-slider-container");
    const $sliderImages = $(".tour-detail-slider-img");
    const $thumbnailImages = $(".tour-detail-slider-bar-img");
    const $leftArrow = $(".tour-detail-slider-left-arrow");
    const $rightArrow = $(".tour-detail-slider-right-arrow");
    let currentSlide = 0;
    const totalSlides = $sliderImages.length;

    // Function to update the slider position
    function updateSliderPosition() {
        const translateXValue = -100 * currentSlide; // Moves container to the left
        $sliderContainer.css("transform", `translateX(${translateXValue}%)`);

        // Update active class for thumbnails
        $thumbnailImages.removeClass("active");
        $thumbnailImages.eq(currentSlide).addClass("active");
    }

    // Event listener for thumbnail clicks
    $thumbnailImages.each(function(index) {
        $(this).on("click", function() {
            currentSlide = index;
            updateSliderPosition();
        });
    });

    // Left Arrow Event
    $leftArrow.on("click", function() {
        currentSlide = (currentSlide === 0) ? totalSlides - 1 : currentSlide - 1;
        updateSliderPosition();
    });

    // Right Arrow Event
    $rightArrow.on("click", function() {
        currentSlide = (currentSlide === totalSlides - 1) ? 0 : currentSlide + 1;
        updateSliderPosition();
    });
});


const tourDetailSectionArrow = document.querySelectorAll('.tour-detail-section-arrow-icon');

tourDetailSectionArrow.forEach(arrow => {
    arrow.addEventListener('click', function() {
      // Find the nearest sub-category element to toggle the class
      arrow.classList.toggle('active')
      const content = this.closest('.tour-detail-section').querySelector('.tour-detail-section-desc');
      
      // Toggle the 'show' class
      if (content) {
        content.classList.toggle('show');
      }
    });
});

$(function() {
    $('input[name="datepicker"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: parseInt(moment().format('YYYY'),10),
      maxYear: 9999
    }, function(start, end, label) {
      console.log(start.format('YYYY-MM-DD'))
    });
  });

  $(function() {
    $('input[name="birthday"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 1901,
      maxYear: parseInt(moment().format('YYYY'),10)
    }, function(start, end, label) {
      var years = moment().diff(start, 'years');
    //   alert("You are " + years + " years old!");
    });
  });

  $(document).ready(function() {
    $('.filter-condition-container-sp-button').click(function() {
      $('.filter-condition-container').toggleClass('show');
    });
  });

  $(document).ready(function() {
    $('#navItemUser').click(function(event) {
        event.preventDefault();
        $('#navSubItem').toggle(); // Toggle the visibility of the dropdown menu
    });

    // Close dropdown if clicked outside
    $(document).click(function(event) {
        if (!$(event.target).closest('#navItemUser, #navSubItem').length) {
            $('#navSubItem').hide(); // Hide the dropdown if the click was outside
        }
    });
});

jQuery(document).ready(function($) {
    // Toggle password visibility for all password fields
    $('.toggle-password').on('click', function() {
        var target = $(this).data('target'); // Get the target input field
        var passwordField = $(target);
        var passwordFieldType = passwordField.attr('type');

        // Toggle between 'password' and 'text'
        if (passwordFieldType === 'password') {
            passwordField.attr('type', 'text'); // Show password
            $(this).find('.show-eye').show(); 
            $(this).find('.hide-eye').hide(); // Replace with open eye icon
        } else {
            passwordField.attr('type', 'password'); // Hide password
            $(this).find('.hide-eye').show(); 
            $(this).find('.show-eye').hide(); 
        }
    });
});

jQuery(document).ready(function($) {
    $('#book-now-btn').on('click', function(e) {
        e.preventDefault();

        var date = $('#tour_datepicker').val();
        var members = $('#number_of_members').val();
        var time = $('#tour_time').val();
        var post_id = $('input[name="post_id"]').val();

        // Check if date is selected
        if (date === '') {
            alert("Please select a date.");
            return;
        }

        // Redirect to checkout page with query parameters
        var checkoutUrl = window.location.origin + "/checkout";
        window.location.href = checkoutUrl + "?date=" + encodeURIComponent(date) + 
                              "&members=" + encodeURIComponent(members) + 
                              "&time=" + encodeURIComponent(time) + 
                              "&post_id=" + encodeURIComponent(post_id);
    });
});

jQuery(document).ready(function($) {
  // Handle next button click
  $('.next-button').on('click', function() {
    var currentStep = $(this).closest('.step');
    
    // Find the before and after confirmation inside the current step
    var beforeConfirmation = currentStep.find('.before-confirmation');
    var afterConfirmation = currentStep.find('.after-confirmation');
    var nextStep = currentStep.next('.step');
	var nextStepBeforeConfirmation = nextStep.find('.before-confirmation');
    var nextStepAfterConfirmation = nextStep.find('.after-confirmation');
	var editBtn = currentStep.find('.tour-booking-detail-edit-btn')
	var firstName = $('#first_name').val();
    var lastName = $('#last_name').val();
    var email = $('#email').val();
    var phoneNumber = $('#phone_number').val();
	var travelerOneFirstName = $('#travelerOneFirstName').val();
	var travelerOneLastName = $('#travelerOneLastName').val();
	var travelerTwoFirstName = $('#travelerTwoFirstName').val();
	var travelerTwoLastName = $('#travelerTwoLastName').val();
	let pickupPoint = '';
	  if ($('#pickup01').is(':checked')) {
		  pickupPointKey  = $('#arrival-airline-01').val();
		  $('#pickup-point').text(pickupPointKey);
	  } else if ($('#pickup02').is(':checked')) {
		  pickupPointKey  = "I’ll decide later";
	  }
    // Update the after-confirmation fields with the captured values
    $('.guest-name').text(firstName + ' ' + lastName);
    $('.guest-email span:last-child').text(email);
    $('.GUEST-PHONE span:last-child').text(phoneNumber);
	$('#primary-traveler').html(travelerOneFirstName + ' ' + travelerOneLastName + '<br>' + travelerTwoFirstName + ' ' + travelerTwoLastName);
    $('#pickup-point').attr('data-translate-key', pickupPointKey).text($(`[data-translate-key="${pickupPointKey}"]`).text());
    // Move to the next step if it exists
    if (nextStep.length) {
      currentStep.removeClass('available'); // Remove 'available' from the current step
      beforeConfirmation.removeClass('available'); // Hide before confirmation
      afterConfirmation.addClass('available'); // Show after confirmation
      nextStep.addClass('available'); // Add 'available' to the next step
	  nextStepBeforeConfirmation.addClass('available');
	  editBtn.addClass('available');
    }
  });

  // Optionally, handle "Previous" button to go back to the previous step
  $('.tour-booking-detail-edit-btn').on('click', function() {
    var currentStep = $(this).closest('.step');
    var prevStep = currentStep.prev('.step');
    var beforeConfirmation = currentStep.find('.before-confirmation');
    var afterConfirmation = currentStep.find('.after-confirmation');
    var nextStep = currentStep.next('.step');
	var nextAndNextStep = nextStep.next('.step');
	var nextStepBeforeConfirmation = nextStep.find('.before-confirmation');
    var nextStepAfterConfirmation = nextStep.find('.after-confirmation');
	var editBtn = currentStep.find('.tour-booking-detail-edit-btn');
	var nextEditBtn = nextStep.find('.tour-booking-detail-edit-btn');
    if (nextStep.length) {
      currentStep.addClass('available'); // Remove 'available' from the current step
      nextStep.removeClass('available'); // Add 'available' to the previous step
	  beforeConfirmation.addClass('available'); // Hide before confirmation
      afterConfirmation.removeClass('available');
	  editBtn.removeClass('available');
	  nextStepBeforeConfirmation.removeClass('available');
	  nextStepAfterConfirmation.removeClass('available');
	  nextEditBtn.removeClass('available');
    }
  });
});

jQuery(document).ready(function($) {
    $('#tour-filters input').on('change', function() {
        $('#tour-filters').submit();
    });
});

jQuery(document).ready(function($) {
    // On hover of a parent destination in col1
    $('.parent-destination').hover(function() {
        // Get the child destinations from data-children
        let children = $(this).data('children');

        // Clear the current content in col2
        $('.col2').empty();

        // Check if there are any child destinations
        if (children.length > 0) {
            $.each(children, function(index, child) {
                // Add each child destination to col2
                $('.col2').append('<p class="translate-child" data-name-en="' + child.name_en + '" data-name-jp="' + child.name_jp + '">' + child.name_en + ' (' + child.name_jp + ')</p>');
            });
        } else {
            // If no children, show a message or leave it empty
            $('.col2').append('<p>No child destinations available</p>');
        }
    });

    // Trigger hover on the first destination by default
    $('.parent-destination').first().trigger('mouseenter');
});