<?php
/**
 *	Process AJAX requests
 *
 *	@package Industry Child Theme
 *	@author Ren Ventura
 */

/**
 *	Update Custom CSS theme mod
 */
add_action( 'wp_ajax_industry_genesis_save_css', 'industry_genesis_save_css' );
function industry_genesis_save_css() {

	$response = array();

	$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : null;
	$css = isset( $_POST['css'] ) ? $_POST['css'] : '';

	// Verify nonce, permissions, and that editor is enabled
	if ( ! $nonce || ! wp_verify_nonce( $nonce, 'industry_css_editor_nonce' ) || ! current_user_can( 'manage_options' ) || ! genesis_get_option( 'industry_genesis_enable_css_editor' ) ) {
		$response['status'] = 'failed';
		$response['message'] = __( 'Permissions failed.', 'industry-genesis' );
	}

	// Save the CSS
	set_theme_mod( 'industry_custom_css', strip_tags( $css ) );

	// Success response
	$response['status'] = 'success';
	$response['message'] = __( 'Changes saved!', 'industry-genesis' );

	// Send response
	wp_send_json( $response );
}