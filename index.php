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

function rewrite_listings_flush(){
    create_listing_cpt();
    flush_rewrite_rules();
}

/**
 * boostly_api_define_constants
 *
 * @param  mixed $version
 * @return void
 */
function boostly_api_define_constants($version)
{
    define('BOOSTLY_API_PLUGIN_FILE', __FILE__);
    define('BOOSTLY_API_VERSION', $version);
    define('BOOSTLY_API_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}


/**
 *  Enqueue all admin styles and scripts
 */
function boostly_hostfully_enqueue_admin_scripts()
{
    wp_enqueue_script('boostly_api', plugins_url('/assets/js/boostly-api.js', BOOSTLY_API_PLUGIN_FILE), ['jquery'], BOOSTLY_API_VERSION);
}

register_activation_hook( __FILE__, 'flush_rewrite_rules');