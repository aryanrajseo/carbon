<?php
/**
 * Displays page-break paginated links
 * @link https://developer.wordpress.org/reference/functions/wp_link_pages/
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

wp_link_pages(
	array(
		'before'         => '<div class="page-links">' . __( 'Pages:', 'carbon' ),
		'after'          => '</div>',
		'link_before'    => '<span class="page-number">',
		'link_after'     => '</span>',
		'next_or_number' => 'number',
	)
);