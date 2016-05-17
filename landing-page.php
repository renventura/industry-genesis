<?php
/**
 *	Template Name: Landing
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

// Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Add landing body class to the head
add_filter( 'body_class', 'industry_genesis_landing_body_class' );
function industry_genesis_landing_body_class( $classes ) {
	$classes[] = 'landing';
	return $classes;
}

// Remove site header elements
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Remove navigation
remove_action( 'genesis_after_header', 'genesis_do_nav', 15 );
remove_action( 'genesis_footer', 'genesis_do_subnav', 7 );

// Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove site footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

// Remove site footer elements
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
remove_action( 'genesis_footer', 'industry_genesis_footer' );

// Run the Genesis loop
genesis();