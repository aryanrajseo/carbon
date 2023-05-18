<?php
/**
 * Site Layout Classes
 *
 * @link
 *
 * @package    Carbon
 * @since    0.0.2
 * @version    0.0.1
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
function get_current_layout_class()
{
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

    // Set the default layout class
    $layout_class = 'else-content';

    if ($layout === 'full-width-content') {
        $layout_class = 'no-sidebar has-full-width-content';
    } elseif ($layout === 'content-sidebar') {
        $layout_class = 'has-primary-sidebar';
    } elseif ($layout === 'sidebar-content') {
        $layout_class = 'has-secondary-sidebar';
    } elseif ($layout === 'sidebar-content-sidebar') {
        $layout_class = 'has-primary-sidebar has-secondary-sidebar';
    }

    return $layout_class;
}

