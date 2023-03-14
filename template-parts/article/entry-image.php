<?php
/**
 * Post meta
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php
global $post;
$permalink      = get_the_permalink();
$post_thumbnail = get_the_post_thumbnail();

//if ( 'post' === get_post_type() && has_post_thumbnail( $post->ID ) ) {
if ( has_post_thumbnail( $post->ID ) ) {
	if ( is_singular() ) {
		printf( '<div class="entry-thumbnail">' . $post_thumbnail . '</div><!-- .entry-thumbnail -->' );
	} else {
		printf( '<div class="entry-thumbnail"><a href="' . $permalink . '"> ' . $post_thumbnail . '</a></div><!-- .entry-thumbnail -->' );
	}

}
?>