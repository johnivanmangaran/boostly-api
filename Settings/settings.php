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

}

/**
 * boostly_api_settings_page
 *
 * @return void
 */
function boostly_api_settings_page() {

    $settings = get_option( "boostly_api_settings" );
    ?>

    <style>
        #boostly_api_sync_listings{
            margin: 20px auto;
        }
    </style>
    <div class="wrap">
        <h2>API Settings</h2>

        <div id="poststuff">
            <form method="post" action="<?php admin_url( 'edit.php?post_type=listing&page=boostly-pms-settings' ); ?>"
                id="boostly_api_settings_form">
                <div class="row">
                    <div class="col-12">
                        <button type="button" id="boostly_api_sync_listings" class="button button-primary api-sync-controls" style="display:inline;">Listings Sync</button>
                    </div>
                    <div class="col-12">
                        <button type="button" id="boostly_api_delete_listings" class="button button-primary api-sync-controls" style="display:inline;">Delete Listings</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
<?php


}