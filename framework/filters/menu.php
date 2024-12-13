<?php
// Add a filter to modify the menu item title output
// Add a filter to modify the menu item title output
function wrap_menu_item_title_with_span($title, $item, $args, $depth)
{
    // Extract only the menu item title
    $menu_title = strip_tags($title);
    // Wrap the menu item title with a <span> element and add the desired class
     $title = preg_replace('/' . preg_quote($menu_title, '/') . '/', '<span class="menu-title">' . $menu_title . '</span>', $title);

    return $title;
}
add_filter('nav_menu_item_title', 'wrap_menu_item_title_with_span', 10, 4);

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {

    // loop
    foreach( $items as $item ) {

        // vars
        $icon = get_field('icon', $item);


        // append icon
        if( $icon ) {

            $item->title .=  $icon['url'];

        }

    }
    // return
    return $items;

}

// Add class to wp_nav_menu <li> element
function add_class_to_nav_menu_li($classes, $item, $args, $depth) {
    // Add your desired class name to the $classes array
    $classes[] = 'nav-item font-bold';

    return $classes;
}
add_filter('nav_menu_css_class', 'add_class_to_nav_menu_li', 10, 4);




// Change sub-menu class to 'dropdown-menu'
function change_submenu_class_to_dropdown($classes, $args, $depth) {
    $classes[] = 'dropdown-menu';
    return $classes;
}
add_filter('nav_menu_submenu_css_class', 'change_submenu_class_to_dropdown', 10, 3);
