<?php
/**
 * The template for displaying archive pages
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

<main class="site-content content" id="content" role="main">

	<?php if ( have_posts() ) : ?>
        <header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
        </header><!-- .page-header -->
	<?php endif; ?>

	<?php
	if ( have_posts() ) :
		?>
		<?php
		// Start the Loop.
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that
			 * will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;
		// This is a Blog, Archive Post Pagination.
		get_template_part( 'template-parts/pagination', 'pagination' );

	else :

		get_template_part( 'template-parts/no-content', 'none' );

	endif;
	?>

</main><!-- #main content -->

<?php get_footer(); ?>
