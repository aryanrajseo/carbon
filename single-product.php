<?php
/**
 * Template part for displaying single product
 *
 * @link
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<?php
/**
 * Fires before the content, after the content layout wrap opening markup.
 */
do_action( 'carbon_before_content' );
?>


<main class="site-content content" id="content" role="main">

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="inside-article">

	<?php
	// Start the Loop.
	while ( have_posts() ) :
		the_post();
	endwhile; // End the loop.
	/**
	 * Check if WooCommerce is activated
	 */
	if ( ! function_exists( 'is_woocommerce_activated' ) ) {
		wc_get_template_part( 'content', 'single-product' );
	}


	?>
        </div><!-- .inside article -->
    </article><!-- article#post-<?php the_ID(); ?> -->

</main><!-- #main content -->

<?php
/**
 * Fires after the content, before the main content layout wrap closing markup.
 */
do_action( 'carbon_after_content' );
?>

<?php get_footer(); ?>







