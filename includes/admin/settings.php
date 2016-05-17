<?php
/**
 *	Theme settings
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

/**
 *	Register custom Genesis theme settings
 *
 *	@param (array) $defaults Default theme settings
 *	@return (array) New default theme settings
 */
add_filter( 'genesis_theme_settings_defaults', 'industry_genesis_genesis_theme_defaults' );
function industry_genesis_genesis_theme_defaults( $defaults ) {
	$defaults['industry_genesis_front_page_widget_areas'] = '';
	$defaults['industry_genesis_enable_css_editor'] = '';
	$defaults['industry_genesis_enable_share_buttons'] = '';
	$defaults['industry_genesis_share_button_types'] = '';
	$defaults['industry_genesis_share_button_post_types'] = '';
	$defaults['industry_genesis_share_button_via'] = '';
	$defaults['industry_genesis_share_button_related_accounts'] = '';
	$defaults['industry_genesis_enable_author_box'] = '';
	return $defaults;
}

/**
 * Register additional metaboxes to Genesis > Theme Settings
 *
 * @param (string) $_genesis_theme_settings_pagehook
 */
add_action( 'genesis_theme_settings_metaboxes', 'industry_genesis_genesis_meta_boxes' );
function industry_genesis_genesis_meta_boxes( $_genesis_theme_settings_pagehook ) {
	add_meta_box( 'industry_genesis-general-settings', __( 'Industry Child Theme - General Settings', 'industry-genesis' ), 'industry_genesis_general_settings_metabox', $_genesis_theme_settings_pagehook, 'main', 'high' );
	add_meta_box( 'industry_genesis-social-settings', __( 'Industry Child Theme - Social Share Settings', 'industry-genesis' ), 'industry_genesis_social_settings_metabox', $_genesis_theme_settings_pagehook, 'main', 'high' );
}

/**
 *	Fill in the General Settings meta box with inputs
 *	@see industry_genesis_genesis_meta_boxes()
 */
function industry_genesis_general_settings_metabox() { ?>

	<?php

		global $pagenow;

		$return_url = urlencode( add_query_arg( array(
			'page' => 'genesis'
		), admin_url( $pagenow ) ) );

		$options = get_option( 'genesis-settings' ) ? get_option( 'genesis-settings' ) : array();

	?>

	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><?php _e( 'Frontend CSS Editor', 'industry-genesis' ); ?></th>
				<td>
					<fieldset>
						
						<legend class="screen-reader-text"><?php _e( 'Frontend CSS Editor', 'industry-genesis' ); ?></legend>

						<p>
							<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_enable_css_editor]">
								<input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_enable_css_editor]" id="industry-genesis-enable-css-editor" value="1" <?php checked( intval( $options['industry_genesis_enable_css_editor'] ), 1 ); ?> />
								<?php _e( 'Enable Editor', 'industry-genesis' ); ?>
							</label>
						</p>
						
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Author Box', 'industry-genesis' ); ?></th>
				<td>
					<fieldset>
						
						<legend class="screen-reader-text"><?php _e( 'Author Box', 'industry-genesis' ); ?></legend>

						<p>
							<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_enable_author_box]">
								<input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_enable_author_box]" id="industry-genesis-enable-author-box" value="1" <?php checked( intval( $options['industry_genesis_enable_author_box'] ), 1 ); ?> />
								<?php _e( 'Enable on single posts', 'industry-genesis' ); ?>
							</label>
						</p>
						
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Front Page Widgets', 'industry-genesis' ); ?></th>
				<td>
					<fieldset>
						
						<legend class="screen-reader-text"><?php _e( 'Front Page Widgets', 'industry-genesis' ); ?></legend>

						<p>
							<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_front_page_widget_areas]">
								<input type="number" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_front_page_widget_areas]" id="industry-genesis-front-page-widgets" value="<?php esc_attr_e( $options['industry_genesis_front_page_widget_areas'] ); ?>" />
							</label><br/>
							<span class="description"><?php _e( 'Number of front page widgets', 'industry-genesis' ); ?></span>
						</p>
						
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Customizer', 'industry-genesis' ); ?></th>
				<td>
					<fieldset>
						
						<legend class="screen-reader-text"><?php _e( 'Customizer', 'industry-genesis' ); ?></legend>
						
						<p><?php _e( 'For more customizations, open the WordPress Customizer and see the Industry Genesis panel.', 'industry-genesis' ) ?> <a href='<?php echo admin_url( "customize.php?return=$return_url" ); ?>'><?php _e( 'Open Customizer', 'industry-genesis' ) ?></a></p>
						
					</fieldset>
				</td>
			</tr>
		</tbody>
	</table>

<?php }

/**
 *	Fill in the Social Share meta box with inputs
 *	@see industry_genesis_genesis_meta_boxes()
 */
