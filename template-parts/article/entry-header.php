<?php
/**
 * Post meta
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<header class="entry-header">

	<?php

	if ( is_front_page() && is_home() ) {
		the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
	} elseif ( is_front_page() && ! is_home() ) {
		the_title( '<h2 class="entry-title">', '</h1>' );
	} elseif ( is_singular() ) {
		the_title( '<h1 class="entry-title">', '</h2>' );
	} elseif ( is_product_category() || is_product_tag() ) {
		the_title( '<h1 class="entry-title">', '</h2>' );
	} else {
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}
	?>

	<?php
	// article post meta, post info
	get_template_part( 'template-parts/article/entry-meta' )
	?>

</header><!-- .entry-header -->
