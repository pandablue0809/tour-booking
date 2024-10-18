jQuery(document).ready(function($) {
    $('#searchInput').on('input', function() {
        var query = $(this).val();

        if (query.length > 2) {
            $.ajax({
                url: ajax_object.ajax_url, // Use the localized URL here
                type: 'GET',
                data: {
                    action: 'ajax_search', // The action hook for handling search
                    s: query
                },
                success: function(data) {
                    if (data) {
                        $('#searchResultsDropdown').html(data).removeClass('hidden');
                    } else {
                        $('#searchResultsDropdown').html('<li>No results found</li>').removeClass('hidden');
                    }
                }
            });
        } else {
            $('#searchResultsDropdown').addClass('hidden');
        }
    });

    // Hide the dropdown if the user clicks outside
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.header-search').length) {
            $('#searchResultsDropdown').addClass('hidden');
        }

        if (!$(event.target).closest('.search-form').length) {
            $('#searchResultsDropdown').addClass('hidden');
        }
    });
});

jQuery(document).ready(function($) {
    $('#searchInputTopPage').on('input', function() {
        var query = $(this).val();

        if (query.length > 2) {
            $.ajax({
                url: ajax_object.ajax_url, // Use the localized URL here
                type: 'GET',
                data: {
                    action: 'ajax_search', // The action hook for handling search
                    s: query
                },
                success: function(data) {
                    if (data) {
                        $('#searchResultsDropdownTopPage').html(data).removeClass('hidden');
                    } else {
                        $('#searchResultsDropdownTopPage').html('<li>No results found</li>').removeClass('hidden');
                    }
                }
            });
        } else {
            $('#searchResultsDropdownTopPage').addClass('hidden');
        }
    });
});

