<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

		<?php if ( is_home() && ! is_front_page() ) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
		<?php else : ?>
            <header class="page-header">
                <h2 class="page-title"><?php _e( 'Latest Posts', 'carbon' ); ?></h2>
            </header>
		<?php endif; ?>

		<?php

		// Get $post if you're inside a function.
		global $post;
		if ( have_posts() ) :

			// Start the Loop.
			while ( have_posts() ) :
				the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that
				 * will be used instead.
				 */
				get_template_part( 'template-parts/content' ); // article or main loop
				// End the loop.
			endwhile;
			// This is a Blog, Archive Post Pagination.
			get_template_part( 'template-parts/pagination', 'pagination' );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/no-content', 'none' );
		endif;
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