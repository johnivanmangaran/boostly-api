<?php
/**
 * Plugin Name: Boostly API
 * Description: Boostly API Training
 * Version: 1.0.0
 * Author: Boostly Ivan
 * Author URI: https://johnivanmangaran.github.io/
 * Text Domain: Boostly API
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$version ="1.0.0";

//Custom Post Type
require_once 'classes/class-custom-post-type.php';
require_once 'functions/functions.php';
require_once 'settings/settings.php';

add_action( 'wp_ajax_handle_request', 'handle_request' );
add_action( 'wp_ajax_nopriv_handle_request', 'handle_request' ); 
wp_enqueue_script('boostly_api', plugin_dir_url( __FILE__ ).'/assets/js/boostly-api.js', array('jquery'), '1.0.0', true);

function rewrite_listings_flush(){
    create_listing_cpt();
    flush_rewrite_rules();
}


register_activation_hook( __FILE__, 'flush_rewrite_rules');
?>


