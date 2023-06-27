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

// REGISTER ALL ADMIN SCRIPTS
add_action( 'admin_enqueue_scripts', 'register_all_admin_scripts' );
function register_all_admin_scripts(){
    
    //Enqueue media.
    wp_enqueue_media();
    wp_enqueue_script( 'jquery');
    wp_enqueue_script('boostly_api_js', plugin_dir_url( __FILE__ ).'/assets/js/boostly-api.js', 'jquery', '1.0.0', false);
    wp_enqueue_style('boostly_api_css', plugin_dir_url( __FILE__ ).'/assets/css/boostly-api.css');

    
    
    wp_register_script( 'bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js', 'jquery', null, false );
    wp_enqueue_script('bootstrap_js');

    wp_register_script( 'jquery-ui', 'https://code.jquery.com/ui/1.10.4/jquery-ui.js', 'jquery', null, false );
    wp_enqueue_script('jquery-ui');
    
    wp_register_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' );
    wp_enqueue_style('fontawesome');
    wp_register_style( 'bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' );
    wp_enqueue_style('bootstrap_css');

    
}


function rewrite_listings_flush(){
    create_listing_cpt();
    flush_rewrite_rules();
}


register_activation_hook( __FILE__, 'flush_rewrite_rules');
?>


