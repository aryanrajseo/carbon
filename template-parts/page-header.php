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

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>

<section id="page-header" class="page-header" aria-label="Page">
    <div class="wrap">

        <?php
        global $post;
        $title = get_the_title($post->ID);
        $page_id = get_the_ID();
        $archive_title = get_the_archive_title();

        if (is_home() && !is_front_page()) {
            echo '<h1 class="page-title">' . $title . '</h1>';
        } elseif (is_front_page() && !is_home()) {
            echo '<h2 class="page-title">' . $title . '</h2>';
        } elseif (is_singular()) {
            echo '<h1 class="page-title">' . $title . '</h1>';
            if (has_excerpt()) {
                $excerpt = get_the_excerpt($post->ID);
                echo '<div class="excerpt-info">' . $excerpt . '</div>';
            }
        } elseif (is_archive()) {
            $term_description = get_the_archive_description();

            if (is_author()) {
                $author = get_the_author();
                echo '<h1 class="archive-title author-title page-title">' . $archive_title . '</h1>'; // carbon_filter_the_archive_title in inc/general.php
            } else {
                echo '<h1 class="archive-title page-title">' . $archive_title . '</h1>';
            }
            if (!empty($term_description)) {
                if (is_author()) {
                    echo '<div class="author-info">' . $term_description . '</div>';
                } else {
                    echo '<div class="archive-description">' . $term_description . '</div>';
                }
            }
        } elseif (is_404()) {
            echo '<h1 class="page-title">Oops! That page can&rsquo;t be found.</h1>';
        } elseif (is_search()) {
            if (have_posts()) {
                echo '<h1 class="page-title">Search results for "' . get_search_query() . '"</h1>';
            } else {
                echo '<h1 class="page-title">No results found for "' . get_search_query() . '"</h1>';
            }
        } else {
            echo '<h1 class="else page-title">' . $title . '</h1>';
        }
        ?>

    </div>
</section><!-- .page-header -->
