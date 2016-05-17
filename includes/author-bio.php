<?php
/**
 *	Author box
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

// Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

add_action( 'genesis_after_entry', 'industry_genesis_author_bio', 8, 2 );
/**
 *	Outputs the author box markup
 *	@param (int) $user_id ID of user; defaults to post author
 *	@param (string) $url URL to image; defaults to post author's Gravatar
 */
function industry_genesis_author_bio( $user_id = '', $url = '' ) {

	// Bail if not a singular post
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	// Bail if author box is not enabled
	if ( ! genesis_get_option( 'industry_genesis_enable_author_box' ) ) {
		return;
	}

	global $post;

	$user_id = $user_id ? $user_id : $post->post_author;

	$url = $url ? $url : '';

	if ( ! $url ) {

		$user_email = get_the_author_meta( 'user_email' );
		
		$url = add_query_arg( array(
			's' => 200,
			'd' => 'mm',
		), 'http://gravatar.com/avatar/' . md5( $user_email ) );
	}

	$url = esc_url_raw( $url );

	?>

	<div class="author-box">

		<img src="<?php echo $url; ?>" class="avatar alignleft" width="120" />

		<h4 class="author-name"><?php echo get_user_meta( $user_id, 'first_name', true ) . ' ' . get_user_meta( $user_id, 'last_name', true ); ?></h4>
		
		<div class="author-bio">

			<?php echo get_user_meta( $user_id, 'description', true ); ?>
		
		</div>
		
	</div>

<?php }