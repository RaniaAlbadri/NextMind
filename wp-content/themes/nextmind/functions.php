<?php

if (!defined('ABSPATH')) {
    exit;
}

function nextmind_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'nextmind_setup');

function nextmind_enqueue_assets() {
    wp_enqueue_style(
        'nextmind-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'nextmind_enqueue_assets');

function nextmind_order_home_articles($query) {
    if (
        is_admin()
        || !$query->is_main_query()
        || !$query->is_home()
    ) {
        return;
    }

    $query->set('ignore_sticky_posts', true);
    $query->set('orderby', array(
        'date' => 'DESC',
        'ID'   => 'DESC',
    ));
}

add_action('pre_get_posts', 'nextmind_order_home_articles');