<?php
function c95_admin_bar_stage($wp_admin_bar) {
  $current_stage = WP_ENV;
  $color_class = '';
  if($current_stage == 'development' || $current_stage == 'local') {
    $color_class = 'color-orange';
  }else if($current_stage == 'production') {
    $color_class = 'color-green';
  }
  $args = array(
    'id' => 'c95-views',
    'title' => '<span class="ab-icon dashicons-admin-site ' .$color_class . '"></span>' . $current_stage . '',
    'href'   => '#',
    'meta' => array(
      'class' => 'c95-views  c95_admin_bar_stage ' . $color_class,
    )
  );
  $wp_admin_bar->add_node($args);
}

add_action('admin_bar_menu', 'c95_admin_bar_stage', 100);
