<?php
/**
 * Carbon Framework.
 *
 * This file adds the landing page template to the Carbon Framework Theme.
 *
 * Template Name: Landing
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="site-container" class="site-container">
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'carbon' ); ?></a>
    <div id="site-inner" class="site-inner">
        <div id="content">

			<?php
			// Custom loop, remove all hooks except entry content.
			if ( have_posts() ) :
				the_post();
				the_content();
			endif;
			?>

        </div><!-- #content -->
    </div><!-- #site-inner -->
</div><!-- #site-container -->

<?php wp_footer(); ?>
</body>
</html>