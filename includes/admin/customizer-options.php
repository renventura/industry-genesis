<?php
/**
 *	Add style settings to the WordPress Customizer
 *
 *	@package Industry Child Theme
 *	@author Ren Ventura
 */

if ( ! class_exists( 'Industry_Child_Theme_Customizer_Settings' ) ):

class Industry_Child_Theme_Customizer_Settings {

	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_customizer_fields' ) );
	}

	/**
	 *	Define the Customizer settings
	 *
	 *	@return array $settings The Customizer settings
	 */
	public function customizer_settings() {

		$front_page_fields = array(

			// Fields
			array(
				'type' => 'image_upload',
				'key' => 'industry_hero_image',
				'label' => __( 'Main Hero Image', 'industry-genesis' ),
				'description' => __( '', 'industry-genesis' )
			),
			array(
				'type' => 'color',
				'key' => 'industry_hero_header_color',
				'label' => __( 'Hero Header Color', 'industry-genesis' ),
				'default' => '',
			),
			array(
				'type' => 'color',
				'key' => 'industry_hero_text_color',
				'label' => __( 'Hero Text Color', 'industry-genesis' ),
				'default' => '',
			),
		);

		for ( $i = 1; $i <= CHILD_THEME_FRONT_PAGE_WIDGET_AREAS; $i++ ) {

			$front_page_fields[] = array(
				'type' => 'image_upload',
				'key' => "industry_front_page_{$i}_image",
				'label' => __( "Front Page Section {$i} Image", 'industry-genesis' ),
				'description' => __( '', 'industry-genesis' )
			);
			$front_page_fields[] = array(
				'type' => 'color',
				'key' => "industry_front_page_{$i}_background_color",
				'label' => __( "Front Page Section {$i} Background Color", 'industry-genesis' ),
				'default' => '',
			);
			$front_page_fields[] = array(
				'type' => 'color',
				'key' => "industry_front_page_{$i}_text_color",
				'label' => __( "Front Page Section {$i} Text Color", 'industry-genesis' ),
				'default' => '',
			);
		}

		$settings = array(

			'panels' => array(

				// Panels
				array(
					'key' => 'industry_genesis_customizer_panel',
					'priority' => 1,
					'capability' => 'edit_theme_options',
					'theme_supports' => '',
					'title' => __( 'Industry Child Theme', 'industry-genesis' ),
					'description' => __( 'Customizer settings for the Industry child theme.', 'industry-genesis' ),
					'sections' => array(

						// Panel Sections
						array(
							'key' => 'industry_genesis_customizer_front_page',
							'title' => __( 'Front Page', 'industry-genesis' ),
							'description' => __( 'Front page images and colors.', 'industry-genesis' ),
							'fields' => $front_page_fields,
						),
						array(
							'key' => 'industry_genesis_customizer_global_widgets',
							'title' => __( 'Global Widgets', 'industry-genesis' ),
							'description' => __( 'Widgets displayed across the entire site.', 'industry-genesis' ),
							'fields' => array(
								// Fields
								array(
									'type' => 'color',
									'key' => 'industry_hero_social_follow_background',
									'label' => __( 'Social Follow Background Color', 'industry-genesis' ),
									'default' => '',
								),
							)
						),
						array(
							'key' => 'industry_genesis_customizer_misc',
							'title' => __( 'Miscellaneous', 'industry-genesis' ),
							'description' => __( 'Miscellaneous settings.', 'industry-genesis' ),
							'fields' => array(
								// Fields
								array(
									'type' => 'image_upload',
									'key' => 'industry_favicon',
									'label' => __( 'Favicon', 'industry-genesis' ),
								),
								array(
									'type' => 'image_upload',
									'key' => 'industry_logo',
									'label' => __( 'Logo Image', 'industry-genesis' ),
									'description' => __( '', 'industry-genesis' )
								),
								array(
									'type' => 'number',
									'key' => 'industry_logo_width',
									'label' => __( 'Logo Max Width', 'industry-genesis' ),
									'description' => __( 'Default: 360px', 'industry-genesis' )
								),
								array(
									'type' => 'number',
									'key' => 'industry_logo_height',
									'label' => __( 'Logo Max Height', 'industry-genesis' ),
									'description' => __( 'Default: 80px', 'industry-genesis' )
								),
								array(
									'type' => 'checkbox',
									'key' => 'industry_sticky_header',
									'label' => __( 'Sticky Header', 'industry-genesis' ),
									'description' => __( 'Stick header to top of screen when scrolling up.', 'industry-genesis' )
								),
								array(
									'type' => 'checkbox',
									'key' => 'industry_scroll_to_top',
									'label' => __( 'Scroll to Top', 'industry-genesis' ),
									'description' => __( 'Enable a scroll-to-top button.', 'industry-genesis' )
								),
							),
						),
					),
				),
			),
		);

		return $settings;
	}

	/**
	 *	Add customizer controls
	 */
	public function register_customizer_fields( $wp_customize ) {

		$settings = $this->customizer_settings();

		$this->control_setup( $settings, $wp_customize );
	}

	/**
	 *	Loop through each customizer setting and set it up with the proper control
	 */
	public function control_setup( $settings, $wp_customize ) {

		foreach ( $settings['panels'] as $panel ) {

			// Create the panel(s)
			$wp_customize->add_panel( $panel['key'], array(
				'priority'       => isset( $panel['priority'] ) ? $panel['priority'] : '',
				'capability'     => isset( $panel['capability'] ) ? $panel['capability'] : '',
				'theme_supports' => isset( $panel['theme_supports'] ) ? $panel['theme_supports'] : '',
				'title'          => isset( $panel['title'] ) ? $panel['title'] : '',
				'description'    => isset( $panel['description'] ) ? $panel['description'] : '',
			) );

			foreach ( $panel['sections'] as $section ) {

				if ( ! isset( $section_priority ) ) {
					$section_priority = isset( $section['priority'] ) ? $section['priority'] : 1;
				}

				$wp_customize->add_section( $section['key'], array(
					'title' => isset( $section['title'] ) ? $section['title'] : '',
					'description' => isset( $section['description'] ) ? $section['description'] : '',
					'priority' => $section_priority,
					'panel'  => $panel['key'],
				) );

				if ( isset( $section['fields'] ) && is_array( $section['fields'] ) ) {

					foreach ( $section['fields'] as $field ) {

						if ( ! isset( $field_priority ) ) {
							$field_priority = 1;
						}

						switch ( $field['type'] ) {

							// Color picker
							case 'color':
								$wp_customize->add_setting( $field['key'], array(
									'default' => $field['default'] ? $field['default'] : '',
								) );
								$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $field['key'], array(
									'label' => isset( $field['label'] ) ? $field['label'] : '',
									'description' => isset( $field['description'] ) ? $field['description'] : '',
									'section' => $section['key'],
									'settings' => isset( $field['key'] ) ? $field['key'] : '',
									'priority' => $field_priority,
									'default' => isset( $field['default'] ) ? $field['default'] : '',
								) ) );
								break;

							// Text
							case 'text':
								$wp_customize->add_setting( $field['key'], array(
									'default' => isset( $field['default'] ) ? $field['default'] : '',
									'sanitize_callback' => array( $this, 'sanitize_number' ),
							    ) );
								$wp_customize->add_control( $field['key'], array(
									'label' => isset( $field['label'] ) ? $field['label'] : '',
									'description' => isset( $field['description'] ) ? $field['description'] : '',
									'section' => $section['key'],
									'type' => 'text',
									'priority' => $field_priority,
								) );
								break;

							// Numbers
							case 'number':
								$wp_customize->add_setting( $field['key'], array(
									'default' => isset( $field['default'] ) ? $field['default'] : '',
							    ) );
								$wp_customize->add_control( $field['key'], array(
									'label' => isset( $field['label'] ) ? $field['label'] : '',
									'description' => isset( $field['description'] ) ? $field['description'] : '',
									'section' => $section['key'],
									'type' => 'number',
									'priority' => $field_priority,
								) );
								break;

							// Checkbox
							case 'checkbox':
								$wp_customize->add_setting( $field['key'], array(
									'default' => isset( $field['default'] ) ? $field['default'] : '',
							    ) );
								$wp_customize->add_control( $field['key'], array(
									'label' => isset( $field['label'] ) ? $field['label'] : '',
									'description' => isset( $field['description'] ) ? $field['description'] : '',
									'section' => $section['key'],
									'type' => 'checkbox',
									'priority' => $field_priority,
								) );
								break;

							// Image uploader
							case 'image_upload':
								$wp_customize->add_setting( $field['key'] );
								$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
									$field['key'],
									array(
										'label' => isset( $field['label'] ) ? $field['label'] : '',
										'description' => isset( $field['description'] ) ? $field['description'] : '',
										'section'  => $section['key'],
										'settings' => $field['key'],
										'priority' => $field_priority,
									) ) );
								break;
							
							default:
								break;
						}

						$field_priority++;
					}
				}

				$section_priority++;
			}
		}
	}
}

endif;

new Industry_Child_Theme_Customizer_Settings;