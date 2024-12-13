<?php

function must_top_header_menus()
{
    register_nav_menus(
        array(
            'top-left' => __('Header: Top Left Menu', 'must'),
            'top-right' => __('Header: Top Right Menu', 'must'),
            'nav-menu' => __('Header: Navbar Menu', 'must'),
            'footer-left' => __('Footer: Menu left', 'must'),
            'footer-middle' => __('Footer: Menu Middle', 'must'),
            'footer-right' => __('Footer: Menu right', 'must'),
        )
    );
}
add_action('init', 'must_top_header_menus');


/**
 * Make menu label nullable.
 */
function make_menu_label_nullable($item) {
    $item->label = $item->post_title ? $item->post_title : '';
    return $item;
}
add_filter('wp_setup_nav_menu_item', 'make_menu_label_nullable');
