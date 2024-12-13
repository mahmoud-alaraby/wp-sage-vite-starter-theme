<?php

// Add This Hook For Add Active Class In Current menu
function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active list-inline-item';
    }else{
      $classes[] = 'list-inline-item text-ellipsis ellipsis-1 ';
    }
    return $classes;
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);


// Add This Hook For Add Bootstrap Menu link Class
function special_nav_class_href($item_output, $item, $depth, $args) {
    $class= "nav-link";
    $item_output = preg_replace('/<a /', '<a class="'.$class.'"', $item_output, 1);
    return $item_output;
 }
add_filter('walker_nav_menu_start_el', 'special_nav_class_href', 10, 4);


// Add This NavWalker For Colors in menu
class NavWalker extends \Walker_Nav_Menu {
    private $cpt; // Boolean, is current post a custom post type
    private $archive; // Stores the archive page for current URL
    public function __construct() {
        add_filter('nav_menu_item_id', '__return_null');
        $cpt = get_post_type();
        $this->cpt = in_array($cpt, get_post_types(array('_builtin' => false)));
        $this->archive = get_post_type_archive_link($cpt);
    }
    public function checkCurrent($classes) {
        return preg_match('/(current[-_])|active|dropdown/', $classes);
    }
    // @codingStandardsIgnoreStart
    function start_lvl(&$output, $depth = 0, $args = []) {
        $output .= "\n<ul class=\"dropdown-menu\">\n";
    }
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);
        if ($item->is_dropdown && ($depth === 0)) {
            $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
            $item_html = str_replace('</a>', ' <i class="fa fa-caret-down"></i></a>', $item_html);
        } elseif (stristr($item_html, 'li class="divider')) {
            $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
        } elseif (stristr($item_html, 'li class="dropdown-header')) {
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
        }
        $item_html = apply_filters('sage/wp_nav_menu_item', $item_html);
        $output .= $item_html;
    }
    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        // Add color code in menu item class using tax meta class
        if ($element->object === 'category') {
            $category = get_category($element->object_id)->term_id;
            if (get_field('category_colors', 'category_' .$category)):
                $category_color = get_field('category_colors', 'category_'.$category);
                $element->classes[] = "item-menu-" . $category_color["value"];
            endif;
        } else {
            $element->classes[] = "item-menu-firebrick";
        }
        // End of color code
        $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));
        if ($element->is_dropdown) {
            $element->classes[] = 'dropdown';
            foreach ($children_elements[$element->ID] as $child) {
                if ($child->current_item_parent || Extras\url_compare($this->archive, $child->url)) {
                    $element->classes[] = 'active';
                }
            }
        }
        $element->is_active = strpos($this->archive, $element->url);
        if ($element->is_active) {
            $element->classes[] = 'active';
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Remove the id="" on nav menu items
 */
function nav_menu_args($args = '') {
    $nav_menu_args = [];
    $nav_menu_args['container'] = false;
    if (!$args['items_wrap']) {
        $nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
    }
    if (!$args['depth']) {
        $nav_menu_args['depth'] = 2;
    }
    return array_merge($args, $nav_menu_args);
}
add_filter('wp_nav_menu_args', __NAMESPACE__ . '\\nav_menu_args');
add_filter('nav_menu_item_id', '__return_null');
