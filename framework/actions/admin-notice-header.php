<?php
function sample_admin_notice__success() {
  $current_stage = WP_ENV;
  ?>
  <div class="notice notice-warning" style="background-image:url('<?= Utilities::resources_path('/assets/images/code95-logo.png'); ?>');background-repeat: no-repeat ;background-position: 96% 45% ;height:150px;direction: ltr;">
    <h2>
      <?= __( 'Congratulations you are now in ' . $current_stage . ' site', 'C95' ); ?>
      <small><?= __( 'We have some Steps Need you finishing it ', 'C95' ); ?></small>
    </h2>
    <ul>
      <li> <b> 1 - <?= __( 'Start Search Engine Visibility From Dashboard -> Settings -> ', 'C95' ); ?> <a href="/wp/wp-admin/options-reading.php"><?= __('Reading.','C95');?></a> </b> </li>
      <li> <b> 2 - <?= __( 'Please Backup your file in 4 day', 'C95' ); ?> </b></li>
    </ul>
    <span id="footer-thankyou">Crafted by <a href="http://alaraby.dev/" target="_blank">Mahmoud Araby</a>.</span>
    <br><br>
  </div>
  <?php
}
add_action( 'admin_notices', 'sample_admin_notice__success' );
