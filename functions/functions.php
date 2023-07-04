<?php


// Reservations - Register the columns.
add_filter( "manage_reservations_posts_columns", function ( $defaults ) {
	unset($defaults['author'], $defaults['date']);
	$defaults['Name'] = 'Name';
	$defaults['Post Listing ID'] = 'Post Listing ID';
    $defaults['Listing ID'] = 'Listing ID';
    $defaults['Arrive Date'] = 'Arrive Date';
    $defaults['Depart Date'] = 'Depart Date';
    $defaults['Guests'] = 'Guests';
    $defaults['Total'] = 'Total';
    $defaults['Reservation Status'] = 'Reservation Status';
    $defaults['Payment Status'] = 'Payment Status';

	return $defaults;
} );

// Reservations - Handle the value for each of the new columns.
add_action( "manage_reservations_posts_custom_column", function ( $column_name, $post_id ) {
	$post_listing_id = get_post_meta($post_id, 'reserv_listing_id', true);
	if ( $column_name == 'Name' ) {
		echo get_post_meta($post_id, 'reserv_guest_firstname', true)." ".get_post_meta($post_id, 'reserv_guest_lastname', true);
	}
	
	if ( $column_name == 'Post Listing ID' ) {
		// Display an ACF field
		echo $post_listing_id;
	}

    if ( $column_name == 'Listing ID' ) {
		// Display an ACF field
		echo get_post_meta($post_listing_id, 'listing_id', true);
	}

    if ( $column_name == 'Arrive Date' ) {
		// Display an ACF field
		echo get_post_meta($post_id, 'reserv_arrive', true);
	}

    if ( $column_name == 'Depart Date' ) {
		// Display an ACF field
		echo get_post_meta($post_id, 'reserv_depart', true);
	}

    if ( $column_name == 'Guests' ) {
		// Display an ACF field
		echo get_post_meta($post_id, 'reserv_guests', true);
	}

    if ( $column_name == 'Total' ) {
		// Display an ACF field
		echo get_post_meta($post_id, 'reserv_total', true);
	}

    if ( $column_name == 'Reservation Status' ) {
		// Display an ACF field
		echo get_post_meta($post_id, 'reserv_status', true);
	}

    if ( $column_name == 'Payment Status' ) {
		// Display an ACF field
		echo get_post_meta($post_id, 'reserv_payment_status', true);
	}

	
}, 10, 2 );


