<?php
/**
 * The Footer Widgets
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
<div id="footer-widgets" class="footer-widgets">
    <h2 class="sidebar-title screen-reader-text">Footer</h2>
    <div class="wrap">
		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
            <div id="footer-widgets-1" class="footer-widgets-1 footer-widget-area">
				<?php dynamic_sidebar( 'footer-1' ); ?>
            </div>
		<?php else : ?>
            <!-- Time to add some widgets! -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
            <div id="footer-widgets-2" class="footer-widgets-2 footer-widget-area">
				<?php dynamic_sidebar( 'footer-2' ); ?>
            </div>
		<?php else : ?>
            <!-- Time to add some widgets! -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
            <div id="footer-widgets-3" class="footer-widgets-3 footer-widget-area">
				<?php dynamic_sidebar( 'footer-3' ); ?>
            </div>
		<?php else : ?>
            <!-- Time to add some widgets! -->
		<?php endif; ?>
    </div>
</div> <!-- #footer-widgets -->