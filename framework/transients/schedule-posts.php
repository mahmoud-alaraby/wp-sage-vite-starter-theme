<?php
/**
* Function Name: C95 publish scheduled interval - c95_publish_scheduled_interval();
* This Function can return Add transient for schedule post intervals set
* @param ()
* @return ( string )
*/
function c95_publish_scheduled_interval() {

  if (function_exists('get_field')) {
    $count_scheduled = get_field('count_scheduled', 'option');
  } else {
    $count_scheduled = "1000";
  }

  if (false === ( get_transient('c95_publish_scheduled_interval') )):
    c95_publish_scheduled_posts();
    set_transient('c95_publish_scheduled_interval', time(), 0.25 * HOUR_IN_SECONDS);
  endif;
  $remaining_time = $count_scheduled - (time() - get_transient('c95_publish_scheduled_interval'));
  // Check if remaining time is negative value or more than its value bug
  if ($remaining_time < -10 || $remaining_time  > $count_scheduled):
    c95_publish_scheduled_posts();
    set_transient('c95_publish_scheduled_interval', time(), 0.25 * HOUR_IN_SECONDS);
    $remaining_time = $count_scheduled - (time() - get_transient('c95_publish_scheduled_interval'));
  endif;
  return $remaining_time;
}
add_action('init', 'c95_publish_scheduled_interval');
/**
* Function Name: C95 Publish scheduled posts - c95_publish_scheduled_posts();
* This Function can return Grab all scheduled posts and publish if due date
* @param  ()
* @return ()
*/
function c95_publish_scheduled_posts() {
  $args = array(
    'posts_per_page' => -1,
    'post_status' => 'future',
  );
  $future_posts = get_posts($args);
  foreach ($future_posts as $post):
    $post_id = $post->ID;
    $post_date = strtotime($post->post_date);
    if (current_time('timestamp') > $post_date):
      wp_publish_post($post_id);
    endif;
  endforeach;
}
/**
* Function Name: C95 Admin bar scheduled - c95_admin_bar_scheduled();
* This Function can return Show remaining time to next scedule interval check
* @param  (type $wp_admin_bar)
* @return ()
*/
function c95_admin_bar_scheduled($wp_admin_bar) {
  $remaining_time = c95_publish_scheduled_interval();
  $args = array(
    'id' => 'c95-lang-schedule',
    'title' => '<span class="ab-icon dashicons-calendar-alt"></span> ' . $remaining_time . __(' Scheduled posts ', 'C95'),
    'href' => admin_url('edit.php'),
    'meta' => array(
      'class' => 'c95-lang-views',
    )
  );
  $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'c95_admin_bar_scheduled', 100);
