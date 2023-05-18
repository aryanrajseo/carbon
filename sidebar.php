<?php
/**
 * The Sidebar
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

$layout       = get_post_meta( get_the_ID(), 'layout_option', true );
$layout_class = [];
if ( $layout === 'no-sidebar' || $layout === 'content-sidebar' || $layout === 'sidebar-content' || $layout === 'sidebar-content-sidebar' ) {
	// Hide the primary sidebar if layout is set to "no-sidebar" or "sidebar-content" or "sidebar-content-sidebar"
	$layout_class[] = 'no-primary-sidebar';

	if ( $layout === 'content-sidebar' ) {
		// Add secondary sidebar if layout is set to "sidebar-content" or "sidebar-content-sidebar"
		$layout_class[] = 'has-primary-sidebar';
	}

	if ( $layout === 'sidebar-content' || $layout === 'sidebar-content-sidebar' ) {
		// Add secondary sidebar if layout is set to "sidebar-content" or "sidebar-content-sidebar"
		$layout_class[] = 'has-primary-secondary-sidebar';
	}
}
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) && ( $layout === 'content-sidebar' || $layout === 'sidebar-content-sidebar' ) ) : ?>
	<aside id="sidebar-primary" class="sidebar-primary sidebar" role="complementary" aria-label="Primary Sidebar">
		<?php
		/**
		 * Fires before primary sidebar widget area.
		 */
		do_action( 'carbon_before_primary_sidebar_widget_area' );
		?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<?php
		/**
		 * Fires after primary sidebar widget area.
		 */
		do_action( 'carbon_after_primary_sidebar_widget_area' );
		?>
	</aside><!-- .sidebar-primary -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-2' ) && ( $layout === 'sidebar-content' || $layout === 'sidebar-content-sidebar' ) ) : ?>
	<aside id="sidebar-secondary" class="sidebar-secondary sidebar" role="complementary" aria-label="Secondary Sidebar">
		<?php
		/**
		 * Fires before secondary sidebar widget area.
		 */
		do_action( 'carbon_before_secondary_sidebar_widget_area' );
		?>
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
		<?php
		/**
		 * Fires after secondary sidebar widget area.
		 */
		do_action( 'carbon_after_secondary_sidebar_widget_area' );
		?>
	</aside><!-- .sidebar-secondary -->
<?php endif; ?>