function industry_genesis_social_settings_metabox() { ?>

	<?php

		global $pagenow;

		$return_url = urlencode( add_query_arg( array(
			'page' => 'genesis'
		), admin_url( $pagenow ) ) );

		$options = get_option( 'genesis-settings' );

		$button_types = isset( $options['industry_genesis_share_button_types'] ) ? $options['industry_genesis_share_button_types'] : '';
		$post_types = isset( $options['industry_genesis_share_button_post_types'] ) ? $options['industry_genesis_share_button_post_types'] : '';

	?>

	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row"><?php _e( 'Enable Social Sharing Icons', 'industry-genesis' ); ?></th>
				<td>
					<fieldset>
						
						<legend class="screen-reader-text"><?php _e( 'Enable Social Sharing Icons', 'industry-genesis' ); ?></legend>

						<p>
							<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_enable_share_buttons]">
								<input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_enable_share_buttons]" id="industry-genesis-enable-share-buttons" value="1" <?php checked( intval( $options['industry_genesis_enable_share_buttons'] ), 1 ); ?> />
								<?php _e( 'Enable Share Buttons', 'industry-genesis' ); ?>
							</label>
						</p>
						
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Button Types', 'industry-genesis' ); ?></th>
				<td>
					<fieldset>
						
						<legend class="screen-reader-text"><?php _e( 'Button Types', 'industry-genesis' ); ?></legend>

						<p>
							<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_types][twitter]">
								<input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_types][twitter]" id="industry-genesis-twitter" value="1" <?php checked( intval( isset( $button_types['twitter'] ) ? $button_types['twitter'] : '' ), 1 ); ?> />
								<?php _e( 'Twitter', 'industry-genesis' ); ?>
							</label>
						</p>

						<p>
							<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_types][facebook]">
								<input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_types][facebook]" id="industry-genesis-facebook" value="1" <?php checked( intval( isset( $button_types['facebook'] ) ? $button_types['facebook'] : '' ), 1 ); ?> />
								<?php _e( 'Facebook', 'industry-genesis' ); ?>
							</label>
						</p>

						<p>
							<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_types][pinterest]">
								<input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_types][pinterest]" id="industry-genesis-pinterest" value="1" <?php checked( intval( isset( $button_types['pinterest'] ) ? $button_types['pinterest'] : '' ), 1 ); ?> />
								<?php _e( 'Pinterest', 'industry-genesis' ); ?>
							</label>
						</p>
						
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Post Types', 'industry-genesis' ); ?></th>
				<td>
					<fieldset>
						
						<legend class="screen-reader-text"><?php _e( 'Post Types', 'industry-genesis' ); ?></legend>

						<span class="description"><?php _e( 'Which post types should include share buttons?', 'industry-genesis' ); ?></span>

						<?php foreach( get_post_types( array( 'public' => true ) ) as $type ) : ?>

							<p>
								<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_post_types][<?php echo $type; ?>]">
									<input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_post_types][<?php echo $type; ?>]" id="industry-genesis-<?php echo $type; ?>" value="1" <?php checked( intval( isset( $post_types[$type] ) ? $post_types[$type] : '' ), 1 ); ?> />
									<?php echo ucwords( $type ); ?>
								</label>
							</p>

						<?php endforeach; ?>

					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'Via... (Twitter)', 'industry-genesis' ); ?></th>
				<td>
					<fieldset>
						
						<legend class="screen-reader-text"><?php _e( 'Via... (Twitter)', 'industry-genesis' ); ?></legend>

						<p>
							<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_via]">
								<input type="text" class="regular-text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_via]" id="industry-genesis-via" value="<?php echo $options['industry_genesis_share_button_via']; ?>" placeholder="i.e. CLE_Ren" />
							</label>
						</p>

						<span class="description"><?php _e( 'Who is responsible for the content?', 'sumation-genesis' ); ?></span>

					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php _e( 'List of "Related" accounts (Twitter)', 'industry-genesis' ); ?></th>
				<td>
					<fieldset>
						
						<legend class="screen-reader-text"><?php _e( 'List of "Related" accounts (Twitter)', 'industry-genesis' ); ?></legend>

						<p>
							<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_related_accounts]">
								<input type="text" class="regular-text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[industry_genesis_share_button_related_accounts]" id="industry-genesis-related-accounts" value="<?php echo $options['industry_genesis_share_button_related_accounts']; ?>" placeholder="i.e. CLE_Ren,srikat" />
							</label>
						</p>

						<span class="description"><?php _e( 'These accounts may be recommended by Twitter after a successful share. Separate each account by a comma. Do not include the @ symbol.', 'industry-genesis' ); ?></span>

					</fieldset>
				</td>
			</tr>
		</tbody>
	</table>

<?php }

// Sanitize new Genesis setting meta boxes
add_action( 'genesis_settings_sanitizer_init', 'industry_genesis_sanitize_meta_boxes' );
function industry_genesis_sanitize_meta_boxes() {

	/**
	 *	Genesis sanitization filters:
	 *	one_zero, no_html, absint, safe_html, requires_unfiltered_html, url, email_address
	 */

	// No HTML
	genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD, array(
		'industry_genesis_share_button_related_accounts',
		'industry_genesis_share_button_via',
	) );

	// 0 or 1 (i.e. checkboxes, radio buttons)
	genesis_add_option_filter( 'one_zero', GENESIS_SETTINGS_FIELD, array(
		'industry_genesis_enable_css_editor',
		'industry_genesis_enable_author_box',
		'industry_genesis_enable_share_buttons',
		'industry_genesis_share_button_types["twitter"]',
		'industry_genesis_share_button_types["facebook"]',
		'industry_genesis_share_button_types["pinterest"]',
	) );

	// Number (absint)
	genesis_add_option_filter( 'absint', GENESIS_SETTINGS_FIELD, array(
		'industry_genesis_front_page_widget_areas',
	) );
}