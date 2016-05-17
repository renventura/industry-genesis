jQuery(document).ready(function($) {

	// Scroll to top button (user enabled)
	if ( $('.site-footer').data('scroll-to-top') === 'enabled' ) {
		
		var scroll_button = $('.scroll-to-top');
		
		$(window).scroll(function() {

			// Show button if more than 200px from top
			if ( $(this).scrollTop() > 200 ) {

				scroll_button.fadeIn();

			} else {

				scroll_button.fadeOut();
			}
		});
		
		scroll_button.click(function() {

			// Animate the scroll up
			$('html, body').animate({ scrollTop : 0 }, 1000 );

			return false;
		});
	}

	// Smooth scrolling
	$('a[href*="#"]:not([href="#"])').click(function() {

		if ( location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname ) {
			
			var target = $(this.hash);
			
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			
			if ( target.length ) {
				
				$('html, body').animate({

					scrollTop: target.offset().top

				}, 1000);
				
				return false;
			}
		}
	});
});