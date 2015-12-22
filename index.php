<?php
/*
Plugin Name: NativeRank Atrribution Link
Plugin URI:
Description: WP plugin developed specifically for the use in client sites to represent who built the site (nativerank.com) and important partner (google.com).
Author: NativeRank
Version: 1.0.1
Author URI: http://nativerank.com
*/


// create custom plugin settings menu


add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('My Cool Plugin Settings', 'Attribution', 'administrator', __FILE__, 'my_cool_plugin_settings_page' , plugins_url('/images/dashboard-icon.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'my-cool-plugin-settings-group', 'new_option_name' );
	register_setting( 'my-cool-plugin-settings-group', 'some_other_option' );
	register_setting( 'my-cool-plugin-settings-group', 'option_etc' );
}

function my_cool_plugin_settings_page() {
?>
<div class="wrap">

<h2>Native Rank Attribution Link</h2>
      <br />
    <br />
    <h3>How to display</h3>
    <p>The way to display the attribution link is through use of shortcode:</p>
    <h4 style="color: white; background-color: #666; width: 150px; padding: 20px; text-align:center">[nr-attribution-link]</h4>
    <br />
   <h3>How to Customize</h3>
    <p>Although options for this plugin are limited there are a few you can use which you can find in appearance > customize > colors.</p>


</div>
<?php } ?><?php
function Ari_customize_register( $wp_customize ) {
  $colors = array();
$colors[] = array(
  'slug'=>'nr_attribution_background_color',
  'default' => '#333',
  'label' => __('NR Attribution Background Color', 'Ari')
);
$colors[] = array(
  'slug'=>'nr_attribution_border_color',
  'default' => '#88C34B',
  'label' => __('NR Attribution Border Color', 'Ari')
);
foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'type' => 'option',
      'capability' =>
      'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'],
      array('label' => $color['label'],
      'section' => 'colors',
      'settings' => $color['slug'])
    )
  );
}
}
add_action( 'customize_register', 'Ari_customize_register' );


// [nr-attribution-link]
function nr_att_shortcode_func( $atts ) {


$nr_attribution_background_color = get_option('nr_attribution_background_color');
$nr_attribution_border_color = get_option('nr_attribution_border_color');

    echo '<div id="nr-attribution-link-container" style="padding: 15px; background-color: '  . $nr_attribution_background_color . '; border: 1px solid '  . $nr_attribution_border_color . '">
    <div style="max-width: 241px; margin: 0 auto">
   ' . '
    <p style="padding: 0px !important; margin: 0px">
    <a href="http://www.nativerank.com/"><small>Website & SEO</a> by  <a href="http://www.nativerank.com/"><img style="vertical-align: middle;" alt=Native Rank" src="' . plugins_url( 'images/image.png', __FILE__ ) . '"></small></a>
    </p>
    </div></div>';


}
add_shortcode( 'nr-attribution-link', 'nr_att_shortcode_func' );


?>
