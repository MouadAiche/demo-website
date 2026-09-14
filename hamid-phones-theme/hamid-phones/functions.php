<?php

function hamid_phones_assets() {

    wp_enqueue_style(
        'hamid-phones-style',
        get_stylesheet_uri()
    );

    wp_enqueue_script(
        'hamid-phones-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        null,
        true
    );

}

add_action('wp_enqueue_scripts', 'hamid_phones_assets');