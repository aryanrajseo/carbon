<?php
/**
 * Displays Secondary Menu
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<nav id="nav-secondary" class="nav-secondary" role="navigation"
     aria-label="<?php esc_attr_e( 'Secondary Menu', 'carbon' ); ?>">

	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'secondary',
			'menu_id'        => 'secondary-menu',
		)
	);
	?>


</nav><!-- #nav-secondary -->
