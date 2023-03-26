<?php

/**
 * Carbon functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function carbon_setup() {


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	//add_image_size( 'carbon-featured-image', 1280, 720, true );

	//add_image_size( 'carbon-thumbnail-avatar', 100, 100, true );


	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary'   => __( 'Primary Menu', 'carbon' ),
			'secondary' => __( 'Secondary Menu', 'carbon' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://wordpress.org/support/article/post-formats/
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'       => 250,
			'height'      => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add theme support for custom header.
	add_theme_support( 'custom-header' );

	// Add theme support for selective refresh for widgets.
	//add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	  */
	add_editor_style( array( 'assets/css/editor-style.css', ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

    // Add support for WooCommerce Plugin.
    add_theme_support( 'woocommerce' );

}

add_action( 'after_setup_theme', 'carbon_setup' );


/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Carbon 1.0.0
 */
function carbon_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action( 'wp_head', 'carbon_javascript_detection', 0 );


/**
 * Echo out the script that changes 'no-js' class to 'js'.
 *
 * @since 1.0.0
 */
function js_nojs_script() {
	?>
    <script>
        //<![CDATA[
        (function () {
            var c = document.body.classList;
            c.remove('no-js');
            c.add('js');
        })();
        //]]>
    </script>
	<?php
}

add_action( 'wp_body_open', 'js_nojs_script', 1 );

/**
 * Enqueues scripts and styles.
 */
function carbon_scripts() {

	// Add custom fonts, used in the main stylesheet.
	//wp_enqueue_style( 'carbon-fonts', get_theme_file_uri( '/assets/css/typography.css' ), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'carbon-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );


	// Theme block stylesheet.
	//wp_enqueue_style( 'carbon-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'carbon-style' ), '20190105' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'carbon_scripts' );


/**
 * Enqueues styles for the block-based editor.
 *
 * @since Carbon 1.8
 */
function carbon_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'carbon-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ), array(), '20190328' );
	// Add custom fonts.
	//wp_enqueue_style( 'carbon-fonts', carbon_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'carbon_block_editor_styles' );


/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';
require get_parent_theme_file_path( '/inc/template-tags.php' );
require get_parent_theme_file_path( '/inc/test.php' );

// Customizer Functions
require get_parent_theme_file_path( '/inc/customizer.php' );
// General Functions
require get_parent_theme_file_path( '/inc/general.php' );
// Sidebar or Widgets Functions
require get_parent_theme_file_path( '/inc/widgets.php' );
// Sidebar or Widgets Functions
require get_parent_theme_file_path( '/inc/woocommerce.php' );



