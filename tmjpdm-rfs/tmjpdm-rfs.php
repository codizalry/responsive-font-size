<?php
  //Plugin Header Information
  /*
   * Plugin Name: Responsive Font Size
   * Description: Font-size will automatically converted from pixel into responsive.
   * Author: TMJP Digital Marketing ( Ryan Codizal )
   * Version: 1.0.0
   */

//WordPress security
defined( 'ABSPATH') or die ( 'Hey!!! what are you doing here kiddo ? ' );

 //Function for fetching css and js files
 function css_and_script(){
   wp_enqueue_style('related-pages-admin-styles',  plugins_url( 'assets/global.css' , __FILE__ ));
   wp_enqueue_script('releated-pages-admin-script', plugins_url( 'assets/custom.js' , __FILE__ ), array('jquery','jquery-ui-droppable','jquery-ui-draggable', 'jquery-ui-sortable'));
 }
 add_action('admin_enqueue_scripts','css_and_script');



 //function for creating admin panel
 function font_conversion_panel(){
   add_menu_page('Font Conversion Page', 'Font Conversion', 'manage_options', 'font_conversion', 'font_conv_callback', 'dashicons-text-page', 10);
 }

 //Callback function of the admin panel
 function font_conv_callback(){
   ?>
   <form class="font-form" action="options.php" method="post">
     <?php
     settings_fields( 'font_header' );
     do_settings_sections( 'font_fields' );
     ?>
     <div class="form-button">
       <?php submit_button(); ?>
       <a href="<?=plugin_dir_url( __FILE__ ).'review_changes/review-layout/' ?>" target="_blank">Preview Layout
       <div class="tooltip">
         <span class="tooltip-icon fs-6">&#63;</span>
        <p class="tooltiptext">Hover the text to know the class and tag.</p>
       </div>
       </a>
     </div>
   </form>
   <?php
 }
 add_action('admin_menu','font_conversion_panel');

//Function for creating section and fields
 function font_settings(){
   $tooltip = "<div class='tooltip'><span class='tooltip-icon fs-6'>&#63;</span><p class='tooltiptext'>Class name must be contain aphabet letters only.</p></div>";
   //Creating Section
   add_settings_section('font_conv_section', '', 'font_sections', 'font_fields');

   //Global Fields Function
   add_settings_field('font_class', 'Set the class name'.$tooltip, 'global_font_fields_callback', 'font_fields', 'font_conv_section',
     array(
        'font_group' => 'font_settings',
        'font_id'=>'font_class',
        'font_type'=>'text'
      )
    );
    add_settings_field('radio_selection', 'How many class?', 'global_font_fields_callback', 'font_fields', 'font_conv_section',
      array(
         'font_group' => 'font_settings',
         'font_id'=>'radio_selection',
         'font_type'=>'radio'
      )
    );

    //Class Fields Function
    if (!empty(get_option('font_settings')['radio_selection'])) {
      $class_count = get_option('font_settings')['radio_selection'];
    } else {
      $class_count = '0';
    }


    for ($cc=1; $cc <= $class_count; $cc++) {
      $pixel_value = $cc -1 ;
      //Number of class
      add_settings_field('font_size_'.$cc.'', '<span class="class_'.$cc.'">Class name : <span class="class_value">'.esc_html(get_option('font_settings')['font_class']).'</span>-'.$cc.'</span>', 'font_fields_callback', 'font_fields', 'font_conv_section',
          array(
             'font_group' => 'font_settings',
             'font_id'=>'font_pixel_'.$cc.'',
             'font_type'=>'number',
             'font_name'=>'Size ( Pixels )',
             'range_id'=>'font_range_'.$cc.'',
             'pixel_id'=>'font_pixel_'.$pixel_value.''
         )
       );
       add_settings_field('font_range_'.$cc.'', '', 'font_fields_callback', 'font_fields', 'font_conv_section',
          array(
             'font_group' => 'font_settings',
             'font_id'=>'font_range_'.$cc.'',
             'font_type'=>'range',
             'font_name'=>'Range ( View Width )',
             'range_id'=>'font_pixel_'.$cc.''
         )
       );
     }

     $args = array(
       'sanitize_callback' => 'validate_options',
     );

     register_setting('font_header', 'font_settings', $args );
}
  add_action('admin_init', 'font_settings');


  //Function for validation options
  function validate_options ($input_value){
    $validation = array();
    //Validation for font class text only
    $validation['font_class'] = preg_replace(
      '~[^A-Za-z]~',
      '',
      $input_value['font_class']
    );

    //Validation for class count 1-6 only
    $validation['radio_selection'] = preg_replace(
      '/[^0-6\s]/',
      $input_value['radio_selection']
    );

    // Validation for font pixel number only
    // for ($i=1; $i <= 6; $i++) {
    //   $validation['font_pixel_'.$i] = preg_replace(
    //     '~[^A-Za-z]~',
    //     '',
    //     $input_value['font_pixel_'.$i]
    //   );
    // }

    //Validation for radio selection
    if (!($input_value['radio_selection'] <= 1 && $input_value['radio_selection'] >= 6)) {
      $validation['radio_selection'] = $input_value['radio_selection'];
    }
    $count = $validation['radio_selection'];

    //Displaying the font range value
    for ($range_count=1; $range_count <= $count; $range_count++) {
      $validation['font_range_'.$range_count] = $input_value['font_range_'.$range_count];
    }

    //Validation for pixel variable
    $count = $count + 1;
    for ($pixel_variable_count=1; $pixel_variable_count < $count; $pixel_variable_count++) {
      $validation['font_pixel_'.$pixel_variable_count] = $input_value['font_pixel_'.$pixel_variable_count];

      ${'pixel_count_'.$pixel_variable_count} = $validation['font_pixel_'.$pixel_variable_count];
    }

    //validation for pixel count value
    $count1 = '1';
    $count2 = '2';
    for ($i=1; $i < $count; $i++) {
      if (${'pixel_count_'.$count1} <= ${'pixel_count_'.$count2}) {
        for ($pixel_count=$count2; $pixel_count < $count; $pixel_count++) {
          if (empty(${'pixel_count_'.$count1})) {
            $validation['font_pixel_'.$pixel_count] = '';
            $input_value['font_pixel_'.$pixel_count];
          }else {
            $validation['font_pixel_'.$pixel_count] = 'error';
            $input_value['font_pixel_'.$pixel_count];
          }
        }
      }
      $count1++;
      $count2++;
    }

    //return all validated value
    return $validation;
  }

