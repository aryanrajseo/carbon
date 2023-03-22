<?php
/**
 * Displays Site Footer
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<footer id="site-footer" class="site-footer" role="contentinfo">
    <div class="wrap">
		<?php
		if ( has_nav_menu( 'secondary' ) ) :
			?>
			<?php
			// displays secondary-navigation
			get_template_part( 'template-parts/footer/navigation-secondary', 'secondary' );
			?>
		<?php
		endif;
		?>

		<?php
		/**
		 * Fires under the site-footer.
		 */
		do_action( 'carbon_footer' );
		?>

    </div>
	<?php
	/**
	 * Fires copyright.
	 */
    do_action( 'carbon_footer_copyright' );
    ?>

</footer> <!-- #site-footer -->