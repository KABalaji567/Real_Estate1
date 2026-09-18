<?php
/**
 * Aurelia Estates theme.
 *
 * @package Aurelia
 */

if (!defined('ABSPATH')) {
    exit;
}

define('AURELIA_VERSION', '1.0.0');

require_once get_template_directory() . '/inc/cpt.php';

function aurelia_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 84,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'aurelia'),
        'footer'  => __('Footer Menu', 'aurelia'),
    ));

    add_image_size('aurelia-card', 900, 640, true);
    add_image_size('aurelia-hero', 1920, 1080, true);
    add_image_size('aurelia-gallery', 1600, 1000, true);
}
add_action('after_setup_theme', 'aurelia_setup');

function aurelia_assets() {
    wp_enqueue_style(
        'aurelia-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=Outfit:wght@300;400;500;600&display=swap',
        array(),
        null
    );
    wp_enqueue_style('aurelia-style', get_stylesheet_uri(), array('aurelia-fonts'), AURELIA_VERSION);
    wp_enqueue_script('aurelia-main', get_template_directory_uri() . '/assets/js/main.js', array(), AURELIA_VERSION, true);
}
add_action('wp_enqueue_scripts', 'aurelia_assets');

function aurelia_widgets() {
    register_sidebar(array(
        'name'          => __('Footer Contact', 'aurelia'),
        'id'            => 'footer-contact',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'aurelia_widgets');

function aurelia_customizer($wp_customize) {
    $wp_customize->add_section('aurelia_contact', array(
        'title'    => __('Aurelia Contact', 'aurelia'),
        'priority' => 30,
    ));

    $fields = array(
        'phone'   => '+1 (203) 555-0148',
        'email'   => 'hello@aureliaestates.com',
        'address' => '18 Harbor Lane, Greenwich, CT 06830',
        'hours'   => 'Mon–Fri 08:00–22:00',
    );

    foreach ($fields as $key => $default) {
        $wp_customize->add_setting('aurelia_' . $key, array('default' => $default, 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('aurelia_' . $key, array(
            'label'   => ucfirst($key),
            'section' => 'aurelia_contact',
            'type'    => 'text',
        ));
    }
}
add_action('customize_register', 'aurelia_customizer');

function aurelia_fallback_menu() {
    echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'aurelia') . '</a>';
    echo '<a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About Us', 'aurelia') . '</a>';
    echo '<a href="' . esc_url(get_post_type_archive_link('property')) . '">' . esc_html__('Properties', 'aurelia') . '</a>';
    echo '<a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact Us', 'aurelia') . '</a>';
}
