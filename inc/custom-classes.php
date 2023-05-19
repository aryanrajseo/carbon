<?php

// Add custom metabox for classes
function custom_classes_metabox()
{
    add_meta_box(
        'custom-classes-metabox',
        'Custom Classes',
        'render_custom_classes_metabox',
        'post', // Change this to 'page' if you want the metabox for Pages instead of Posts
        'side',
        'high'
    );
}

add_action('add_meta_boxes', 'custom_classes_metabox');

// Render the custom classes metabox
function render_custom_classes_metabox($post)
{
    wp_nonce_field('custom_classes_metabox', 'custom_classes_nonce');

    // Retrieve the saved values, if any
    $custom_body_class = get_post_meta($post->ID, '_custom_body_class', true);
    $custom_post_class = get_post_meta($post->ID, '_custom_post_class', true);
    ?>
    <label for="custom-body-class">Body Class:</label>
    <input type="text" id="custom-body-class" name="custom_body_class"
           value="<?php echo esc_attr($custom_body_class); ?>" pattern="[a-zA-Z0-9\s]+"
           title="Only letters, numbers, and spaces are allowed."/>

    <br/>

    <label for="custom-post-class">Post Class:</label>
    <input type="text" id="custom-post-class" name="custom_post_class"
           value="<?php echo esc_attr($custom_post_class); ?>" pattern="[a-zA-Z0-9\s]+"
           title="Only letters, numbers, and spaces are allowed."/>
    <?php
}

// Save the custom class values
function save_custom_classes($post_id)
{
    // Verify the nonce
    if (!isset($_POST['custom_classes_nonce']) || !wp_verify_nonce($_POST['custom_classes_nonce'], 'custom_classes_metabox')) {
        return;
    }

    // Save the custom class values
    if (isset($_POST['custom_body_class'])) {
        $custom_body_class = sanitize_text_field($_POST['custom_body_class']);
        update_post_meta($post_id, '_custom_body_class', $custom_body_class);
    }

    if (isset($_POST['custom_post_class'])) {
        $custom_post_class = sanitize_text_field($_POST['custom_post_class']);
        update_post_meta($post_id, '_custom_post_class', $custom_post_class);
    }
}

add_action('save_post', 'save_custom_classes');
