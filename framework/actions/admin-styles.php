<?php
use Roots\Sage\Assets;
/**
* Function Name: C95 Custom Style - c95_custom_style();
* This Function can Change in backend style
* @param ()
* @return ()
*/
/**
* Customize color of widgets based on its category color
*/
function custom_styles_admin() {
  ?>
  <style>

#wpadminbar .color-orange a.ab-item,
#wpadminbar span.color-orange:before {
    color: #ffa500;
  }

#wpadminbar:not(.mobile) li.color-orange:hover a.ab-item,
#wpadminbar:not(.mobile) li.color-orange:hover span.color-orange:before {
    color: #ad7000;
  }

  #wpadminbar .color-green a.ab-item,
  #wpadminbar span.color-green:before {
    color: #01ab01;
  }

#wpadminbar:not(.mobile) li.color-green:hover a.ab-item,
#wpadminbar:not(.mobile) li.color-green:hover span.color-green:before {
    color: #008000;
  }

  .c95_admin_bar_stage{
    background: #ffa5001c !important ;
  }
  .c95_admin_bar_stage a{
    text-transform: capitalize !important ;

  }
  .acf-field-message, .acf-field-object-message{
    background-color : #f1f1f1 ;
  }
  .count_shortcodes, .id_of_textbox_user_typed_in{
    height: 30px;
    border-radius: 5px;
    margin: 0;
  }
  #button_clicked{
    float :right;
  }
  .text-center{
    text-align: center;
  }
  .text-or{
    background-color: #fff;
    width: 10%;
    margin: -19px auto;
  }
  .span-dashicons{
    margin-top: 3px;
  }
  .pre-dd{
    direction: ltr;
    background-color: rgba(128, 128, 128, 0.27);
    padding: 20px 50px;
  }
  .img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
  }
  .taxonomy-category [data-name="category_colors"] ul.acf-radio-list li{
    background: #f9f9f9;
    padding: 10px;
    width: 43%;
    float: left;
    margin: 2% 0.5%;
    box-shadow: 1px 1px 1px #ddd;
  }
  .taxonomy-category.term-php [data-name="category_colors"] ul.acf-radio-list li{
    width: 15%;
  }
  .taxonomy-category [data-name="category_colors"] ul.acf-radio-list li{
    border-bottom: 3px solid;
  }

  /* fix ACF 2select*/
  html[dir="rtl"] .select2-search-choice-close {
    right: auto;
    left: 24px;
  }
  /* fix large image preview of tax meta class */
  .simplePanelImagePreview img {
    max-width: 50%;
  }
  /* notification style */
  .wp-ui-notification.c95-badge {
    display: inline;
    padding: 1px 4px !important;
    border-radius: 50%;
    color: #fff;
  }

  ul.select2-results__options[id^="select2-acf-block"][id$="field_5df741b3f23fa-results"],
  ul.select2-results__options[id^="select2-acf-block"][id$="field_5df6960ee0d38-results"] {
    display: flex;
    flex-wrap: wrap;
  }
  
  ul.select2-results__options[id^="select2-acf-block"][id$="field_5df741b3f23fa-results"] li,
  ul.select2-results__options[id^="select2-acf-block"][id$="field_5df6960ee0d38-results"] li{
    width: 10%;
    text-align: center;
  }

  .style-img {
    width: 200px;
    height: 75px;
  }
  </style>
  <?php
}
add_action('admin_head', 'custom_styles_admin');

function gutenbergtheme_editor_styles() {
  wp_enqueue_style( 'gutenbergtheme-blocks-style', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
  wp_enqueue_style('custom/custom-classes', get_theme_file_uri() . '/framework/assets/custom-classes.css', false, null);
}
add_action( 'enqueue_block_editor_assets', 'gutenbergtheme_editor_styles' );
