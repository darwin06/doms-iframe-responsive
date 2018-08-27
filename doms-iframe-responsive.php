<?php
/*
* Plugin Name:  DOMS Iframe Responsive
* Plugin URI:   https://github.com/darwin06/doms-iframe-responsive/
* Description:  Plugin to add Iframe Responsive
* Version:      0.0.1
* Author:       Darwin Mateos
* Author URI:   https://github.com/darwin06/
* License:      GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:  doms
* Domain Path:  /languages
*/

defined('ABSPATH') or die( 'Hey! What are you doing here? You silly human!');

require 'includes/widgets/iframe-responsive.php';

function doms_add_plugin_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
 
  wp_enqueue_style( 'iframe', plugins_url( 'public/css/doms-styles.css', __FILE__ ), array(), '1.1', 'all');
 
  // wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array ( 'jquery' ), 1.1, true);

}
add_action( 'wp_enqueue_scripts', 'doms_add_plugin_scripts' );

class doms_responsive_iframe
{
  function doms_activate() {
    echo 'The plugin was activated';
  }

  function doms_deactivate() {
    echo 'The plugin was deactivated';
  }

  function doms_uninstall() {

  }
}

if( class_exists( 'doms_responsive_iframe' ) ) {
  $doms_responsive_iframe = new doms_responsive_iframe();
}


// * Activation
register_activation_hook( __FILE__, array( $doms_responsive_iframe, 'doms_activate') );

// * Dectivation
register_deactivation_hook( __FILE__, array( $doms_responsive_iframe, 'doms_activate') );

// * Installation


?>