// boostly_api_meta_box - Availability
if( !function_exists( 'boostly_api_metabox_reservation_details' ) ) {
    function boostly_api_metabox_reservation_details($post) {
        $reservation_post_id  = $post->ID;
        ?>


        <div class="form-details">
            <div class="form-details-row">
                <h3>Status</h3>
               <div class="form-fields column-6">
                   <label for="reserv_status">Reservation Status</label>
                   <input type="hidden" name="reserv_status" id="reserv_status" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_status', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_status', true) ) ?><span></div>
               </div>

               <div class="form-fields column-6">
                   <label for="reserv_user_id">User ID</label>
                   <input type="hidden" name="reserv_user_id" id="reserv_user_id" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_user_id', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_user_id', true) ) ?><span></div>
               </div>
            </div>

            <div class="form-details-row">
                <h3>Guests Info</h3>
               <div class="form-fields column-6">
                   <label for="reserv_guest_firstname">First Name</label>
                   <input type="hidden" name="reserv_guest_firstname" id="reserv_guest_firstname" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guest_firstname', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guest_firstname', true) ) ?><span></div>
               </div>

               <div class="form-fields column-6">
                   <label for="reserv_guest_lastname">Last Name</label>
                   <input type="hidden" name="reserv_guest_lastname" id="reserv_guest_lastname" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guest_lastname', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guest_lastname', true) ) ?><span></div>
               </div>

               <div class="form-fields column-6">
                   <label for="reserv_guest_phone">Phone</label>
                   <input type="hidden" name="reserv_guest_phone" id="reserv_guest_phone" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guest_phone', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guest_phone', true) ) ?><span></div>
               </div>

               <div class="form-fields column-6">
                   <label for="reserv_guest_email">Email</label>
                   <input type="hidden" name="reserv_guest_email" id="reserv_guest_email" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guest_email', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guest_email', true) ) ?><span></div>
               </div>
            </div>

            <div class="form-details-row">
                <h3>Reservation Details</h3>
               <div class="form-fields column-6">
                   <label for="reserv_listing_id">Listing ID</label>
                   <input type="hidden" name="reserv_listing_id" id="reserv_listing_id" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_listing_id', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_listing_id', true) ) ?><span></div>
               </div>

               <div class="form-fields column-6">
                   <label for="reserv_guests">Number of Guest/s</label>
                   <input type="hidden" name="reserv_guests" id="reserv_guests" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guests', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_guests', true) ) ?><span></div>
               </div>

               <div class="form-fields column-6">
                   <label for="reserv_arrive">Arrive Date</label>
                   <input type="hidden" name="reserv_arrive" id="reserv_arrive" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_arrive', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_arrive', true) ) ?><span></div>
               </div>

               <div class="form-fields column-6">
                   <label for="reserv_depart">Depart Date</label>
                   <input type="hidden" name="reserv_depart" id="reserv_depart" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_depart', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_depart', true) ) ?><span></div>
               </div>


            </div>

            <div class="form-details-row">
                <h3>Payment Info</h3>
               <div class="form-fields column-6">
                   <label for="reserv_total">Total Payment</label>
                   <input type="hidden" name="reserv_total" id="reserv_total" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_total', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_total', true) ) ?><span></div>
               </div>

               <div class="form-fields column-6">
                   <label for="reserv_payment_status">Payment Status</label>
                   <input type="hidden" name="reserv_payment_status" id="reserv_payment_status" value="<?= esc_attr( get_post_meta($reservation_post_id, 'reserv_payment_status', true) ) ?>">
                   <div class="value"><span><?= esc_attr( get_post_meta($reservation_post_id, 'reserv_payment_status', true) ) ?><span></div>
               </div>
            </div>
            
        </div>
    
<!--         <table width="100%" class="display" style="text-align: left;">
            <tbody>
                <tr>
                    <th style="border: 1px solid lightgray;padding: 10px;width: 20%;">Listing ID</th>
                    <td style="border: 1px solid lightgray;padding: 10px;width: 80%;"><?= $listing_id ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid lightgray;padding: 10px;width: 20%;">Booked Dates</th>
                    <td style="border: 1px solid lightgray;padding: 10px;width: 80%;"><?php //echo $listing_dates_not_available ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid lightgray;padding: 10px;width: 50%;">Available Dates</th>
                    <td style="border: 1px solid lightgray;padding: 10px;width: 50%;"><?php //echo $listing_price ?></td>
                </tr>

            </tbody>
        </table> -->
        
        <?php
    }
}

