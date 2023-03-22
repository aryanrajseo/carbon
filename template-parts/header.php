<?php
/**
 * Displays site header
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<header id="site-header" class="site-header" role="banner">
	<?php
	/**
	 * Fires under the <header>.
	 */
	do_action( 'carbon_header_open' );
	?>
    <div class="wrap">
		<?php
		/**
		 * Fires before title-area.
		 */
        do_action( 'carbon_before_title_area' );
        ?>
		<?php
		// title-area
		get_template_part( 'template-parts/header/title-area' );
		?>
		<?php
		/**
		 * Fires after title-area.
		 */
        do_action( 'carbon_after_title_area' );
        ?>
		<?php
		/**
		 * Fires under the <header>
		 */
		do_action( 'carbon_header' );
		?>

		<?php
		/**
		 * Fires before primary menu.
		 */
		do_action( 'carbon_before_primary_navigation' );
		?>

		<?php
		// primary menu
		if ( has_nav_menu( 'primary' ) ):
			get_template_part( 'template-parts/header/navigation' );
		endif;
		?>
		<?php
		/**
		 * Fires after primary menu.
		 */
        do_action( 'carbon_after_primary_navigation' );
        ?>
    </div><!-- .wrap -->
	<?php
	/**
	 * Fires under the <header>.
	 */
	do_action( 'carbon_header_close' );
	?>
</header> <!-- #site-header -->