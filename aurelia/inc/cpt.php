<?php
/**
 * Custom post types and taxonomies for Aurelia.
 *
 * @package Aurelia
 */

if (!defined('ABSPATH')) {
    exit;
}

function aurelia_register_types() {
    register_post_type('property', array(
        'labels' => array(
            'name'          => __('Properties', 'aurelia'),
            'singular_name' => __('Property', 'aurelia'),
            'add_new_item'  => __('Add Property', 'aurelia'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'properties'),
        'menu_icon'    => 'dashicons-admin-home',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
    ));

    register_taxonomy('property_type', 'property', array(
        'label'        => __('Property Types', 'aurelia'),
        'rewrite'      => array('slug' => 'property-type'),
        'hierarchical' => true,
        'show_in_rest' => true,
    ));

    register_taxonomy('property_location', 'property', array(
        'label'        => __('Locations', 'aurelia'),
        'rewrite'      => array('slug' => 'location'),
        'hierarchical' => true,
        'show_in_rest' => true,
    ));

    register_taxonomy('property_category', 'property', array(
        'label'        => __('Property Categories', 'aurelia'),
        'rewrite'      => array('slug' => 'property-category'),
        'hierarchical' => true,
        'show_in_rest' => true,
    ));

    register_post_type('agent', array(
        'labels'       => array('name' => __('Agents', 'aurelia'), 'singular_name' => __('Agent', 'aurelia')),
        'public'       => true,
        'menu_icon'    => 'dashicons-businessperson',
        'supports'     => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));

    register_post_type('testimonial', array(
        'labels'       => array('name' => __('Testimonials', 'aurelia'), 'singular_name' => __('Testimonial', 'aurelia')),
        'public'       => true,
        'menu_icon'    => 'dashicons-format-quote',
        'supports'     => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));

    register_post_type('faq', array(
        'labels'       => array('name' => __('FAQs', 'aurelia'), 'singular_name' => __('FAQ', 'aurelia')),
        'public'       => true,
        'menu_icon'    => 'dashicons-editor-help',
        'supports'     => array('title', 'editor'),
        'show_in_rest' => true,
        'taxonomies'   => array('faq_topic'),
    ));

    register_taxonomy('faq_topic', 'faq', array(
        'label'        => __('FAQ Topics', 'aurelia'),
        'hierarchical' => true,
        'show_in_rest' => true,
    ));
}
add_action('init', 'aurelia_register_types');

function aurelia_property_meta_boxes() {
    add_meta_box('aurelia_property_details', __('Property Details', 'aurelia'), 'aurelia_property_details_cb', 'property', 'side');
}
add_action('add_meta_boxes', 'aurelia_property_meta_boxes');

function aurelia_property_details_cb($post) {
    wp_nonce_field('aurelia_property_meta', 'aurelia_property_nonce');
    $fields = array(
        'price'     => __('Price', 'aurelia'),
        'bedrooms'  => __('Bedrooms', 'aurelia'),
        'bathrooms' => __('Bathrooms', 'aurelia'),
        'area'      => __('Area (sq ft)', 'aurelia'),
        'badge'     => __('Badge', 'aurelia'),
        'address'   => __('Address', 'aurelia'),
        'featured'  => __('Featured (yes/no)', 'aurelia'),
        'luxury'    => __('Luxury (yes/no)', 'aurelia'),
    );
    foreach ($fields as $key => $label) {
        $value = get_post_meta($post->ID, '_aurelia_' . $key, true);
        echo '<p><label>' . esc_html($label) . '<br><input type="text" name="aurelia_' . esc_attr($key) . '" value="' . esc_attr($value) . '" style="width:100%"></label></p>';
    }
}

function aurelia_save_property_meta($post_id) {
    if (!isset($_POST['aurelia_property_nonce']) || !wp_verify_nonce($_POST['aurelia_property_nonce'], 'aurelia_property_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    $keys = array('price', 'bedrooms', 'bathrooms', 'area', 'badge', 'address', 'featured', 'luxury');
    foreach ($keys as $key) {
        if (isset($_POST['aurelia_' . $key])) {
            update_post_meta($post_id, '_aurelia_' . $key, sanitize_text_field(wp_unslash($_POST['aurelia_' . $key])));
        }
    }
}
add_action('save_post_property', 'aurelia_save_property_meta');
