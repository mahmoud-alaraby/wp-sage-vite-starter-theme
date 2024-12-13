<?php
/**
* Function Name: C95 Delete old posts interval - c95_delete_old_posts_interval();
* This Function can return Add transient for post deletion intervals set
* @param ()
* @return (string)
*/
function c95_delete_old_posts_interval() {
  if (false === ( get_transient('c95_delete_old_posts_interval') )):
    c95_delete_old_posts();
    set_transient('c95_delete_old_posts_interval', time(), 4 * HOUR_IN_SECONDS);
  endif;
}
add_action('init', 'c95_delete_old_posts_interval');
/**
* Function Name: C95 Delete old posts - c95_delete_old_posts();
* This Function can return Grab all pending and trash posts and delete if due date
* @param ()
* @return (string)
*/
function c95_delete_old_posts() {
  $pending_date_range = 4;
  $trash_date_range = 4;
  // Delete pending posts
  $pending_args = array(
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => 100,
    'post_status' => 'pending',
    'date_query' => array(
      array(
        'column' => 'post_date_gmt',
        'before' => $pending_date_range . ' days ago',
      )
    )
  );
  $pending_posts = get_posts($pending_args);
  foreach ($pending_posts as $post):
    wp_delete_post($post->ID, true);
  endforeach;
  // Delete trash posts
  $trash_args = array(
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => 100,
    'post_status' => 'trash',
    'date_query' => array(
      array(
        'column' => 'post_date_gmt',
        'before' => $trash_date_range . ' days ago',
      )
    )
  );
  $trash_posts = get_posts($trash_args);
  foreach ($trash_posts as $post):
    wp_delete_post($post->ID, true);
  endforeach;
}
/**
* Function Name: C95 Delete cron interval - c95_delete_cron_interval();
* This Function can return Add transient for cron deletion intervals set if time is between 2am and 5am
* @param ()
* @return (string)
*/
function c95_delete_cron_interval() {
  if (false === ( get_transient('c95_delete_cron_interval') ) && date('H') > 1 && date('H') < 6):
    c95_delete_cron();
    set_transient('c95_delete_cron_interval', time(), 6 * HOUR_IN_SECONDS);
  endif;
}
add_action('init', 'c95_delete_cron_interval');
/**
* Function Name: C95 Delete Cron - c95_delete_cron();
* This Function can return elete cron row from options table
* @param ()
* @return (string)
*/
function c95_delete_cron() {
  global $wpdb;
  $wpdb->delete($wpdb->options, array('option_name' => 'cron'));
}
