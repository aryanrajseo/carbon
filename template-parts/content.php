<?php
/**
 * Template part for displaying posts
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

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="inside-article">

		<?php
		// hide on single post/page to show template-parts/page-header.php
		//if ( ! is_singular() ) :
		get_template_part( 'template-parts/article/entry-header' );
		//endif;

		?>

		<?php
		if ( ! is_singular() ) :
			get_template_part( 'template-parts/article/entry-image' );
		endif;
		?>

        <div class="entry-content">
			<?php

			// master conditional loop post content view.
			// we will show full content for other post format excluding default "standard".
			if ( ! has_post_format( '' ) && is_home() || is_archive() ) {
				the_excerpt();

			} // should show full content for singular post types.
            elseif ( is_singular() ) {
				the_content();
			} else {
				the_content();
			}

			// for single post, page type, page-break pagination.
			if ( is_singular() ) :
				get_template_part( 'template-parts/page-break', 'pagination' );
			endif;
			?>
        </div><!-- .entry-content -->
		<?php
		get_template_part( 'template-parts/article/entry-footer' );
		?>

		<?php
		// Author bio.
		if ( is_singular('post') && get_the_author_meta( 'description' ) ) :
			get_template_part( 'template-parts/article/entry-author' );
		endif;
		?>

    </div><!-- .inside article -->
</article><!-- article#post-<?php the_ID(); ?> -->