// boostly_api_meta_box - Availability
if( !function_exists( 'boostly_api_metabox_availability' ) ) {
    function boostly_api_metabox_availability($post) {
        $post_id            = $post->ID;
        $listing_id         = get_post_meta($post_id, 'listing_id', true);
        $listing_type         = wp_get_object_terms( $post_id, 'listing_type', array( 'fields' => 'names' ) );
        $listing_type = implode(", ", $listing_type);
        $listing_price       = get_post_meta($post_id, 'listing_price', true);
        $listing_dates_not_available = get_post_meta($post_id, 'not_available_dates', true);
        $listing_dates_not_available = json_encode(explode(", ", $listing_dates_not_available));

        ?>

        <div class="form-listing-details">
            <div class="form-listing-details-row">

                    <div class="listing-fields column-2">
                        <label for="listing_guest">Arrive</label>
                        <div class="input-group">
                            <input class="form-control" id="arrive_date_picker" name="arrive_date_picker" placeholder="Arrive Date">
                            <input class="form-control" id="depart_date_picker" name="depart_date_picker" placeholder="Depart Date">
                        </div>
                    </div>
                    <div class="listing-fields">
                        <label for="listing_guest">Availability</label>
                        <input type="text" name="not_available_dates" id="not_available_dates" value="<?= esc_attr( get_post_meta(get_the_ID(), 'not_available_dates', true) ) ?>">
                    </div>
               </div>
            </div>
        </div>
        <table width="100%" class="display" style="text-align: left;">
            <tbody>
                <tr>
                    <th style="border: 1px solid lightgray;padding: 10px;width: 20%;">Listing ID</th>
                    <td style="border: 1px solid lightgray;padding: 10px;width: 80%;"><?= $listing_id ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid lightgray;padding: 10px;width: 20%;">Booked Dates</th>
                    <td style="border: 1px solid lightgray;padding: 10px;width: 80%;"><?php echo $listing_dates_not_available ?></td>
                </tr>
                <tr>
                    <th style="border: 1px solid lightgray;padding: 10px;width: 50%;">Available Dates</th>
                    <td style="border: 1px solid lightgray;padding: 10px;width: 50%;"><?php //echo $listing_price ?></td>
                </tr>

            </tbody>
        </table>
        
        <?php
    }
}

// boostly_api_meta_box - Listing Data
if( !function_exists( 'boostly_api_meta_box_data' ) ) {
    function boostly_api_meta_box_data($post) {

        $post_id            = $post->ID;
        $listing_id         = get_post_meta($post_id, 'listing_id', true);
        $listing_type         = wp_get_object_terms( $post_id, 'listing_type', array( 'fields' => 'names' ) );
        $listing_type = implode(", ", $listing_type);
        $listing_price       = get_post_meta($post_id, 'listing_price', true);

        $html = '';
        $html .= '<table width="100%" class="display" style="text-align: left;">';
            $html .= '<tbody>';

                if ($listing_id) {
                    $html .= '<tr>';
                        $html .= '<th style="border: 1px solid lightgray;padding: 10px;width: 50%;">Listing ID</th>';
                        $html .= '<td style="border: 1px solid lightgray;padding: 10px;width: 50%;">' . $listing_id . '</td>';
                    $html .= '</tr>';
                }

                if ($listing_type) {
                    $html .= '<tr>';
                        $html .= '<th style="border: 1px solid lightgray;padding: 10px;width: 50%;">Listing Type</th>';
                        $html .= '<td style="border: 1px solid lightgray;padding: 10px;width: 50%;">' . $listing_type . '</td>';
                    $html .= '</tr>';
                }

                if ($listing_price) {
                    $html .= '<tr>';
                        $html .= '<th style="border: 1px solid lightgray;padding: 10px;width: 50%;">Price</th>';
                        $html .= '<td style="border: 1px solid lightgray;padding: 10px;width: 50%;">' . $listing_price . '</td>';
                    $html .= '</tr>';
                }
            $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<input type="hidden" name="boostly_guesty_listing_id" id="boostly_guesty_listing_id" value="' . $post_id . '" />';
        echo $html;
    }
}



