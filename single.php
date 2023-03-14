<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php
/**
 * Fires before the content, after the content layout wrap opening markup.
 */
do_action( 'carbon_before_content' );
?>


    <main class="site-content content" id="content" role="main">

		<?php
		// Start the Loop.
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// post navigation
			get_template_part( '/template-parts/content/single-navigation' );
		endwhile; // End the loop.
		?>

    </main><!-- #main content -->

<?php
/**
 * Fires after the content, before the main content layout wrap closing markup.
 */
do_action( 'carbon_after_content' );
?>

<?php get_footer(); ?>