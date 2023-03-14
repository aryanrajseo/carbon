<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<main class="site-content content" id="content" role="main">

    <section class="error-404 not-found">
        <header class="entry-header">
            <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'carbon' ); ?></h1>
        </header><!-- .page-header -->

        <div class="entry-content">
            <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'carbon' ); ?></p>

			<?php get_search_form(); ?>

        </div><!-- .page-content -->
    </section><!-- .error-404 -->

</main><!-- #main content -->


<?php get_footer(); ?>