// boostly_api_meta_box - Listing Details
if( !function_exists( 'boostly_api_custom_fields' ) ) {
    function boostly_api_custom_fields($post) {

        $post_id = wp_insert_post(array (
            'post_title'    => 'ivan',
            'post_type'     => 'listings',
            'post_content'  => 'desc ivan',
            'post_status'   => 'publish',
            'post_date'     => date( 'Y-m-d H:i:s', time() ),
            'post_author'   => get_current_user_id(),
        ));

        $listing_gallery = esc_attr( get_post_meta(get_the_Id(), 'listing_gallery', true) );
        $listing_gallery_images = explode(', ', $listing_gallery);
        
        $listing_gallery_html='';
        foreach ($listing_gallery_images as $image_id) {
            $img_url = wp_get_attachment_image_url ($image_id, 'full');
            // echo $img_url;
            if ($image_id) {
                $listing_gallery_html .= '<li><a href="'.esc_url($img_url).'" target="_blank"><img data-id="'.$image_id.'" src="'.esc_url($img_url).'"></a></li>';
            }
        }
        
        ?>

        <div class="form-listing-details">
            <div class="form-listing-details-row">

                <div class="listing-fields column-3">
                    <label for="listing_guest">No. of Guest</label>
                    <input type="text" name="listing_guests" id="listing_guests" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_guests', true) ) ?>">
                </div>

                <div class="listing-fields column-3">
                    <label for="listing_extra_guest_allowed">Extra Guest Allowed</label>
                    <input type="number" min="0" name="listing_extra_guest_allowed" id="listing_extra_guest_allowed" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_extra_guest_allowed', true) ) ?>">
                </div>

                <div class="listing-fields column-3">
                    <label for="listing_extra_guest_fee">Extra Guest Fee (<?= esc_attr( get_post_meta(get_the_ID(), 'listing_currency', true) ) ?>)</label>
                    <input type="number" min="0" name="listing_extra_guest_fee" id="listing_extra_guest_fee" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_extra_guest_fee', true) ) ?>">
                </div>
            
            </div>

            <div class="form-listing-details-row">
               <div class="listing-fields column-2">
                   <label for="listing_beds">No. of Bed</label>
                   <input type="text" name="listing_beds" id="listing_beds" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_beds', true) ) ?>">
               </div>

               <div class="listing-fields column-2">
                   <label for="listing_baths">No. of Bath</label>
                   <input type="text" name="listing_baths" id="listing_baths" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_baths', true) ) ?>">
               </div>
            </div>

            <div class="form-listing-details-row">
               <div class="listing-fields column-2">
                   <label for="listing_guest">Cleaning Fee (<?= esc_attr( get_post_meta(get_the_ID(), 'listing_currency', true) ) ?>)</label>
                   <input type="text" name="listing_cleaning_fee" id="listing_cleaning_fee" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_cleaning_fee', true) ) ?>">
               </div>

               <div class="listing-fields column-2">
                   <label for="listing_beds">Security Deposit (<?= esc_attr( get_post_meta(get_the_ID(), 'listing_currency', true) ) ?>)</label>
                   <input type="text" name="listing_security_deposit" id="listing_security_deposit" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_security_deposit', true) ) ?>">
               </div>

               <div class="listing-fields column-2">
                   <label for="listing_baths">Service Fees (<?= esc_attr( get_post_meta(get_the_ID(), 'listing_currency', true) ) ?>)</label>
                   <input type="text" name="listing_service_fee" id="listing_service_fee" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_service_fee', true) ) ?>">
               </div>

               <div class="listing-fields column-2">
                   <label for="listing_baths">Taxes %</label>
                   <input type="number" min='0' max='100' name="listing_tax" id="listing_tax" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_tax', true) ) ?>">
               </div>
            </div>

            <div class="form-listing-details-row">
                <div class="listing-fields column-3">
                    <label for="listing_id">Listing ID</label>
                    <input type="text" name="listing_id" id="listing_id" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_id', true) ) ?>">
                </div>

                <div class="listing-fields column-3">
                    <label for="listing_currency">Currency</label>
                    <input type="text" name="listing_currency" id="listing_currency" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_currency', true) ) ?>">
                </div>

                <div class="listing-fields column-3">
                    <label for="listing_price">Price</label>
                    <input type="text" name="listing_price" id="listing_price" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_price', true) ) ?>">
                </div>

            </div>

            <div class="form-listing-details-row">
                <div class="listing-fields">
                    <label for="listing_address">Address</label>
                    <input type="text" name="listing_address" id="listing_address" value="<?= esc_attr( get_post_meta(get_the_Id(), 'listing_address', true) ) ?>">
                </div>

                <div class="listing-fields column-2">
                    <label for="listing_latitude ">Latitude</label>
                    <input type="text" name="listing_latitude" id="listing_latitude" value="<?= esc_attr( get_post_meta(get_the_Id(), 'listing_latitude', true) ) ?>">
                </div>

                <div class="listing-fields column-2">
                    <label for="listing_longitude">Longitude</label>
                    <input type="text" name="listing_longitude" id="listing_longitude" value="<?= esc_attr( get_post_meta(get_the_Id(), 'listing_longitude', true) ) ?>">
                </div>
            </div>

            <div class="form-listing-details-row">
                <div class="listing-fields">
                    <label for="listing_gallery">Gallery</label>
                    <input type="text" name="listing_gallery" id="listing_gallery" value="<?= $listing_gallery ?>">

                    
                    <ul id="listing_media_lists" class="listing_media_lists" name="listing_gallery">
                        <?= $listing_gallery_html ?>
                    </ul>
                    <button id="listing_add_image_gallery" class="button">Upload Images</button>
                </div>
                <?php //property_gallery_metabox_callback(); ?>
            </div>

            <div class="form-listing-details-row">
                <div class="listing-fields">
                    <h3>Terms & Rules</h3>
                </div>
                <div class="listing-fields column-2">
                    <input type="hidden" name="smoking_allowed" id="smoking_allowed" value="<?= esc_attr( get_post_meta(get_the_ID(), 'smoking_allowed', true) ) ?>">
                    <input type="checkbox" name="cb_smoking_allowed" id="cb_smoking_allowed" value="<?= esc_attr( get_post_meta(get_the_ID(), 'cb_smoking_allowed', true) ) ?>" <?php if(get_post_meta(get_the_ID(), 'smoking_allowed', true) == "Yes" ){ echo 'checked'; }?> >
                    <label for="cb_smoking_allowed">Smoking allowed</label>
                </div>

                <div class="listing-fields column-2">
                    <input type="hidden" name="pets_allowed" id="pets_allowed" value="<?= esc_attr( get_post_meta(get_the_ID(), 'pets_allowed', true) ) ?>">
                    <input type="checkbox" name="cb_pets_allowed" id="cb_pets_allowed" value="<?= esc_attr( get_post_meta(get_the_ID(), 'cb_pets_allowed', true) ) ?>" <?php if(get_post_meta(get_the_ID(), 'pets_allowed', true) == "Yes" ){ echo 'checked'; }?> >
                    <label for="cb_pets_allowed">Pets allowed</label>
                </div>

                <div class="listing-fields column-2">
                    <input type="hidden" name="party_allowed" id="party_allowed" value="<?= esc_attr( get_post_meta(get_the_ID(), 'party_allowed', true) ) ?>">
                    <input type="checkbox" name="cb_party_allowed" id="cb_party_allowed" value="<?= esc_attr( get_post_meta(get_the_ID(), 'cb_party_allowed', true) ) ?>" <?php if(get_post_meta(get_the_ID(), 'party_allowed', true) == "Yes" ){ echo 'checked'; }?> >
                    <label for="cb_party_allowed">Party allowed</label>
                </div>

                <div class="listing-fields column-2">
                    <input type="hidden" name="children_allowed" id="children_allowed" value="<?= esc_attr( get_post_meta(get_the_ID(), 'children_allowed', true) ) ?>">
                    <input type="checkbox" name="cb_children_allowed" id="cb_children_allowed" value="<?= esc_attr( get_post_meta(get_the_ID(), 'cb_children_allowed', true) ) ?>" <?php if(get_post_meta(get_the_ID(), 'children_allowed', true) == "Yes" ){ echo 'checked'; }?> >
                    <label for="cb_children_allowed">Children allowed</label>
                </div>
            </div>

        </div>
        <?php

    }
}

