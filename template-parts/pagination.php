<?php
/**
 * Displays Pagination
 * @link https://developer.wordpress.org/reference/functions/the_posts_pagination/
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

the_posts_pagination(
	array(
		'prev_text'          => '<span class="pagination-previous">' . __( '&laquo; Previous Page', 'carbon' ) . '</span>',
		'next_text'          => '<span class="pagination-next">' . __( 'Next Page &raquo;', 'carbon' ) . '</span>',
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'carbon' ) . ' </span>',
	)
);