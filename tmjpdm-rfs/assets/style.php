<?php
//Security of style

//function to find the wp-config file.
function base_dir() {
  $path = dirname(__FILE__);
  while (true) {
    if (file_exists($path."\wp-config.php")) {
      return $path."\wp-config.php";
    }
    $path = dirname($path);
  }
}
 ?>

  <?php
  //To Allow this file run as CSS
  header("Content-type: text/css; charset: UTF-8");
  header('Cache-control: must-revalidate');

  //To run the wp-config in this content (File)
  include_once(base_dir());

  //To know if the plugin in network active is activated
  if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
  }
  // check for plugin activated
  if(in_array('font-conversion/font-conversion.php', apply_filters('active_plugins', get_option('active_plugins'))) || is_plugin_active_for_network( 'font-conversion/font-conversion.php' )){
    //plugin is activated
    $fonts_db = get_option('font_settings');
    if (!empty($fonts_db['radio_selection'])) {
      $class_count = $fonts_db['radio_selection'];
    }else {
      $class_count = 0 ;
    }

    // Class, font-size and VW Validation
    for ($cc=1; $cc <= $class_count; $cc++) {
      $class_validation = $fonts_db['font_class'];

      if (!empty($class_validation)) {
        $class = '.'.$fonts_db['font_class'].'-'.$cc;

        if ($fonts_db['font_pixel_'.$cc] > 0) {
          $pixels = $fonts_db['font_pixel_'.$cc];
        }else {
          $pixels = '0';
        }
        if ($fonts_db['font_range_'.$cc] >= 0) {
          $vw = $fonts_db['font_range_'.$cc];
        }else {
          $vw = '0';
        }
      }else {
        $class = $pixels = $vw = "0";
      }

      //Style Computation
      $pixels_to_vw = $pixels / 1920 * 100;
      $vw_to_px = $vw * 1920 / 100;
      $pixels_new_value = $pixels - $vw_to_px;
      $rem_value = $pixels_new_value / 16 .'rem';

      //Condition for displaying the font-size value
      $converted_result = ( $vw > 0 ) ? 'calc('.$rem_value." + ".$vw.'vw) !important' : $rem_value." !important";

      if ($pixels_new_value != '0' && $pixels_new_value > 0){
        echo esc_html($class).'{';
          echo 'font-size:'.$converted_result;
        echo '}';
        }
      }
  }else {
    // Empty output for deactivated plugin...
  }
  ?>