function property_gallery_metabox_callback(){
	wp_nonce_field( basename(__FILE__), 'sample_nonce' );
	global $post;
	$gallery_data = get_post_meta( $post->ID, 'gallery_data', true );
	?>
	<div id="gallery_wrapper">
		<div id="img_box_container">
		<?php 
		if ( isset( $gallery_data['image_url'] ) ){
			for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ){
			?>
			<div class="gallery_single_row dolu">
			  <div class="gallery_area image_container ">
				<!-- <img class="gallery_img_img" src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)"/> -->
                <img class="gallery_img_img" src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="55" width="55" />
				<input type="hidden"
						 class="meta_image_url"
						 name="gallery[image_url][]"
						 value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
				  />
			  </div>
			  <div class="gallery_area">
                <!-- <span class="button remove" onclick="remove_img(this)" title="Remove"><i class="fas fa-trash-alt"></i></span> -->
				<span class="button remove" title="Remove"><i class="fas fa-trash-alt"></i></span>
			  </div>
			  <div class="clear">
			</div> 
			</div>
			<?php
			}
		}
		?>
		</div>
		<div style="display:none" id="master_box">
			<div class="gallery_single_row">
				<div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
					<input class="meta_image_url" value="" type="hidden" name="gallery[image_url][]" />
				</div> 
				<div class="gallery_area"> 
					<!-- <span class="button remove" onclick="remove_img(this)" title="Remove"><i class="fas fa-trash-alt"></i></span> -->
                    <span class="button remove" title="Remove"><i class="fas fa-trash-alt"></i></span>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div id="add_gallery_single_row">
        <!-- <input class="button add" type="button" value="+" onclick="open_media_uploader_image_plus();" title="Add image"/> -->
		  <input class="button add" id="listing_add_gallery_image" type="button" value="+" title="Add image"/>
		</div>
	</div>
	<?php
}


