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

<footer class="entry-footer">
	<?php
	if ( is_single() ) {
		// post meta for single post
		carbon_entry_footer();
		//carbon_entry_meta();
	} else {
		// for archives
		carbon_entry_footer();
	}
	?>

</footer><!-- .entry-footer -->
