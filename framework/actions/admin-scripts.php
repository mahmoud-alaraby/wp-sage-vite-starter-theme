<?php
function custom_scripts_admin() {
  $category_colors = c95_colors('hexa');
  ?>
  <script type="text/javascript">
  // Suffix the new post links with a random time to prevent cloudflare cache
  jQuery(document).ready(function(){
    jQuery("a[href*='post']").each(function(){
      this.href += (this.href.indexOf('?') !== -1 ? '&' : '?') + 't=' + new Date().getTime();
    });
    <?php foreach ($category_colors as $color_name => $color_hexa): ?>
    jQuery( "li" ).has( "input[value=<?= $color_name; ?>]" ).css( "borderBottomColor", "<?= $color_hexa; ?>" );
    <?php endforeach; ?>
  })

  </script>
  <?php
}
add_action('admin_head', 'custom_scripts_admin');
