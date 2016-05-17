<?php
/**
 *	Add some navigation after posts (related posts, next/prev posts, etc.)
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

// Post navigation
add_action( 'genesis_after_entry', 'industry_genesis_post_nav', 5 );
function industry_genesis_post_nav() {

	global $post;

	if ( ! is_singular( 'post' ) ) {
		return;
	}

	$prev = get_adjacent_post();
	$next = get_adjacent_post( false, '', false );

	echo '<div class="single-post-nav clearfix">';

	if ( $prev ) {
		printf( '<p id="previous-post"><a href="%s"><span class="post-nav-direction">%s</span>%s</a></p>', get_permalink( $prev->ID ), __( '&lt; Previous', 'industry-genesis' ), get_the_title( $prev->ID ) );
	}

	if ( $next ) {
		printf( '<p id="next-post"><a href="%s"><span class="post-nav-direction">%s</span>%s</a></p>', get_permalink( $next->ID ), __( 'Next &gt;', 'industry-genesis' ), get_the_title( $next->ID ) );
	}

	echo '</div>';
}