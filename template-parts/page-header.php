<?php
/**
 * displaying page header
 *
 * @link
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<section id="page-header" class="page-header" aria-label="Page">
    <div class="wrap">

		<?php if ( is_home() && ! is_front_page() ) : ?>
            <h1 class="page-title"><?php single_post_title(); ?></h1>

		<?php elseif ( is_front_page() && ! is_home() ) : ?>
            <h2 class="page-title"><?php single_post_title(); ?></h2>

		<?php elseif ( is_singular() ) : ?>
			<?php
			$title = get_the_title();
			printf( '<h1 class="page-title">%s</h1>', $title );
			if ( has_excerpt() ) {
				$excerpt = get_the_excerpt( $post->ID );
				printf( '<div class="excerpt-info">%s</div>', $excerpt );
			}
			?>

		<?php elseif ( is_archive() ) : ?>
			<?php
			$term_description = get_the_archive_description();
			?>
            <h1 class="archive-title page-title">
				<?php
				//if ( is_author() ) { // carbon_filter_the_archive_title in inc/general.php
				//	$author = get_the_author();
				//	printf( '<div class="author-title">%s</div>', $author );
				//} else {
				the_archive_title();
				//}
				?>
            </h1>
			<?php
			if ( ! empty( $term_description ) ) :

				if ( is_author() ) {
					printf( '<div class="author-info">%s</div>', $term_description );
				} else {
					printf( '<div class="archive-description">%s</div>', $term_description );
				}
			endif;
			?>

		<?php endif; ?>

		<?php if ( is_404() ) : ?>
            <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'carbon' ); ?></h1>
		<?php endif; ?>

		<?php if ( is_search() ) : ?>
			<?php if ( have_posts() ) { ?>
                <h1 class="page-title">
					<?php
					/* translators: Search query. */
					printf( __( 'Search Results for: %s', 'carbon' ), '<span>' . get_search_query() . '</span>' );
					?>
                </h1>
			<?php } else { ?>
                <h1 class="page-title"><?php _e( 'Nothing Found', 'carbon' ); ?></h1>
			<?php } endif; ?>

    </div>
</section><!-- .page-header -->