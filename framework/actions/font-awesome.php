<?php
add_action( 'admin_enqueue_scripts', function() {
  wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css');
}, 100);
