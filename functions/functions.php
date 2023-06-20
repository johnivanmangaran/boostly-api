<?php

// boostly_api_meta_box - Listing Data

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


// boostly_api_meta_box - Listing Details

function boostly_api_custom_fields($post) {

    ?>

    <style>
        .form-listing-details{
            margin-top:  20px;
        }

        .form-listing-details-row{
            width:  100%;
            display:  flex;
            flex-wrap: wrap;
            column-gap: 20px;
            row-gap: 20px;
            margin-top: 20px;
        }

        .form-listing-details-row:first-child{
            margin-top: 0;
        }

        .listng-fields,
        .listng-fields > input{
            width: 100%;
        }
        .listng-fields.column-2{
            width: 49%;
        }
        .listng-fields.column-3{
            width: 32%;
        }
    </style>
    <div class="form-listing-details">
        <div class="form-listing-details-row">
           <div class="listng-fields column-3">
               <label for="listing_guest">No. of Guest</label>
               <input type="text" name="listing_guests" id="listing_guests" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_guests', true) ) ?>">
           </div>

           <div class="listng-fields column-3">
               <label for="listing_beds">No. of Bed</label>
               <input type="text" name="listing_beds" id="listing_beds" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_beds', true) ) ?>">
           </div>

           <div class="listng-fields column-3">
               <label for="listing_baths">No. of Bath</label>
               <input type="text" name="listing_baths" id="listing_baths" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_baths', true) ) ?>">
           </div>
        </div>

        <div class="form-listing-details-row">
            <div class="listng-fields column-3">
                <label for="listing_id">Listing ID</label>
                <input type="text" name="listing_id" id="listing_id" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_id', true) ) ?>">
            </div>

            <div class="listng-fields column-3">
                <label for="listing_currency">Currency</label>
                <input type="text" name="listing_currency" id="listing_currency" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_currency', true) ) ?>">
            </div>

            <div class="listng-fields column-3">
                <label for="listing_price">Price</label>
                <input type="text" name="listing_price" id="listing_price" value="<?= esc_attr( get_post_meta(get_the_ID(), 'listing_price', true) ) ?>">
            </div>

        </div>


        <div class="form-listing-details-row">
            <div class="listng-fields">
                <label for="listing_address">Address</label>
                <input type="text" name="listing_address" id="listing_address" value="<?= esc_attr( get_post_meta(get_the_Id(), 'listing_address', true) ) ?>">
            </div>

            <div class="listng-fields column-2">
                <label for="listing_latitude ">Latitude</label>
                <input type="text" name="listing_latitude" id="listing_latitude" value="<?= esc_attr( get_post_meta(get_the_Id(), 'listing_latitude', true) ) ?>">
            </div>

            <div class="listng-fields column-2">
                <label for="listing_longitude">Longitude</label>
                <input type="text" name="listing_longitude" id="listing_longitude" value="<?= esc_attr( get_post_meta(get_the_Id(), 'listing_longitude', true) ) ?>">
            </div>
        </div>
        <div>
        <?= boostly_reading_csv(); ?>
        </div>

    </div>
    <?php
}


// add_action('init', 'boostly_reading_csv', 0);
function boostly_reading_csv() {
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
            echo "<pre>";
            var_dump($listing_data);
            echo "</pre>";
            $post_id = wp_insert_post(
               array(
                       'post_title'    => $listing_data['name'],
                       'post_type'     => 'listings',
                       'post_content'  => $listing_data['description'],
                       'post_status'   => 'draft',
                       'post_date'     => date( 'Y-m-d H:i:s', time() ),
                       'post_author'   => get_current_user_id()
                )
            );

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


        }
        break;
    }
}