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
    <div class="wrap">
		<?php do_action( 'carbon_before_title_area' ); ?>
		<?php
		// title-area
		get_template_part( 'template-parts/header/title-area' );
		?>
		<?php do_action( 'carbon_after_title_area' ); ?>
		<?php
		// primary menu
		if ( has_nav_menu( 'primary' ) ):
			get_template_part( 'template-parts/header/navigation' );
		endif;
		?>
		<?php do_action( 'carbon_after_primary_navigation' ); ?>
    </div><!-- .wrap -->
	<?php
	/**
	 * Fires to display the main header content.
	 */
	do_action( 'carbon_header' );
	?>
</header> <!-- #site-header -->