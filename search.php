<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

        <header class="page-header">
			<?php if ( have_posts() ) : ?>
                <h1 class="page-title">
					<?php
					/* translators: Search query. */
					printf( __( 'Search Results for: %s', 'carbon' ), '<span>' . get_search_query() . '</span>' );
					?>
                </h1>
			<?php else : ?>
                <h1 class="page-title"><?php _e( 'Nothing Found', 'carbon' ); ?></h1>
			<?php endif; ?>
        </header><!-- .entry-header search page -->


		<?php
		if ( have_posts() ) :
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'excerpt' );


			endwhile; // End the loop.

			// This is a Blog, Archive Post Pagination.
			get_template_part( 'template-parts/pagination', 'pagination' );
		else :
			?>

            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'carbon' ); ?></p>
			<?php
			get_search_form();

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

<?php
get_footer();

