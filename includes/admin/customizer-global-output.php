<?php
/**
 *	Global customizer output
 *
 *	@package Industry Child Theme
 *	@author Ren Ventura
 */

/**
 *	CSS editor form
 */
add_action( 'wp_footer', 'industry_genesis_launch_css_editor' );
function industry_genesis_launch_css_editor() { 

	// Bail if not an administrator
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Not enabled
	if ( ! genesis_get_option( 'industry_genesis_enable_css_editor' ) ) {
		return;
	}

	$custom_css = get_theme_mod( 'industry_custom_css' );

	include_once 'css-editor.php';
}

/**
 *	Customizer output
 */
add_action( 'wp_head', 'industry_genesis_customizer_output' );
function industry_genesis_customizer_output() {

	$custom_css = get_theme_mod( 'industry_custom_css' );
	
	$social_following_bg_color = get_theme_mod( 'industry_hero_social_follow_background' );
	
	$logo_width = get_theme_mod( 'industry_logo_width' );
	$logo_height = get_theme_mod( 'industry_logo_height' );

	include_once 'header-styles.php';
}