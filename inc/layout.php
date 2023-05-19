<?php
/**
 * Site Layout
 *
 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
 *
 * @package    Carbon
 * @since    0.0.2
 * @version    0.0.1
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Add meta box for layout options
function add_layout_meta_box()
{
    $post_types = get_post_types(array('public' => true), 'names');
    $taxonomies = get_taxonomies(array('public' => true), 'names');

    $screens = array_merge($post_types, $taxonomies);

    foreach ($screens as $screen) {
        add_meta_box(
            'layout_option',
            'Layout Option',
            'render_layout_meta_box',
            $screen,
            'side',
            'default'
        );
    }
}

add_action('add_meta_boxes', 'add_layout_meta_box');

// Render the layout options meta box
function render_layout_meta_box($post)
{
    $layout = get_post_meta($post->ID, 'layout_option', true);

    // Add nonce field for security
    wp_nonce_field('save_layout_option', 'layout_option_nonce');

    // Get the default layout option from the customizer
    //    $default_layout = get_theme_mod('layout_option', 'full-width-content');
    $default_layout = get_theme_mod('layout_option', 'default');

    // Define the layout options
    $options = array(
        'full-width-content' => 'Full Width Content (No Sidebar)',
        'content-sidebar' => 'Content, Primary Sidebar',
        'sidebar-content' => 'Secondary Sidebar, Content',
        'sidebar-content-sidebar' => 'Secondary Sidebar, Content, Primary Sidebar',
    );

    // Output the options
    ?>
    <label for="layout_option">
        <select name="layout_option" id="layout_option">
            <?php
            // Output the default layout option as the first option
            ?>
            <option value="default" <?php selected($layout, 'default'); ?>><?php echo esc_html('Default Layout: ' . $default_layout); ?></option>
            <?php
            // Output the other layout options
            foreach ($options as $value => $label) {
                if ($value !== 'default') {
                    ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($layout, $value); ?>><?php echo esc_html($label); ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </label>
    <?php
}

// Save the layout option when a post is saved or updated
function save_layout_option($post_id)
{
    // Check if the nonce is set and valid
    if (!isset($_POST['layout_option_nonce']) || !wp_verify_nonce($_POST['layout_option_nonce'], 'save_layout_option')) {
        return;
    }

    // Check if the current user has permission to edit the post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save the layout option if it is not already set
    if (isset($_POST['layout_option'])) {
        $layout = sanitize_text_field($_POST['layout_option']);
        update_post_meta($post_id, 'layout_option', $layout);
    } else {
        // Get the current layout option
        $current_layout = get_post_meta($post_id, 'layout_option', true);

        // Set the default layout as "content-sidebar" if no layout option is selected
        if (empty($current_layout)) {
            update_post_meta($post_id, 'layout_option', 'content-sidebar');
        }
    }

    // Refresh the layout change via customizer
    if (isset($_POST['layout_option'])) {
        $layout = sanitize_text_field($_POST['layout_option']);
        set_theme_mod('layout_option', $layout);
    } else {
        // Get the current layout option
        $current_layout = get_post_meta($post_id, 'layout_option', true);

        // Set the default layout as "content-sidebar" if no layout option is selected
        if (empty($current_layout)) {
            set_theme_mod('layout_option', 'content-sidebar');
        }
    }

}

add_action('save_post', 'save_layout_option');

// Add customizer support for global layout option
function add_layout_customizer_support($wp_customize)
{
    // Add section for layout option
    $wp_customize->add_section('layout_section', array(
        'title' => 'Layout Option',
        'priority' => 120,
    ));

    // Add setting for layout option
    $wp_customize->add_setting('layout_option', array(
        //'default' => 'full-width-content',
        'default' => 'default',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh', // Change transport to 'refresh'
    ));

    // Add control for layout option
    $wp_customize->add_control('layout_option', array(
        'label' => 'Default Layout',
        'section' => 'layout_section',
        'type' => 'select',
        'choices' => array(
            'full-width-content' => 'Full Width Content (No Sidebar)',
            'content-sidebar' => 'Content, Primary Sidebar',
            'sidebar-content' => 'Secondary Sidebar, Content',
            'sidebar-content-sidebar' => 'Secondary Sidebar, Content, Primary Sidebar',
        ),
        'priority' => 10,
        'transport' => 'postMessage', // Add this line for live preview
    ));
}

add_action('customize_register', 'add_layout_customizer_support');

// Apply the default layout option globally
function apply_global_layout_option()
{
    // Get the default layout option from the customizer
//    $default_layout = get_theme_mod('layout_option', 'full-width-content');
    $default_layout = get_theme_mod('layout_option', 'default');

    // Update layout option for all posts of each post type
    $post_types = get_post_types(array('public' => true), 'names');
    $taxonomies = get_taxonomies(array('public' => true), 'names');

    $post_types = array_merge($post_types, $taxonomies);

    foreach ($post_types as $post_type) {
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
        );

        if ($post_type === 'category' || $post_type === 'post_tag') {
            $args['post_status'] = 'publish';
            $args['ignore_sticky_posts'] = 1;
        }

        $posts = get_posts($args);

        foreach ($posts as $post) {
            $current_layout = get_post_meta($post->ID, 'layout_option', true);

            // Update only if the layout option matches the old default layout
            if ($current_layout === $default_layout) {
                update_post_meta($post->ID, 'layout_option', $default_layout);
            }
        }
    }

    // Trigger live preview refresh
    set_theme_mod('layout_option', $default_layout);
}

add_action('after_switch_theme', 'apply_global_layout_option');

