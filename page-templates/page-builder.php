<?php
/**
 * Carbon Framework.
 *
 * This file adds the page builder template to the Carbon Framework Theme.
 *
 * Template Name: Page Builder
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Get site-header.
get_header();

// Custom loop, remove all hooks except entry content.
if ( have_posts() ) :
	the_post();
	the_content();
endif;

// Get site-footer.
get_footer();
