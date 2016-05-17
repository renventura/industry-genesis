<?php
/**
 *	Modify the header (favicon too)
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

/**
 *	Favicon
 */
add_filter( 'genesis_pre_load_favicon', 'industry_genesis_favicon' );
function industry_genesis_favicon( $favicon_url ) {

	if ( get_theme_mod( 'industry_favicon' ) ) {
		$favicon_url = get_theme_mod( 'industry_favicon' );
	}

	return $favicon_url;
}

/**
 *	Customizer header/logo
 */
add_filter( 'genesis_seo_title', 'industry_genesis_logo', 10, 2 );
function industry_genesis_logo( $title, $inside ) {

	if ( get_theme_mod( 'industry_logo' ) ) {
		$child_inside = sprintf( '
			<div class="site-logo-wrap header-logo">
				<div class="site-logo">
					<a href="%1$s" title="%2$s">
						<img src="%3$s" title="%2$s" alt="%2$s" class="logo-image aligncenter" />
					</a>
				</div>
			</div>', trailingslashit( get_home_url() ), esc_attr( get_bloginfo( 'name' ) ), get_theme_mod( 'industry_logo' ) );
	} else {
		$child_inside = sprintf( '
			<div class="site-logo-wrap header-title">
				<div class="site-logo">
					<a href="%1$s" title="%2$s">%2$s</a>
				</div>
			</div>', trailingslashit( get_home_url() ), esc_attr( get_bloginfo( 'name' ) ) );
	}

	$title = str_replace( $inside, $child_inside, $title );

	return $title;
}

/**
 *	Add custom data attribute to header when sticky header is enabled
 */
add_filter( 'genesis_attr_site-header', 'industry_genesis_sticky_header' );
function industry_genesis_sticky_header( $atts ) {

	if ( get_theme_mod( 'industry_sticky_header' ) == 1 ) {
		$atts['data-sticky-header'] = 'enabled';
	}

	return $atts;
}

/**
 *	Insert before_header widget area
 */
add_action( 'genesis_before_header', 'industry_genesis_before_header_widget_output' );
function industry_genesis_before_header_widget_output() {

	global $wp_registered_sidebars;

	if ( isset( $wp_registered_sidebars['before-header'] ) && is_active_sidebar( 'before-header' ) ) {

		genesis_markup( array(
			'html5' => '<div %s><div class="wrap">' . genesis_sidebar_title( 'before-header' ),
			'xhtml' => '<div class="widget-area header-widget-area before-header"><div class="wrap">',
			'context' => 'before-header',
		) );

		dynamic_sidebar( 'before-header' );

		echo '</div></div>';
	}
}

/**
 *	Unhook default Genesis header, then re-add with Header Middle widget area
 */
remove_action( 'genesis_header','genesis_do_header' );
add_action( 'genesis_header', 'industry_genesis_genesis_do_header' );
function industry_genesis_genesis_do_header() {

	global $wp_registered_sidebars;

	genesis_markup( array(
		'html5' => '<div %s>',
		'xhtml' => '<div id="title-area">',
		'context' => 'title-area',
	) );
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	echo '</div>';


	genesis_widget_area( 'header-middle', array(
		'before' => '<div class="header-middle widget-area">',
		'after'  => '</div>',
	) );

	if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {

		genesis_markup( array(
			'html5' => '<div %s>' . genesis_sidebar_title( 'header-right' ),
			'xhtml' => '<div class="widget-area header-widget-area">',
			'context' => 'header-widget-area',
		) );

		do_action( 'genesis_header_right' );
		add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
		add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
		dynamic_sidebar( 'header-right' );
		remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
		remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

		echo '</div>';
	}
}