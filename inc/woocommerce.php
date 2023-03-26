<?php
/**
 * Woocommerce Specific features and functions.
 *
 * @link
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'after_setup_theme', 'carbon_setup_woocommerce' );
/**
 * Set up WooCommerce
 *
 * @since 0.0.2
 */
function carbon_setup_woocommerce() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	// Add support for WC features.
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Remove default WooCommerce wrappers.
	//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	// sidebar
	//add_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 50 );
}
