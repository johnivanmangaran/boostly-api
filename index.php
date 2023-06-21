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
wp_enqueue_script('boostly_api_js', plugin_dir_url( __FILE__ ).'/assets/js/boostly-api.js', array('jquery'), '1.0.0', true);
wp_enqueue_style('boostly_api_css', plugin_dir_url( __FILE__ ).'/assets/css/boostly-api.css');

// wp_register_script( 'bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js', null, null, true );
// wp_enqueue_script('bootstrap_js');

// wp_register_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' );
// wp_enqueue_style('fontawesome');
// wp_register_style( 'bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' );
// wp_enqueue_style('bootstrap_css');



function rewrite_listings_flush(){
    create_listing_cpt();
    flush_rewrite_rules();
}


register_activation_hook( __FILE__, 'flush_rewrite_rules');
?>


