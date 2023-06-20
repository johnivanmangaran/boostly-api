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

//Custom Post Type
require_once 'classes/class-custom-post-type.php';


function rewrite_listings_flush(){
    create_listing_cpt();
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'flush_rewrite_rules');