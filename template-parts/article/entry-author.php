<?php
/**
 * Template part for displaying author bio
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


<div class="author-info">
    <h2 class="author-heading"><?php _e( 'Published by', 'carbon' ); ?></h2>
    <div class="author-avatar">
		<?php
		/**
		 * Filters the author bio avatar size.
		 *
		 * @param int $size The avatar height and width size in pixels.
		 *
		 * @since Twenty Fifteen 1.0
		 *
		 */
		$author_bio_avatar_size = apply_filters( 'carbon_author_bio_avatar_size', 56 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
    </div><!-- .author-avatar -->

    <div class="author-description">
        <h3 class="author-title"><?php echo get_the_author(); ?></h3>

        <p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
            <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
               rel="author">
				<?php
				/* translators: %s: Author display name. */
				printf( __( 'View all posts by %s', 'carbon' ), get_the_author() );
				?>
            </a>
        </p><!-- .author-bio -->

    </div><!-- .author-description -->
</div><!-- .author-info -->

