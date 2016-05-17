<?php
/**
 *	Theme sidebars
 *
 *	@package Industry Genesis Child Theme
 *	@author Ren Ventura
 */

// Front page - main hero section
genesis_register_sidebar( array(
	'id'          => 'front-page-hero',
	'name'        => __( 'Front Page Hero', 'industry-genesis' ),
	'description' => __( 'This is the main/her section of the front page.', 'industry-genesis' ),
) );

// Front page sections
for ( $i = 1; $i <= CHILD_THEME_FRONT_PAGE_WIDGET_AREAS; $i++ ) { 
	genesis_register_sidebar( array(
		'id'          => "front-page-$i",
		'name'        => __( 'Front Page', 'industry-genesis' ) . ' ' . $i,
		'description' => __( "This is the front page $i section.", 'industry-genesis' ),
	) );
}

// Before Header
genesis_register_sidebar( array(
	'id'            => 'before-header',
	'name'          => __( 'Before Header', 'industry-genesis' ),
	'description'   => __( 'Before the header (good for contact info or CTAs)', 'industry-genesis' ),
) );

// Header Middle
genesis_register_sidebar( array(
	'id'            => 'header-middle',
	'name'          => __( 'Header Middle', 'industry-genesis' ),
	'description'   => __( 'Middle of the header (between logo and Header Right)', 'industry-genesis' ),
) );

// Front Page CTA
genesis_register_sidebar( array(
	'id'          => 'front-cta',
	'name'        => __( 'Front Page CTA', 'industry-genesis' ),
	'description' => __( 'Insert a call-to-action on the front page (after hero)', 'industry-genesis' ),
) );

// Footer CTA
genesis_register_sidebar( array(
	'id'          => 'footer-cta',
	'name'        => __( 'Footer CTA', 'industry-genesis' ),
	'description' => __( 'Insert a call-to-action just before the footer widgets and footer.', 'industry-genesis' ),
) );

// Footer
genesis_register_sidebar( array(
	'id'          => 'footer',
	'name'        => __( 'Footer', 'industry-genesis' ),
	'description' => __( 'Custom footer.', 'industry-genesis' ),
) );