//Callback function for what to display on font section
  function font_sections(){
    if (!empty(get_option('font_settings')['font_class'])) {
      $class_font = esc_html(get_option('font_settings')['font_class']);
    }else {
      $class_font = 'class';
    }
    ?>
    <div class="container">
      <img src="<?=plugins_url( 'assets/img/masthead.png' , __FILE__ ) ?>" alt="Font size conversion" width="100%" height="100%">
      <hr>
      <p class="font-description fs-5 text-center">For easy converting px (Pixel) to rem (Root em) and vw (Variable Width), you can use this plugin for automatic conversion of px into responsive values. This application easy in using, All you need is to insert your desire 'class name', 'size in pixel' and
         'viewport width' and tap 'save changes' then the inserted pixel will automatically converted into responsive font-size, also you can click the preview button to see the result of the font size.</p>
      <div class="font-details">
        <div class="font-measurement">
          <h3 class="text-center fs-4">Font-size Measurement</h3>
          <div class="font-instruc">
            <div class="class1-3">
              <table class="table-legends">
                <thead>
                  <td>Measurement</td>
                  <td>Description</td>
                </thead>
                <tbody>
                  <tr>
                    <td>PX (Pixel)</td>
                    <td>is the most basic, absolute, and final unit of measurement.</td>
                  </tr>
                  <tr>
                    <td>VW (Variable Width)</td>
                    <td>1% of window width.</td>
                  </tr>
                  <tr>
                    <td>REM (Root EM)</td>
                    <td>is a scalable unit that is used in web document media.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="font-legends">
          <h3 class="text-center fs-4">Class Legends on Preview Layout</h3>
          <div class="font-instruc">
            <div class="class1-3">
              <table class="table-legends">
                <thead>
                  <td>Section</td>
                  <td>HTML Tag(s)</td>
                  <td>Class(es)</td>
                </thead>
                <tbody>
                  <tr>
                    <td>Masthead</td>
                    <td>h1, h3 and button</td>
                    <td><?=$class_font;?>-1, <?=$class_font;?>-3 and <?=$class_font;?>-5</td>
                  </tr>
                  <tr>
                    <td>About</td>
                    <td>h2, h3, h4, button and p</td>
                    <td><?=$class_font;?>-2, <?=$class_font;?>-3, <?=$class_font;?>-5 and <?=$class_font;?>-6</td>
                  </tr>
                  <tr>
                    <td>Services</td>
                    <td>h2, h4 and p </td>
                    <td><?=$class_font;?>-2, <?=$class_font;?>-4 and <?=$class_font;?>-6</td>
                  </tr>
                  <tr>
                    <td>Our Team</td>
                    <td>h2, h4 and p/span </td>
                    <td><?=$class_font;?>-2, <?=$class_font;?>-4 and <?=$class_font;?>-6</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

  //Global Dynamic function
 function global_font_fields_callback($global_class){
   $global_class_group = $global_class['font_group'];
   $global_class_db = get_option($global_class_group);
   $global_class_id =  $global_class['font_id'];
   $global_class_type = $global_class['font_type'];
   $global_class_name = $global_class_group."[".$global_class_id."]";
   if (!empty($global_class_db[$global_class_id])) {
     $global_class_value =  $global_class_db[$global_class_id];
   }else {
     $global_class_value = '';
   }
 ?>
 <!--Dynamic Input fields for class content-->
 <?php if ($global_class_type == 'text'): ?>
   <input class="generate_result" type='<?=$global_class_type;?>' id='<?=$global_class_id;?>' name='<?=$global_class_name;?>' maxLength = "5" onkeypress="return /[a-z]/i.test(event.key)" placeholder="Class name..." value='<?=esc_html($global_class_value);?>' required>
   <?php if (!empty($global_class_value)){
     $global_class_value = $global_class_value;
   }else {
     $global_class_value = 'class';
   }
   ?>
   <b>" <span class="class_value"><?=esc_html($global_class_value);?></span>-1 to <span class="class_value"><?=esc_html($global_class_value);?></span>-6 "</b>
 <?php else: ?>
   <?php for ($count_number = 1; $count_number <= 6; $count_number++){
     if ($count_number == $global_class_value) {
       $active = 'checked';
     }else {
       $active = '';
     }
     ?>
     <div class="class_counts">
       <input class="radio_field" type='<?=$global_class_type;?>' id='<?=$global_class_id."_".$count_number;?>' name='<?=$global_class_name;?>' min="0" max="6" value='<?=$count_number;?>' <?=$active;?> required>
       <label for="<?=$global_class_id."_".$count_number;?>"><?=$count_number;?></label>
     </div>
     <?php
   }
 endif;
}

  //Class fields Dynamic Function
  function font_fields_callback($class_font_fields){
    //Fetching DB from wp_options
    $class_font_group = $class_font_fields['font_group'];
    $class_font_db = get_option($class_font_group);
    $class_font_id =  $class_font_fields['font_id'];
    $class_font_type = $class_font_fields['font_type'];
    $class_font_range_id = $class_font_fields['range_id'];
    $class_font_label = $class_font_fields['font_name'];
    $class_font_name = $class_font_group."[".$class_font_id."]";

    if (!empty($class_font_db[$class_font_id])) {
      $class_font_value = $class_font_db[$class_font_id];
    }else {
      $class_font_value = '';
    }
    if (!empty($class_font_db[''.$class_font_range_id.''])) {
      $pixel_value = $class_font_db[''.$class_font_range_id.''];
    }else {
      $pixel_value = '';
    }

    //Backend error message for pixel sizes
    if ($class_font_value == 'error') {
      $error_message = "<span class='error-message'>*Pixel size must be less than to the previous value</span>";
    }else {
      $error_message = '';
    }

    //Dynamic conditions for fields
    if ($class_font_type == 'number') {
      $font_result = '';
      $input_value_class = 'font-px';
      $range_id = 'data-id='.$class_font_range_id.'';
      $range_mx = 'min="0" max="100" step="1"';
      $restriction = 'required';
      $pixel_id_value = 'data-pixel-id='.$class_font_fields['pixel_id'].'';

    }elseif ($class_font_type == 'range') {
      $font_result = '<span class="font_range_label"></span>';
      $input_value_class = 'slider '.$class_font_id;
      $range_id = '';
      $range_mx = 'min="0" max="1" step="0.1"';
      $restriction = ( $pixel_value < 20 ) ? "disabled" : "";
      $pixel_id_value = '';
      $error_message = '';
      if (empty($class_font_value)) {
        $class_font_value = '0';
      }else {
        $class_font_value = $class_font_value;
      }
    }

    ?>
    <!--Dynamic Input fields for class content-->
    <div class="form-content">
      <label for="<?=$class_font_name;?>"><?=$class_font_label;?></label>
      <input class="<?=$input_value_class;?>" type='<?=$class_font_type;?>' id='<?=$class_font_id;?>' <?=$pixel_id_value;?> <?=$range_id;?> name='<?=$class_font_name;?>' <?=$range_mx;?> placeholder="Pixel Size..." value='<?=esc_html($class_font_value);?>' <?=$restriction;?>>
      <?=$font_result."".$error_message;?>
    </div>
    <?php
  }

  // WordPress Style WP_head
  function add_class(){
    ?>
    <link rel="stylesheet" type="text/css" href="<?=plugin_dir_url( __FILE__ ) . 'assets/style.php'?>">
    <?php
  }
  add_action('wp_head','add_class');
?>
