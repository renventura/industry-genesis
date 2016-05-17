<?php
/**
 *	Modify the Post archives
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

// Add column classes to archives
//add_filter( 'post_class', 'industry_genesis_archive_post_class' );
function industry_genesis_archive_post_class( $classes ) {

	global $wp_query;

	if ( ! $wp_query->is_main_query() || is_post_type_archive( 'product' ) ) {
		return $classes;
	}

	if ( is_home() || is_archive() ) {

		$classes[] = 'one-half';

		if ( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 2 ) {
			$classes[] = 'first';
		}
	}

	return $classes;
}

// Add featured images to post archives
add_action( 'genesis_entry_header', 'industry_genesis_post_archive_hover_content_open', 5 );
function industry_genesis_post_archive_hover_content_open() {

	if ( is_archive() || is_home() ) {

		$args = array(
			'format'  => 'url',
			'size'    => 'full',
			'context' => 'archive',
			'attr'    => genesis_parse_attr( 'featured-image' ),
		);

		$img = genesis_get_image( $args );

		if ( $img ) {
			printf( '<a href="%s"><img src="%s" alt="" class="archive-post-image"></a>', get_permalink(), $img );
		}
	}
}