add_action( 'wp_ajax_nopriv_boostly_api_sync_listings_ajax', 'boostly_api_sync_listings_ajax' );
add_action( 'wp_ajax_boostly_api_sync_listings_ajax', 'boostly_api_sync_listings_ajax' );
function boostly_api_sync_listings_ajax(){
    ob_start();
    $file = "http://localhost/staging-api/wp-content/plugins/boostly-api/demo-listings.csv"; 
    $handle = fopen($file, "r") or die("Error opening file");

    $i = 0;
    while(($line = fgetcsv($handle)) !== FALSE) {
        if($i == 0) {
            $c = 0;
            foreach($line as $col) {
                $cols[$c] = $col;
                $c++;
            }
        } else if($i > 0) {
            $c = 0;
            foreach($line as $col) {
                $listings_data[$i][$cols[$c]] = $col;
                $c++;
            }
        }
        $i++;
    }
    fclose($handle);

    // var_dump(json_encode($listings_data));
    foreach ($listings_data as $listing_data) {
        if (is_array($listing_data)) {
            
            if ($listing_data) {
                // echo "<pre>";
                // var_dump($listing_data);
                // echo "</pre>";
                // wp_set_post_terms(25, $listing_data['city'], 'listing_city');
                $check_post = post_exists($listing_data['name'], '', '', 'listing');
                if (!$check_post) {
                    boostly_api_add_listing($listing_data);
                }
            }

            
        }
        // break;
    }
    // return encode_json[$listing_data];

    $response = ob_get_contents();
    ob_end_clean();
    echo $response;
    die(1);
}

