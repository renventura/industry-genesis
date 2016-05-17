jQuery(document).ready(function($) {

	var	header = $(".site-header"),
		clone = header.clone(),
		didScroll,
		offset = 200,
		previousScroll = 0,
		senseSpeed = 30;

	// Bail if sticky header is not enabled
	if ( header.data('sticky-header') !== 'enabled' ) {
		return;
	}

	// Add class to cloned header
	clone.addClass('header-clone');

	// Insert cloned header after original
	header.after(clone);

	// Set time interval to reduce payload
	setInterval(function() {
		if ( didScroll ) {
			hasScrolled();
			didScroll = false;
		}
	}, 250);

	// User scrolled
	$(window).scroll(function() {
		didScroll = true;
	});

	function hasScrolled() {

		// Get distance from top
		var scroller = $(this).scrollTop();

		// Outside offset
		if ( Math.abs( scroller ) > offset ) {

			if ( scroller - senseSpeed > previousScroll ) {

				// Scrolling down
				if ( clone.hasClass('stuck') ) {
					clone.slideUp('fast');
				}

			} else if ( scroller + senseSpeed <= previousScroll ) {

				// Scrolling up
				clone.addClass('stuck').slideDown();
			}

		} else {

			// Within the offset
			if ( clone.hasClass('stuck') ) {
				clone.hide().removeClass('stuck');
			}
		}

		// Set last scroll position
		previousScroll = scroller;
	}
});