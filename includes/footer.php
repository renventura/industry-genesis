<?php
/**
 *	Modify the footer area
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

/**
 *	Footer CTA widget area
 */
add_action( 'genesis_before_footer', 'industry_genesis_footer_cta_footer', 5 );
function industry_genesis_footer_cta_footer() {

	global $wp_registered_sidebars;

	if ( isset( $wp_registered_sidebars['footer-cta'] ) && is_active_sidebar( 'footer-cta' ) ) {

		genesis_markup( array(
			'html5' => '<div %s>' . genesis_sidebar_title( 'footer-cta' ),
			'xhtml' => '<div class="widget-area header-widget-area footer-cta">',
			'context' => 'footer-cta',
		) );

		dynamic_sidebar( 'footer-cta' );

		echo '</div>';
	}
}

/**
 *	Custom footer and scroll-to-top button
 */
remove_action( 'genesis_footer', 'genesis_do_footer');
add_action( 'genesis_footer', 'industry_genesis_footer' );
function industry_genesis_footer() {

	global $wp_registered_sidebars;

	$to_top = get_theme_mod( 'industry_scroll_to_top' );

	if ( $to_top ) {
		printf( '<span class="scroll-to-top" title="%s"><i class="fa fa-arrow-up"></i></span>', __( 'Return to top', 'industry-genesis' ) );
	}

	if ( isset( $wp_registered_sidebars['footer'] ) && is_active_sidebar( 'footer' ) ) {

		genesis_markup( array(
			'html5' => '<div %s>' . genesis_sidebar_title( 'footer' ),
			'xhtml' => '<div class="widget-area header-widget-area footer">',
			'context' => 'footer',
		) );

		dynamic_sidebar( 'footer' );

		echo '</div>';
	} else {
		printf( '<p><i class="fa fa-heart"></i> <a href="%s" target="_blank">%s</a> %s</p>', 'https://www.engagewp.com/downloads/industry-genesis/', CHILD_THEME_NAME, __( 'built for the Genesis Framework', 'industry-genesis' ) );
	}
}

/**
 *	Add custom data attribute to header when sticky header is enabled
 */
add_filter( 'genesis_attr_site-footer', 'industry_genesis_scroll_top' );
function industry_genesis_scroll_top( $atts ) {

	if ( get_theme_mod( 'industry_scroll_to_top' ) == 1 ) {
		$atts['data-scroll-to-top'] = 'enabled';
	}

	return $atts;
}