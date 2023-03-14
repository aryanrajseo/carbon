<?php
/**
 * The Primary Sidebar
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
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

if ( is_active_sidebar( 'sidebar-1' ) ) :
	?>
    <aside id="sidebar-primary" class="sidebar-primary sidebar" role="complementary" aria-label="Primary Sidebar">
		<?php
		/**
		 * Fires before primary sidebar widget area.
		 */
		do_action( 'carbon_before_primary_sidebar_widget_area' );
		?>
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) {

			?>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<?php } else { ?>
            <!-- Time to add some widgets! -->
		<?php } ?>
		<?php
		/**
		 * Fires after primary sidebar widget area.
		 */
		do_action( 'carbon_after_primary_sidebar_widget_area' );
		?>
    </aside><!-- .sidebar-primary -->
<?php
endif;
?>


<?php

if ( is_active_sidebar( 'sidebar-2' ) ) :
	?>
    <aside id="sidebar-secondary" class="sidebar-secondary sidebar" role="complementary" aria-label="secondary Sidebar">
		<?php
		/**
		 * Fires before secondary sidebar widget area.
		 */
		do_action( 'carbon_before_secondary_sidebar_widget_area' );
		?>
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) {

			?>
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		<?php } else { ?>
            <!-- Time to add some widgets! -->
		<?php } ?>
		<?php
		/**
		 * Fires after secondary sidebar widget area.
		 */
		do_action( 'carbon_after_secondary_sidebar_widget_area' );
		?>
    </aside><!-- .sidebar-secondary -->
<?php
endif;
?>
