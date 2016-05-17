<?php
/**
 *	Modifications to the comments and comment area
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

// Change the comments title/header
add_filter( 'genesis_title_comments', 'industry_genesis_filter_comment_title' );
function industry_genesis_filter_comment_title() {

	$comments_count = get_comments_number();

	if ( $comments_count ) {

		$comments = sprintf( _n( '1 Comment', '%s Comments', intval( $comments_count ) ), $comments_count );

		$message = sprintf( '<h3>%1$s (%2$s)</h3>', __( 'What readers are saying...' ), $comments );

	} else {

		$message = sprintf( '<h3>%1$s</h3>', __( 'What readers are saying... (No Comments)' ) );
	}

	return $message;
}

// Modify the size of the Gravatar in the entry comments
// add_filter( 'genesis_comment_list_args', 'industry_genesis_gravatar_comment_size' );
function industry_genesis_gravatar_comment_size() {
	$args['avatar_size'] = 150;
	return $args;
}

// Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'industry_genesis_remove_comment_allowed_tags' );
function industry_genesis_remove_comment_allowed_tags( $defaults ) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}