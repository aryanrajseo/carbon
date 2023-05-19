<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
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

?>

</div><!-- #content -->
<?php
/**
 * Fires after #content.
 */
do_action('carbon_after_content');
?>

<?php
/**
 *  Sidebar
 *  0.0.1
 */

//$layout = get_post_meta(get_the_ID(), 'layout_option', true);
//$default_layout = get_theme_mod('layout_option', 'full-width-content');
//
//// Handle the 'default' layout option
//if ($layout === 'default') {
//    $layout = $default_layout;
//}
//
//$layout_class = [];
//if ($layout !== 'full-width-content') {
//    get_sidebar();
//}
get_sidebar();
?>

</div><!-- #content-layout-wrap -->

<?php
/**
 * Fires before the footer, after the content layout wrap.
 */
do_action('carbon_after_content_layout_wrap');
?>

</div><!-- #site-inner -->
<?php
if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) {
    get_template_part('template-parts/footer-widgets', 'widgets');
}
/**
 * Fires before the site-footer.
 */
do_action('carbon_before_footer');
// displays <footer>
get_template_part('template-parts/footer', 'info');
/**
 * Fires after the site-footer.
 */
do_action('carbon_after_footer');
?>
</div><!-- #site-container-->
<?php wp_footer(); ?>
<?php
/**
 * Fires after 'wp_footer'.
 */
do_action('carbon_after_wp_footer');
?>
</body>
</html>
