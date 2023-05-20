<?php
/**
 * Custom functions for Customizer
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package    Carbon
 * @since    0.0.1
 * @version    0.0.2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $site_link, $site_name; // Declare global variables

$site_link = home_url();
$site_name = get_bloginfo('name');

// Register the customizer
add_action('customize_register', 'register_site_credits_customizer');

function register_site_credits_customizer($wp_customize)
{
    $year = date('Y');
    global $site_link, $site_name; // Access the global variables

    $default_credits = 'Copyright &#x000A9;&nbsp;' . $year . ' &#x000B7; <a href="' . $site_link . '">' . $site_name . '</a>';

    // Site Copyright.
    $wp_customize->add_section(
        'site-copyright',
        array(
            'description' => sprintf('<strong>%s</strong>', __('Modify the Site Credits.', 'carbon')),
            'title' => __('Site Copyright', 'carbon'),
            'panel' => '',
        )
    );

    // Add Setting for Site Copyright.
    $wp_customize->add_setting(
        'site_credits',
        array(
            'default' => $default_credits,
            'sanitize_callback' => 'wp_kses_post',
            'transport' => isset($wp_customize->selective_refresh) ? 'postMessage' : 'refresh',
        )
    );

    $wp_customize->add_control(
        'site_credits',
        array(
            'label' => __('Copyright Section', 'carbon'),
            'section' => 'site-copyright',
            'type' => 'textarea',
        )
    );

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'site_credits',
            array(
                'selector' => '.site-credits',
                'settings' => array('site_credits'),
                'render_callback' => function () use ($default_credits) { // Use the $default_credits variable
                    return get_theme_mod('site_credits', $default_credits);
                },
            )
        );
    }
}

