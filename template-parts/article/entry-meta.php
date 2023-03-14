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

<?php

if ( 'post' === get_post_type() ) {
	echo '<div class="entry-meta post-info">';
	if ( is_single() ) {
		carbon_posted_on();
	} else {
		carbon_posted_on();
	}
	echo '</div><!-- .entry-meta -->';
}
?>