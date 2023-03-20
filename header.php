<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
/**
 * Fires immediately after the body element opening markup.
 */
do_action( 'carbon_before' );

?>

<div id="site-container" class="site-container">
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'carbon' ); ?></a>
	<?php
	/**
	 * Fires immediately after the site container opening markup, before `carbon_header` action hook.
	 */
	do_action( 'carbon_before_header' );
	?>

	<?php get_template_part( 'template-parts/header' ); ?>

	<?php
	/**
	 * Fires immediately after the `carbon_header` action hook, before the site inner opening markup.
	 */
	do_action( 'carbon_after_header' );
	?>
    <div id="site-inner" class="site-inner">

		<?php

		// show only if it is not default post page and template-parts/article/entry-header is inactive. Woo single product is restricted.
		if ( ! is_front_page() ||! is_home() ) {
            if ( ! is_product() ) {
	            // get_template_part( 'template-parts/page-header' );
            }
		}

		?>
		<?php
		/**
		 * Fires after the header, before the content layout wrap.
		 */
		do_action( 'carbon_before_content_layout_wrap' );
		?>
        <div id="content-layout-wrap" class="content-layout-wrap">
			<?php
			// fires before content-area
			do_action( 'carbon_before_content-area' );
			?>
            <div id="content" class="site-content">


    
