<?php
// Admin Settings - 
// add_action( 'admin_menu', 'boostly_api_settings_page_init' );

// function boostly_api_settings_page_init(){
//     $settings_page  = add_submenu_page( 
//         'edit.php?post_type=listing', 
//         'Listing Settings', 
//         'Listing Settings', 
//         'manage_options', 
//         'boostly-api-settings', 
//         'boostly_api_settings_page' 
//     );

// }


/**
 * boostly_api_settings_page
 *
 * @return void
 */
function boostly_api_settings_page() {

    $settings = get_option( "boostly_api_settings" );

    if (isset($_POST['update-settings'])) {
        if ( isset( $_POST['cb_stripe_enable'] ) ) {
            // - Sanitize the code
            update_option( 'cb_stripe_enable', sanitize_text_field($_POST['cb_stripe_enable']) );
           
        } else{
            update_option( 'cb_stripe_enable', '');
        }

        if ( isset( $_POST['cb_sandbox_stripe'] ) ) {
            // - Sanitize the code
            update_option( 'cb_sandbox_stripe', sanitize_text_field($_POST['cb_sandbox_stripe']) );
        } else{
            update_option( 'cb_sandbox_stripe', '' );
        }

        if ( isset( $_POST['sandbox_stripe_secret_key'] ) ) {
            // - Sanitize the code
            update_option( 'sandbox_stripe_secret_key', sanitize_text_field($_POST['sandbox_stripe_secret_key']) );
        }
    
        if ( isset( $_POST['sandbox_stripe_publishable_key'] ) ) {
            // - Sanitize the code
            update_option( 'sandbox_stripe_publishable_key', sanitize_text_field($_POST['sandbox_stripe_publishable_key']) );
        }
    
        if ( isset( $_POST['live_stripe_secret_key'] ) ) {
            // - Sanitize the code
            update_option( 'live_stripe_secret_key', sanitize_text_field($_POST['live_stripe_secret_key']) );
        }
    
        if ( isset( $_POST['live_stripe_publishable_key'] ) ) {
            // - Sanitize the code
            update_option( 'live_stripe_publishable_key', sanitize_text_field($_POST['live_stripe_publishable_key']) );
        }


        if ( isset( $_POST['cb_paypal_enable'] ) ) {
            // - Sanitize the code
            update_option( 'cb_paypal_enable', sanitize_text_field($_POST['cb_paypal_enable']) );
        } else{
            update_option( 'cb_paypal_enable', '');
        }

        if ( isset( $_POST['sandbox_paypal_clientid_key'] ) ) {
            // - Sanitize the code
            update_option( 'sandbox_paypal_clientid_key', sanitize_text_field($_POST['sandbox_paypal_clientid_key']) );
        } else{
            update_option( 'sandbox_paypal_clientid_key', '');
        }

        if ( isset( $_POST['sandbox_paypal_clientsecret_key'] ) ) {
            // - Sanitize the code
            update_option( 'sandbox_paypal_clientsecret_key', sanitize_text_field($_POST['sandbox_paypal_clientsecret_key']) );
        } else{
            update_option( 'sandbox_paypal_clientsecret_key', '');
        }
    }

    ?>

    <section id="listing-settings-section" class="listing-settings-section">
        <!-- <h2>API Settings</h2> -->

        <div id="listings_settings">

            <div class="container-fluid listing-settings-wrapper">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title">Listing Settings</h3>
                    </div>
                    <div class="col-2">
                        <button type="button" id="boostly_api_sync_listings" class="button button-primary api-sync-controls" style="display:inline;">Listings Sync</button>
                    </div>
                    <div class="col-2">
                        <button type="button" id="boostly_api_delete_listings" class="button button-primary api-delete-controls" style="display:inline;">Delete Listings</button>
                    </div>
                </div>
            </div>

            <form method="POST" action="<?php admin_url( 'edit.php?post_type=listing&page=boostly-api-settings' ); ?>"
                id="boostly_api_settings_form">

                <div class="container-fluid stripe-settings-wrapper settings-wrapper">
                    <h3 class="section-title">Stripe Settings</h3>
                    <div class="stripe-enable-wrapper">
                        <div class="form-stripe-details-row">
                            <div class="listing-fields form-fields">
                                <label for="cb_stripe_enable">Enable Stripe:</label>
                                <input type="checkbox" name="cb_stripe_enable" id="cb_stripe_enable" value="<?= get_option('cb_stripe_enable') ?>" <?php if( get_option('cb_stripe_enable') == "true" ){ echo 'checked'; }?>>
                                <!-- <input type="hidden" name="stripe_enable" id="stripe_enable" value="<?php // echo esc_attr( get_option('stripe_enable') ) ?>"> -->
                            </div>
                            <div class="stripe-details" <?php if( !get_option('cb_stripe_enable') ){ echo 'style="display:none;"'; }?>>
                                <div class="listing-fields form-fields">
                                    <label for="cb_sandbox_stripe">Sandbox Mode:</label>
                                    <input type="checkbox" name="cb_sandbox_stripe" id="cb_sandbox_stripe" value="<?= get_option('cb_sandbox_stripe') ?>" <?php if( get_option('cb_sandbox_stripe') == "true" ){ echo 'checked'; }?>>
                                    <!-- <input type="hidden" name="stripe_enable" id="stripe_enable" value="<?php //echo esc_attr( get_option('stripe_enable') ) ?>"> -->
                                </div>

                                <div class="sandbox-keys-group" <?php if( !get_option('cb_sandbox_stripe') ){ echo 'style="display:none;"'; }?> >
                                    <div class="listing-fields form-fields">
                                        <label for="sandbox_stripe_secret_key">Test Secret Key:</label>
                                        <input type="text" name="sandbox_stripe_secret_key" id="sandbox_stripe_secret_key" value="<?= esc_attr( get_option('sandbox_stripe_secret_key') ) ?>" >
                                    </div>

                                    <div class="listing-fields form-fields">
                                        <label for="sandbox_stripe_publishable_key">Test Publishable Key:</label>
                                        <input type="text" name="sandbox_stripe_publishable_key" id="sandbox_stripe_publishable_key" value="<?= esc_attr( get_option('sandbox_stripe_publishable_key') ) ?>" >
                                    </div>
                                </div>


                                <div class="live-keys-group" <?php if( get_option('cb_sandbox_stripe') ){ echo 'style="display:none;"'; }?>>
                                    <div class="listing-fields form-fields">
                                        <label for="live_stripe_secret_key">Live Secret Key:</label>
                                        <input type="text" name="live_stripe_secret_key" id="live_stripe_secret_key" value="<?= esc_attr( get_option('live_stripe_secret_key') ) ?>" >
                                    </div>

                                    <div class="listing-fields form-fields">
                                        <label for="live_stripe_publishable_key">Live Publishable Key:</label>
                                        <input type="text" name="live_stripe_publishable_key" id="live_stripe_publishable_key" value="<?= esc_attr( get_option('live_stripe_publishable_key') ) ?>" >
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container-fluid paypal-settings-wrapper settings-wrapper">
                    <h3 class="section-title">Paypal Settings</h3>
                    <div class="paypal-enable-wrapper">
                        <div class="form-paypal-details-row">
                            <div class="listing-fields form-fields">
                                <label for="cb_paypal_enable">Enable Paypal:</label>
                                <input type="checkbox" name="cb_paypal_enable" id="cb_paypal_enable" value="<?= get_option('cb_paypal_enable') ?>" <?php if( get_option('cb_paypal_enable') == "true" ){ echo 'checked'; }?>>
                            </div>

                            <div class="sandbox-keys-group" <?php if( !get_option('cb_paypal_enable') ){ echo 'style="display:none;"'; }?> >
                                <div class="listing-fields form-fields">
                                    <label for="sandbox_paypal_clientid_key">Client ID:</label>
                                    <input type="text" name="sandbox_paypal_clientid_key" id="sandbox_paypal_clientid_key" value="<?= esc_attr( get_option('sandbox_paypal_clientid_key') ) ?>" >
                                </div>

                                <div class="listing-fields form-fields">
                                    <label for="sandbox_paypal_clientsecret_key">Client Secret:</label>
                                    <input type="text" name="sandbox_paypal_clientsecret_key" id="sandbox_paypal_clientsecret_key" value="<?= esc_attr( get_option('sandbox_paypal_clientsecret_key') ) ?>" >
                                </div>
                            </div>

                        </div>
                    </div>

                    
                </div>

                <div class="container-fluid update-button-wrapper">
                    <input type="submit" name="update-settings" id="listing-update-settings-btn" class="button button-primary" value="Update Settings">
                </div>
                
            </form>
        </div>

    </section>
<?php
}