if( !function_exists( 'boostly_api_add_listing' ) ) {
    function boostly_api_add_listing($listing_data){
        
        $post_id = wp_insert_post( array(
           'post_title'    => $listing_data['name'],
           'post_type'     => 'listing',
           'post_content'  => $listing_data['description'],
           'post_status'   => 'publish',
           'post_date'     => date( 'Y-m-d H:i:s', time() ),
           'post_author'   => get_current_user_id()
        ), true);

        if ($listing_data['guests']) {
            update_post_meta($post_id, 'listing_guests', $listing_data['guests']);
        }

        if ($listing_data['no_of_beds']) {
            update_post_meta($post_id, 'listing_beds', $listing_data['no_of_beds']);
        }

        if ($listing_data['no_of_baths']) {
            update_post_meta($post_id, 'listing_baths', $listing_data['no_of_baths']);
        }

        if ($listing_data['id']) {
            update_post_meta($post_id, 'listing_id', $listing_data['id']);
        }

        if ($listing_data['base_price']) {
            update_post_meta($post_id, 'listing_price', $listing_data['base_price']);
        }

        if ($listing_data['currency']) {
            update_post_meta($post_id, 'listing_currency', $listing_data['currency']);
        }

        if ($listing_data['address']) {
            update_post_meta($post_id, 'listing_address', $listing_data['address']);
        }

        if ($listing_data['latitude']) {
            update_post_meta($post_id, 'listing_latitude', $listing_data['latitude']);
        }

        if ($listing_data['longitude']) {
            update_post_meta($post_id, 'listing_longitude', $listing_data['longitude']);
        }

        if ($listing_data['feature_image']) {
            $attachment_id = boostly_images_upload($listing_data['feature_image']);
            set_post_thumbnail($post_id, $attachment_id);
        }
        
        if ($listing_data['galllery_images']) {
            $gallery = str_replace(",,", ",", $listing_data['galllery_images']);
            $gallery_array = explode(',', $listing_data['galllery_images']);
            $listing_gallery = get_post_meta($post_id, 'listing_gallery', true);
            foreach ($gallery_array as $key => $image) {
                // var_dump($image);
                $listing_gallery = get_post_meta($post_id, 'listing_gallery', true);
                $attachment_id;
                // Check if the url isn't 404
                // Initializing new session
                $ch = curl_init($image);
                // Request method is set
                curl_setopt($ch, CURLOPT_NOBODY, true);
                
                // Executing cURL session
                curl_exec($ch);
                
                // Getting information about HTTP Code
                $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                // Testing for 404 Error
                if($retcode == 200) {
                    $attachment_id = boostly_images_upload($image);
                }

                // if(!$listing_gallery){
                if($attachment_id){
                    update_post_meta($post_id, 'listing_gallery',$listing_gallery.", ".$attachment_id );
                }
                
                // } else{
                //     update_post_meta($post_id, 'listing_gallery', $attachment_id );
                // }
                // break;
            }     
            $listing_gallery_trim = substr(get_post_meta($post_id, 'listing_gallery', true), 2);
            $listing_gallery_trim = str_replace(", , ", ", ",$listing_gallery_trim);
            update_post_meta($post_id, 'listing_gallery', $listing_gallery_trim );
        }
        

        // amenities
        $amenities = explode(",",$listing_data['amenities']);
        if (!empty($amenities)) {
            foreach ($amenities as $key => $amenity) {
                if (!empty($amenity) && $amenity == true) {
                    $amenity = trim($amenity);
                    $amenity_name = boostly_api_prepare_amenities( $amenity );
                    
                    if( !empty( $amenity_name ) ) {
                        boostly_set_listing_category( $amenity_name, $post_id, 'listing_amenities');
                    }
                }
            }
        }

        // create location taxonomies
        if (!empty($listing_data['city'])) {
            boostly_set_listing_category($listing_data['city'], $post_id, 'listing_city');
        } 
        // if (!empty($state)) {
        //     boostly_set_listing_category($state, $post_id, 'listing_state');
        // }
        if (!empty($listing_data['country'])) {
            boostly_set_listing_category($listing_data['country'], $post_id, 'listing_country');
        } 

        if (!empty($listing_data['type'])) {
            boostly_set_listing_category($listing_data['type'], $post_id, 'listing_type');
        }
        
    }
}

