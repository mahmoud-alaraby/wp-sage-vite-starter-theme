<?php
/**
* Function Name: C95 Colors - c95_colors();
* This Function can return Default theme colors array
* @param ($type) Hexa | Name
* @return ()
*/
function c95_colors($type = '') {
  $fields = array(
    'midnightblue'      => array('Mid Night Blue', '#29245C'),
    'navy'              => array('Navy Blue', '#004A8F'),
    'lochmara'          => array('Lochmara', '#3667A6'),
    'bondiblue'         => array('Bondi Blue', '#0282BD'),
    'turquoiseblue'     => array('Turquoise Blue', '#61CBD9'),
    'deepskyblue'       => array('Deep Sky Blue', '#36A8E0'),
    'cornflower'        => array('Corn Flower', '#8FC1E2'),
    'onahau'            => array('Onahau', '#BBE2F3'),
    'lightpink'         => array('Light Pink', '#FBB1BE'),
    'mandy'             => array('Mandy', '#DC4B5C'),
    'darkcoral'         => array('Dark Coral', '#D45741'),
    'firebrick'         => array('Fire Brick Red', '#F01C24'),
    'goldenglow'        => array('Golden Glow', '#FFDE00'),
    'gold'              => array('Gold', '#CB9F36'),
    'tan'               => array('Tan Brown', '#915E36'),
    'darkorange'        => array('Dark Orange', '#FA8E10'),
    'black'             => array('Black', '#000000'),
    'lightblack'        => array('Black Light', '#212121'),
    'darkgray'          => array('Dark Gray', '#333333'),
    'nobel'             => array('Nobel', '#999999'),
    'lightgray'         => array('Light Gray', '#F9F9F9'),
    'pink'              => array('Deep Pink', '#A31A5C'),
    'darkorchid'        => array('Dark Orchid purple', '#662482'),
    'truev'             => array('True V', '#937ECB'),
    'citrus'            => array('Citrus', '#81C301'),
    'nebula'            => array('Nebula', '#B0D7C2'),
    'vistablue'         => array('Vista Blue', '#9CD6B7'),
    'deepsea'           => array('Deep Sea', '#187259'),
    'facebook'          => array('Facebook', '#3b5997'),
    'gray'              => array('Gray', '#808080')
  );
  foreach ($fields as $key => $value):
    $field_select[$key] = $value[0];
    $field_hexa[$key] = $value[1];
  endforeach;

  if ($type == 'hexa'):
    return $field_hexa;
  else:
    return $field_select;
  endif;
}
/**
* Function Name: C95 Convert Color Hexa - c95_convert_color_hexa();
* This Function can Convert color for hexa to rgba
* @param ($name)
* @return (hexa color)
*/
function c95_convert_color_hexa($name){
  $hexa_colors = c95_colors('hexa');
  foreach ($hexa_colors as $key => $color):
    if($key == $name){
      return $color;
    }
  endforeach;
}
/**
* Function Name: C95 Colors RGBA - c95_colors_rgba();
* This Function can return the RGBA color
* @param ($color, $opacity)
* @return (Rgba color)
*/
function c95_colors_rgba($color, $opacity = false) {
  $default = 'rgb(0,0,0)';
  //Return default if no color provided
  if(empty($color))
  return $default;
  //Sanitize $color if "#" is provided
  if ($color[0] == '#' ) {
    $color = substr( $color, 1 );
  } else {
    $color = c95_convert_color_hexa($color);
    $color = substr( $color, 1 );
  }
  //Check if color has 6 or 3 characters and get values
  if (strlen($color) == 6) {
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
  } elseif ( strlen( $color ) == 3 ) {
    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
  } else {
    return $default;
  }
  //Convert hexadec to rgb
  $rgb =  array_map('hexdec', $hex);
  //Check if opacity is set(rgba or rgb)
  if($opacity){
    if(abs($opacity) > 1)
    $opacity = 1.0;
    $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
  } else {
    $output = 'rgb('.implode(",",$rgb).')';
  }
  //Return rgb(a) color string
  return $output;
}
