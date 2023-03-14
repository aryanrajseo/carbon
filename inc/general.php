<?php
/**
 * Custom functions for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Carbon
 * @author Aryan Raj
 * @since cf 0.0.1
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


add_filter( 'http_request_args', 'carbon_dont_update_theme', 5, 2 );
/**
 * Don't Update Theme.
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update.
 *
 * @since  0.0.1
 *
 * @param  array  $request Request arguments.
 * @param  string $url     Request url.
 *
 * @return array  request arguments
 */
function carbon_dont_update_theme( $request, $url ) {

    // Not a theme update request. Bail immediately.
    if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) ) {
        return $request;
    }

    $themes = unserialize( $request['body']['themes'] );

    unset( $themes[ get_option( 'template' ) ] );
    unset( $themes[ get_option( 'stylesheet' ) ] );

    $request['body']['themes'] = serialize( $themes );

    return $request;

}


add_action( 'do_faviconico', function () {
	//Check for icon with no default value
	if ( $icon = get_site_icon_url( 32 ) ) {
		//Show the icon
		wp_redirect( $icon );
	} else {
		//Show nothing
		header( 'Content-Type: image/vnd.microsoft.icon' );
	}
	exit;
} );


// Adds the front page intro form text.
add_action( 'carbon_footer_copyright', 'carbon_do_copyright' );

add_filter( 'copyright-text_output', 'do_shortcode' );

/**
 * Remove paragraph tags from content.
 *
 * @param string $content Content possibly containing paragraph tags.
 *
 * @return string Content without paragraph tags.
 * @since 2.5.0
 *
 */
function carbon_strip_p_tags( $content ) {

	return preg_replace( '/<div\b[^>]*>(.*?)<\/div>/i', '$1', $content );

}

/**
 * Adds front page intro form.
 *
 * @since 1.2.0
 */
function carbon_do_copyright() {

	$creds_text = wp_kses_post( get_theme_mod( 'copyright-text' ) );
	$output     = '<div class="wrap">' . carbon_strip_p_tags( $creds_text ) . '</div>';

	$output = apply_filters( 'copyright-text_output', $output, '', $creds_text );

	echo $output;

}

// https://developer.wordpress.org/reference/functions/get_the_archive_title/
if ( ! function_exists( 'carbon_filter_the_archive_title' ) ) {
	add_filter( 'get_the_archive_title', 'carbon_filter_the_archive_title' );
	/**
	 * Alter the_archive_title() function to match our original archive title function
	 *
	 * @param string $title The archive title.
	 *
	 * @return string The altered archive title
	 * @since 1.3.45
	 *
	 */
	function carbon_filter_the_archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		} elseif ( is_author() ) {
			/*
			 * Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			 */
			the_post();

			$title = sprintf(
				'%1$s<span class="vcard">%2$s</span>',
				get_avatar( get_the_author_meta( 'ID' ), 64 ),
				get_the_author()
			);

			/*
			 * Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();
		}

		return $title;

	}
}

