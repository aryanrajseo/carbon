<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage
 * @since
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'carbon_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function carbon_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
		/* translators: %s: Post author. */
			__( 'by %s', 'carbon' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . carbon_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
	}
endif;

if ( ! function_exists( 'carbon_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function carbon_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
		/* translators: %s: Post date. */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'carbon' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;


if ( ! function_exists( 'carbon_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function carbon_entry_footer() {

		$separate_meta = wp_get_list_item_separator();

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( ( ( carbon_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

			//echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && carbon_categorized_blog() ) || $tags_list ) {
					echo '<div class="cat-tags-links">';

					// Make sure there's more than one category before displaying.
					if ( $categories_list && carbon_categorized_blog() ) {
						echo '<span class="cat-links"><span class="screen-reader-text">' . __( 'Categories', 'carbon' ) . '</span>' . $categories_list . '</span>';
					}

					if ( $tags_list && ! is_wp_error( $tags_list ) ) {
						echo '<span class="tags-links"><span class="screen-reader-text">' . __( 'Tags', 'carbon' ) . '</span>' . $tags_list . '</span>';
					}

					echo '</div>';
				}
			}

			carbon_edit_link();

			//echo '</footer> <!-- .entry-footer -->';
		}
	}
endif;


if ( ! function_exists( 'carbon_edit_link' ) ) :
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives us a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	function carbon_edit_link() {
		edit_post_link(
			sprintf(
			/* translators: %s: Post title. Only visible to screen readers. */
				__( ' Edit <span class="screen-reader-text"> "%s"</span> ', 'carbon' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

// revisit this section
/**
 * Display a front page section.
 *
 * @param WP_Customize_Partial $partial Partial associated with a selective refresh request.
 * @param int $id Front page section to display.
 */
function carbon_front_page_section( $partial = null, $id = 0 ) {
	if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
		// Find out the ID and set it up during a selective refresh.
		global $carboncounter;

		$id = str_replace( 'panel_', '', $partial->id );

		$carboncounter = $id;
	}

	global $post; // Modify the global post object before setting up post data.
	if ( get_theme_mod( 'panel_' . $id ) ) {
		$post = get_post( get_theme_mod( 'panel_' . $id ) );
		setup_postdata( $post );
		set_query_var( 'panel', $id );

		get_template_part( 'template-parts/page/content', 'front-page-panels' );

		wp_reset_postdata();
	} elseif ( is_customize_preview() ) {
		// The output placeholder anchor.
		printf(
			'<article class="panel-placeholder panel carbon-panel carbon-panel%1$s" id="panel%1$s">' .
			'<span class="carbon-panel-title">%2$s</span></article>',
			$id,
			/* translators: %s: The section ID. */
			sprintf( __( 'Front Page Section %s Placeholder', 'carbon' ), $id )
		);
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function carbon_categorized_blog() {
	$category_count = get_transient( 'carbon_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'carbon_categories', $category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}


/**
 * Flush out the transients used in carbon_categorized_blog.
 */
function carbon_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'carbon_categories' );
}

add_action( 'edit_category', 'carbon_category_transient_flusher' );
add_action( 'save_post', 'carbon_category_transient_flusher' );

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backward compatibility to support pre-5.2.0 WordPress versions.
	 *
	 * @since Twenty Seventeen 2.2
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since Twenty Seventeen 2.2
		 */
		do_action( 'wp_body_open' );
	}
endif;

// This section required edits


if ( ! function_exists( 'carbon_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * Create your own carbon_entry_meta() function to override in a child theme.
	 *
	 * @since Carbon 1.0
	 */
	function carbon_entry_meta() {
		if ( 'post' === get_post_type() ) {
			$author_avatar_size = apply_filters( 'carbon_author_avatar_size', 49 );
			printf(
				'<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>',
				get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
				_x( 'Author', 'Used before post author name.', 'carbon' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}

		if ( in_array( get_post_type(), array( 'post', 'attachment' ), true ) ) {
			carbon_entry_date();
		}

		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			printf(
				'<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
				sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'carbon' ) ),
				esc_url( get_post_format_link( $format ) ),
				get_post_format_string( $format )
			);
		}

		if ( 'post' === get_post_type() ) {
			carbon_entry_taxonomies();
		}

		if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: Post title. Only visible to screen readers. */
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'carbon' ), get_the_title() ) );
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'carbon_entry_date' ) ) :
	/**
	 * Prints HTML with date information for current post.
	 *
	 * Create your own carbon_entry_date() function to override in a child theme.
	 *
	 * @since Carbon 1.0
	 */
	function carbon_entry_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf(
			'<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'carbon' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
endif;

if ( ! function_exists( 'carbon_entry_taxonomies' ) ) :
	/**
	 * Prints HTML with category and tags for current post.
	 *
	 * Create your own carbon_entry_taxonomies() function to override in a child theme.
	 *
	 * @since Carbon 1.0
	 */
	function carbon_entry_taxonomies() {
		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'carbon' ) );
		if ( $categories_list && carbon_categorized_blog() ) {
			printf(
				'<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'carbon' ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'carbon' ) );
		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			printf(
				'<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', 'carbon' ),
				$tags_list
			);
		}
	}
endif;

if ( ! function_exists( 'carbon_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * Create your own carbon_post_thumbnail() function to override in a child theme.
	 *
	 * @since Carbon 1.0
	 */
	function carbon_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

            <div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

		<?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
            </a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'carbon_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own carbon_excerpt() function to override in a child theme.
	 *
	 * @param string $css_class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 *
	 * @since Carbon 1.0
	 *
	 */
	function carbon_excerpt( $css_class = 'entry-summary' ) {
		$css_class = esc_attr( $css_class );

		if ( has_excerpt() || is_search() ) :
			?>
            <div class="<?php echo $css_class; ?>">
				<?php the_excerpt(); ?>
            </div><!-- .<?php echo $css_class; ?> -->
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'carbon_excerpt_more' ) && ! is_admin() ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
	 * a 'Continue reading' link.
	 *
	 * Create your own carbon_excerpt_more() function to override in a child theme.
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 * @since Carbon 1.0
	 *
	 */
	function carbon_excerpt_more() {
		$link = sprintf(
			'<a href="%1$s" class="more-link">%2$s</a>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Post title. Only visible to screen readers. */
			sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'carbon' ), get_the_title( get_the_ID() ) )
		);

		return ' &hellip; ' . $link;
	}

	add_filter( 'excerpt_more', 'carbon_excerpt_more' );
endif;


if ( ! function_exists( 'carbon_content_more' ) ) {
	add_filter( 'the_content_more_link', 'carbon_content_more' );
	/**
	 * Prints the read more HTML to post content using the more tag.
	 *
	 * @param string $more The string shown within the more link.
	 *
	 * @return string The HTML for the more link
	 * @since 0.1
	 *
	 */
	function carbon_content_more() {
		return apply_filters(
			'carbon_content_more_link_output',
			sprintf(
				'<p class="read-more-container"><a title="%1$s" class="read-more content-read-more" href="%2$s" aria-label="%4$s">%3$s</a></p>',
				the_title_attribute( 'echo=0' ),
				esc_url( get_permalink( get_the_ID() ) . apply_filters( 'carbon_more_jump', '#more-' . get_the_ID() ) ),
				__( 'Read more', 'carbon' ),
				sprintf(
				/* translators: Aria-label describing the read more button */
					_x( 'More on %s', 'more on post title', 'carbon' ),
					the_title_attribute( 'echo=0' )
				)
			)
		);
	}
}