add_action( 'wp_ajax_nopriv_boostly_api_delete_listings_ajax', 'boostly_api_delete_listings_ajax' );
add_action( 'wp_ajax_boostly_api_delete_listings_ajax', 'boostly_api_delete_listings_ajax' );
function boostly_api_delete_listings_ajax(){
    $listing_posts= get_posts( array('post_type'=>'listing','numberposts'=>-1) );
    foreach ($listing_posts as $listing_post) {
        $img_id = get_post_thumbnail_id($listing_post->ID);
        wp_delete_attachment($img_id);

        $listing_gallery = get_post_meta($listing_post->ID, 'listing_gallery', true);
        $listing_gallery_images = explode(', ', $listing_gallery);
        if($listing_gallery){
            foreach ($listing_gallery_images as $image_id){
                wp_delete_attachment($image_id);
            }
        }

        wp_delete_post( $listing_post->ID, true );

        $taxonomies = get_taxonomies(['object_type' => ['listing']]);
        foreach ( $taxonomies as $name ) {
            delete_all_terms($name);
        }
    }
    
}
if( !function_exists( 'delete_all_terms' ) ) {
    function delete_all_terms($taxonomy_name){
        $terms = get_terms( array(
            'taxonomy' => $taxonomy_name,
            'hide_empty' => false
        ) );
        foreach ( $terms as $term ) {
            wp_delete_term($term->term_id, $taxonomy_name); 
        }        
    }
}

// add_action('init', 'boostly_images_upload', 0);
if( !function_exists( 'boostly_images_upload' ) ) {
    function boostly_images_upload($imageurl){
        include_once( ABSPATH . 'wp-admin/includes/image.php' );

        // $imageurl = "https://a0.muscache.com/im/pictures/miso/Hosting-33996825/original/082485ca-b801-4f51-87aa-84e682871df9.jpeg?im_w=1200";
        if($imageurl){
            $imagetype = end(explode('/', getimagesize($imageurl)['mime']));
            $uniq_name = date('dmY').''.(int) microtime(true); 
            $filename = $uniq_name.'.'.$imagetype;
            if($filename){
                $uploaddir = wp_upload_dir();
                $uploadfile = $uploaddir['path'] . '/' . $filename;
                $contents= file_get_contents($imageurl);
                $savefile = fopen($uploadfile, 'w');
                fwrite($savefile, $contents);
                fclose($savefile);
                $wp_filetype = wp_check_filetype(basename($filename), null );
                if($wp_filetype){
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => $filename,
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );
                    if($attachment && $uploadfile ){
                        $attach_id = wp_insert_attachment( $attachment, $uploadfile );
                        $imagenew = get_post( $attach_id );
                        $fullsizepath = get_attached_file( $imagenew->ID );
                        $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
                        wp_update_attachment_metadata( $attach_id, $attach_data ); 
            
                        return $attach_id;
                    }

                }
            }
        }
        return;
    }
}


if( !function_exists( 'boostly_set_listing_category' ) ) {
    
    /**
     * boostly_set_listing_category
     *
     * @param  mixed $name
     * @param  mixed $id
     * @param  mixed $type
     * @param  mixed $parent_id
     * @return void
     */
    function boostly_set_listing_category( $name, $id, $type, $parent_id = 0 ) {

        if (is_array($name)) return;

        if (!empty($name)) {
            $terms = term_exists($name, $type);

            if ($terms !== 0 && $terms !== null) {
                $term_id = $terms['term_id'];
            } else {
                $terms   = ($parent_id != 0) ? wp_insert_term($name, $type, array('parent' => $parent_id)) : wp_insert_term($name, $type);
                $term_id = $terms['term_id'];
            }

            wp_set_object_terms($id, array($name), $type, true);

            return $term_id;
        }

    }

}

/**
 * boostly_api_prepare_amenities
 *
 * @param  mixed $str
 * @return void
 */
if( !function_exists( 'boostly_api_prepare_amenities' ) ) {
    function boostly_api_prepare_amenities( $str ) {

        if( !empty( $str ) ) {

            $str = str_replace("has", "", $str);
            $str = preg_split('/(?=[A-Z])/', $str, -1, PREG_SPLIT_NO_EMPTY);
            if( !empty( $str) && is_array( $str) ) {
                $str = implode(" ", $str);
        
            }

        }

        return $str;

    }
}
