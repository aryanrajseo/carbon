<?php
/**
 * The Sidebar
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Get the layout option for the current post or page
$layout = '';

if (is_singular()) {
    $layout = trim(get_post_meta(get_the_ID(), 'layout_option', true));
} elseif (is_archive()) {
    $term = get_queried_object();
    $layout = trim(get_term_meta($term->term_id, 'layout_option', true));
}

// If layout option is empty or not set, use the default layout
if (empty($layout) || $layout === 'default') {
    $layout = get_theme_mod('layout_option', 'full-width-content');
}

$layout_class = '';

// Debugging information
$default_layout = get_theme_mod('layout_option', 'full-width-content');


?>

<?php if (is_active_sidebar('sidebar-1') && in_array($layout, array('content-sidebar', 'sidebar-content-sidebar'))) : ?>
    <aside id="sidebar-primary" class="sidebar-primary sidebar"
           role="complementary" aria-label="Primary Sidebar">
        <?php
        /**
         * Fires before primary sidebar widget area.
         */
        do_action('carbon_before_primary_sidebar_widget_area');
        ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
        <?php
        /**
         * Fires after primary sidebar widget area.
         */
        do_action('carbon_after_primary_sidebar_widget_area');
        ?>
    </aside><!-- .sidebar-primary -->
<?php endif; ?>

<?php if (is_active_sidebar('sidebar-2') && in_array($layout, array('sidebar-content', 'sidebar-content-sidebar'))) : ?>
    <aside id="sidebar-secondary" class="sidebar-secondary sidebar"
           role="complementary" aria-label="Secondary Sidebar">
        <?php
        /**
         * Fires before secondary sidebar widget area.
         */
        do_action('carbon_before_secondary_sidebar_widget_area');
        ?>
        <?php dynamic_sidebar('sidebar-2'); ?>
        <?php
        /**
         * Fires after secondary sidebar widget area.
         */
        do_action('carbon_after_secondary_sidebar_widget_area');
        ?>
    </aside><!-- .sidebar-secondary -->
<?php endif; ?>
