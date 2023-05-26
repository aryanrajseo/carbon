<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <?php
    /**
     * Fires under <head>.
     */
    do_action('carbon_head');
    ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<?php

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

$default_layout = get_theme_mod('layout_option', 'full-width-content');

//// Debugging information
//echo 'Default Layout: ' . $default_layout . '<br>';
//echo 'Layout: ' . $layout . '<br>';
//echo 'Queried Object ID: ' . get_queried_object_id() . '<br>';

// Set the default layout class
$layout_class = 'else-content';

if ($layout === 'full-width-content') {
    $layout_class = 'no-sidebar has-full-width-content full-width-content';
} elseif ($layout === 'content-sidebar') {
    $layout_class = 'has-primary-sidebar content-sidebar';
} elseif ($layout === 'sidebar-content') {
    $layout_class = 'has-secondary-sidebar sidebar-content';
} elseif ($layout === 'sidebar-content-sidebar') {
    $layout_class = 'has-primary-sidebar has-secondary-sidebar sidebar-content-sidebar';
}

//echo 'Layout Class: ' . $layout_class . '<br>';

$custom_body_class = get_post_meta(get_the_ID(), '_custom_body_class', true); // Get the custom body class value

if (!empty($custom_body_class)) {
    $layout_class .= ' has-custom-body-class ' . $custom_body_class;
}

?>

<body <?php body_class($layout_class); ?>>


<?php wp_body_open(); ?>

<?php
/**
 * Fires immediately after the body element opening markup.
 */
do_action('carbon_before');
?>

<div id="site-container" class="site-container">
    <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'carbon'); ?></a>
    <?php
    /**
     * Fires immediately after the site container opening markup, before `carbon_header` action hook.
     */
    do_action('carbon_before_header');
    ?>

    <?php get_template_part('template-parts/header'); ?>

    <?php
    /**
     * Fires immediately after the `carbon_header` action hook, before the site inner opening markup.
     */
    do_action('carbon_after_header');
    ?>
    <div id="site-inner" class="site-inner">

        <?php

        // show only if it is not default post page and template-parts/article/entry-header is inactive in content.php. Woo single product is restricted.
        // if (!is_front_page() || !is_home()) {
        //if (class_exists('woocommerce') && !is_product()) {
        get_template_part('template-parts/page-header');
        // }
        // }

        ?>
        <?php
        /**
         * Fires after the header, before the content layout wrap.
         */
        do_action('carbon_before_content_layout_wrap');
        ?>
        <div id="content-layout-wrap" class="content-layout-wrap grid-container">
            <?php
            /**
             * Fires before #content.
             */
            do_action('carbon_before_content');
            ?>
            <div id="content" class="site-content">
