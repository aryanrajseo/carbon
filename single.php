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

<div id="primary" class="content-area">
	    <?php
	    /**
	     * Fires before #main.
	     */
	    do_action( 'carbon_before_main' );
	    ?>
    <main id="main" class="site-main" role="main">

		<?php
		// Start the Loop.
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			// If is the single post and comments are open or we have at least one comment, load up the comment template.
			if ( is_singular('post') && comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// post navigation
			get_template_part( '/template-parts/content/single-navigation' );
		endwhile; // End the loop.
		?>

    </main><!-- #main -->
	    <?php
	    /**
	     * Fires after #main.
	     */
	    do_action( 'carbon_after_main' );
	    ?>
</div><!-- .content-area -->

<?php get_footer(); ?>