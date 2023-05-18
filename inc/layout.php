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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
// Add meta box for layout options
function add_layout_meta_box() {
	$screens = array( 'post', 'page' ); // Add more post types if needed

	foreach ( $screens as $screen ) {
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

add_action( 'add_meta_boxes', 'add_layout_meta_box' );

// Render the layout options meta box
function render_layout_meta_box( $post ) {
	$layout = get_post_meta( $post->ID, 'layout_option', true );

	// Add nonce field for security
	wp_nonce_field( 'save_layout_option', 'layout_option_nonce' );

	// Output the options
	?>
	<label for="layout_option">
		<input type="radio" name="layout_option" value="full-width-content" <?php checked( $layout,
			'full-width-content' ); ?>>
		Full Width Content(No Sidebar)
	</label>
	<br>
	<label for="layout_option">
		<input type="radio" name="layout_option" value="content-sidebar" <?php checked( $layout,
			'content-sidebar' ); ?>>
		Content + Sidebar
	</label>
	<br>
	<label for="layout_option">
		<input type="radio" name="layout_option" value="sidebar-content" <?php checked( $layout,
			'sidebar-content' ); ?>>
		Sidebar + Content
	</label>

	<label for="layout_option">
		<input type="radio" name="layout_option" value="sidebar-content-sidebar" <?php checked( $layout,
			'sidebar-content-sidebar' ); ?>>
		Sidebar + Content + Sidebar
	</label>

	<?php
}

function save_layout_option( $post_id ) {
	// Check if the nonce is set and valid
	if ( ! isset( $_POST['layout_option_nonce'] ) || ! wp_verify_nonce( $_POST['layout_option_nonce'],
			'save_layout_option' ) ) {
		return;
	}

	// Check if the current user has permission to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Save the layout option if it is not already set
	if ( isset( $_POST['layout_option'] ) ) {
		$layout = sanitize_text_field( $_POST['layout_option'] );
		update_post_meta( $post_id, 'layout_option', $layout );
	} else {
		// Set the default layout as "full-width-content"
		update_post_meta( $post_id, 'layout_option', 'full-width-content' );
	}
}

add_action( 'save_post', 'save_layout_option' );
