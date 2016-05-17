<?php
/**
 *	Styles that are places in the header
 *
 *	@package Industry Child Theme
 *	@author Ren Ventura
 */
?>

<style id="industry-customizer-css">
	
	.social-following {
		background-color: <?php echo $social_following_bg_color ? $social_following_bg_color : '#f6f6f6'; ?>;
	}

	.title-area,
	.header-logo .logo-image {
		max-height: <?php echo $logo_height ? $logo_height . 'px' : '80px'; ?>;
		max-width: <?php echo $logo_width ? $logo_width . 'px' : '360px'; ?>;
	}

</style>

<style id="industry-custom-css">
	<?php echo $custom_css; ?>
</style>