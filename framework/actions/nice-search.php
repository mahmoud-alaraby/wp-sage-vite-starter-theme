<?php

/**
* Redirects search results from /?s=query to /search/query/, converts %20 to +
*
* @link http://txfx.net/wordpress-plugins/nice-search/
*
* You can enable/disable this feature in functions.php (or lib/config.php if you're using Roots):
* add_theme_support('soil-nice-search');
*/

// function redirect() {
//   global $wp_rewrite;
//   if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
//     return;
//   }

//   $search_base = $wp_rewrite->search_base;
//   if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
//     wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
//     exit();
//   }
// }
// add_action('template_redirect', 'redirect');



//get listings for 'works at' on submit listing page
// add_action('wp_ajax_nopriv_get_listing_names', 'ajax_listings');
// add_action('wp_ajax_get_listing_names', 'ajax_listings');
// function ajax_listings() {
//   global $wpdb; //get access to the WordPress database object variable
//   //get names of all businesses
//   $name = '%' . $wpdb->esc_like(stripslashes($_POST['name'])) . '%'; //escape for use in LIKE statement
//   $sql = "select post_title, post_content, ID
//   from $wpdb->posts
//   where
//   (
//     post_title like %s
//     or post_content like %s
//     )
//     and post_status='publish'";
//     $sql = $wpdb->prepare($sql, $name, $name);
//     $results = $wpdb->get_results($sql);
//     //copy the business titles to a simple array
//     $titles = array();
//     foreach( $results as $r )
//     $titles[] = ['value' => addslashes( $r->post_title ), 'data' => get_the_post_thumbnail($r->ID), 'time' => get_the_time('l, F j, Y', $r->ID), 'url' => get_permalink($r->ID)];
//     if(count($titles) == 0 ){
//       $titles[] = ['value' => 'No matching search results - Please change your search terms', 'data' => '<img src="'. Utilities::resources_path('images/logo-honalshabab.png').'" />', 'time' =>'', 'url' => '#'];
//     }
//     $titles = ['suggestions' => $titles];
//     echo json_encode($titles); //encode into JSON format and output
//     die(); //stop "0" from being output
//   }
