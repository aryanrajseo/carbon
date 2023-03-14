<?php
/**
 * Custom functions for Customizer
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// https://developer.wordpress.org/themes/customize-api/
// https://codex.wordpress.org/Theme_Customization_API
// https://developer.wordpress.org/reference/hooks/customize_register/

add_action( 'customize_register', 'register_theme_customizer' );
/*
 * Register Our Customizer Stuff Here
 */
function register_theme_customizer( $wp_customize ) {

	$year      = date( 'Y' );
	$copyright = '';

	$sitename = get_bloginfo( 'name' );
	$sitelink = home_url();

	$default_credits = 'Copyright &#x000A9;&nbsp;' . $year . ' &#x000B7; <a href="' . $sitelink . '">' . $sitename . '</a>';


	// Site Copyright.
	$wp_customize->add_section(
		'site-copyright',
		[
			'description' => sprintf( '<strong>%s</strong>', __( 'Modify the Site Credits.', 'carbon' ) ),
			'title'       => __( 'Site Copyright', 'carbon' ),
			'panel'       => '',
		]
	);

	// Add Setting for SIte Copyright
	$wp_customize->add_setting(
		'copyright-text',
		[
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh',
		]
	);

	$wp_customize->add_control(
		'copyright-text',
		[
			'form'     => __( 'Change the Copyright Content.', 'carbon' ),
			'label'    => __( 'Copyright Section', 'carbon' ),
			'section'  => 'site-copyright',
			'settings' => 'copyright-text',
			'type'     => 'textarea',
		]
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'copyright-text',
			[
				'selector'        => '.site-credits',
				'settings'        => [ 'copyright-text' ],
				'render_callback' => function () {
					//return get_theme_mod( 'essence-form-text' );
					//return apply_filters('essence-form-text_output',  'the_content');
					return is_null( apply_filters( 'copyright-text_output', null, '', '' ) );
				},
			]
		);
	}

}
    
