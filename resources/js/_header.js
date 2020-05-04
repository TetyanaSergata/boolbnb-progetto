const $ = require('jquery');

$(document).ready(function () {

	// search for desktop
	$('.search-form-desktop .search-btn').attr('disabled', true);
	$(document).on('keyup', '.search-form-desktop .search-bar', function() {
		if ($('.search-form-desktop .search-bar').val() !== '') {
			$('.search-form-desktop .search-btn').attr('disabled', false);
		}
	});

	// search for mobile
	$('.search-form-mobile .search-btn').attr('disabled', true);
	$(document).on('keyup', '.search-form-mobile .search-bar', function() {
		if ($('.search-form-mobile .search-bar').val() !== '') {
			$('.search-form-mobile .search-btn').attr('disabled', false);
		}
	});
});
