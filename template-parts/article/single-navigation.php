<?php
/**
 * Post Navigation
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

the_post_navigation(
	array(
		'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'carbon' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'carbon' ) . '</span> <span class="nav-title"><span class="prev"></span>%title</span>',
		'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'carbon' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'carbon' ) . '</span> <span class="nav-title">%title<span class="next"></span></span>',
	)
);