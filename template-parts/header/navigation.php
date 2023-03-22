<?php
/**
 * Displays Primary Menu
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<button id="mobile-nav-primary" class="menu-toggle" aria-expanded="false" aria-haspopup="true"
        aria-controls="nav-primary">
    Menu
	<?php
	?>
</button>
<nav id="nav-primary" class="nav-primary carbon-responsive-menu" role="navigation" aria-labelledby="mobile-nav-primary"
     aria-label="<?php esc_attr_e( 'Primary Menu', 'carbon' ); ?>">

	<?php
	/**
	 * Fires under after nav open.
	 */
	do_action( 'carbon_after_primary_nav_open' );
	?>

	<?php
	// @ https://developer.wordpress.org/reference/functions/wp_nav_menu/
	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'menu_id'         => 'primary-menu',
			'menu'            => '',
			'menu_class'      => 'menu carbon-nav-menu primary-menu',
			'container'       => 'div',
			'container_class' => 'nav-container wrap',
			'container_id'    => 'nav-container',
		)
	);
	?>

	<?php
	/**
	 * Fires under before nav close.
	 */
	do_action( 'carbon_before_primary_nav_close' );
	?>

</nav><!-- #nav-primary -->
