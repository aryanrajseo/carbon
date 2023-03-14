<?php
/**
 * Displays site header branding
 * @link https://developer.wordpress.org/reference/functions/bloginfo/
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="title-area">
	<?php the_custom_logo(); ?>
	<?php if ( is_front_page() ) : ?>
        <h1 class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
        </h1>
	<?php else : ?>
        <p class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
        </p>
	<?php endif; ?>
	<?php
	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) :
		?>
        <p class="site-description"><?php echo $description; ?></p>
	<?php endif; ?>
</div><!-- .title-area -->

