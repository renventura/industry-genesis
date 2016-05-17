<?php
/**
 *	Modify the post info and meta
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

// Remove the post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// Remove the entry footer markup (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

/**
 *	Get post published/updated date
 *	@param (int) $post_id ID of a post
 *	@param (string) $format Date format
 *	@return (string) $post_info Text to display published/modified date (must be echoed out)
 */
function industry_genesis_get_post_date( $post_id = '', $format = 'F j, Y' ) {

	if ( ! $post_id ) {
		global $post;
	} else {
		$post = get_post( $post_id );
	}

	$author_id = $post->post_author;

	$author = get_the_author_meta( 'display_name', $author_id );

	$author_link = sprintf( '<a href="%s"><span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><span class="entry-author-name" itemprop="name">%s</span></span></a>', get_author_posts_url( $author_id ), $author );

	if ( date( 'Y-m-d', strtotime( $post->post_date ) ) == date( 'Y-m-d', strtotime( $post->post_modified ) ) ) { # Published date

		$post_info = sprintf( '<time class="entry-time" itemprop="datePublished" datetime="%s">%s</time>', date( 'Y-m-d', strtotime( $post->post_date ) ), date( $format, strtotime( $post->post_date ) ) );		

	} else { # Modified date

		$post_info = sprintf( '<time class="entry-time" itemprop="dateModified" datetime="%s">%s</time>', date( 'Y-m-d', strtotime( $post->post_modified ) ), date( $format, strtotime( $post->post_modified ) ) );
	}

	return $post_info;
}