<?php
// Admin Settings - 
add_action( 'admin_menu', 'boostly_api_settings_page_init' );

function boostly_api_settings_page_init(){
    $settings_page  = add_submenu_page( 
        'edit.php?post_type=listing', 
        'Listing Settings', 
        'Listing Settings', 
        'manage_options', 
        'boostly-api-settings', 
        'boostly_api_settings_page' 
    );
    add_action( "load-{$settings_page}", 'boostly_api_load_settings_page' );
}

/**
 * boostly_api_load_settings_page
 *
 * @return void
 */
function boostly_api_load_settings_page() {

    if ( isset( $_POST["boostly-pms-settings-submit"] ) && $_POST["boostly-pms-settings-submit"] == 'Y' ) {

        check_admin_referer( "boostly-pms-settings-page" );
        
        // save settings
        boostly_pms_save_settings();
        
        $url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
        wp_redirect(admin_url('edit.php?post_type=listing&page=boostly-pms-settings&'.$url_parameters));
        exit;

    }
}

/**
 * boostly_api_settings_page
 *
 * @return void
 */
function boostly_api_settings_page() {

}