<?php

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
            </div>
            <?= boostly_api_sync_listings_ajax(); ?>
        </div>
        <?php

    }
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

add_action( 'wp_ajax_nopriv_boostly_api_delete_listings_ajax', 'boostly_api_delete_listings_ajax' );
add_action( 'wp_ajax_boostly_api_delete_listings_ajax', 'boostly_api_delete_listings_ajax' );
function boostly_api_delete_listings_ajax(){
    $listing_posts= get_posts( array('post_type'=>'listing','numberposts'=>-1) );
    foreach ($listing_posts as $listing_post) {
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



// add_action('init', 'boostly_images_upload', 0);
if( !function_exists( 'boostly_images_upload' ) ) {
    function boostly_images_upload($imageurl){
        include_once( ABSPATH . 'wp-admin/includes/image.php' );

        // $imageurl = "https://a0.muscache.com/im/pictures/miso/Hosting-33996825/original/082485ca-b801-4f51-87aa-84e682871df9.jpeg?im_w=1200";
        $imagetype = end(explode('/', getimagesize($imageurl)['mime']));
        $uniq_name = date('dmY').''.(int) microtime(true); 
        $filename = $uniq_name.'.'.$imagetype;

        $uploaddir = wp_upload_dir();
        $uploadfile = $uploaddir['path'] . '/' . $filename;
        $contents= file_get_contents($imageurl);
        $savefile = fopen($uploadfile, 'w');
        fwrite($savefile, $contents);
        fclose($savefile);

        $wp_filetype = wp_check_filetype(basename($filename), null );
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => $filename,
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment( $attachment, $uploadfile );
        $imagenew = get_post( $attach_id );
        $fullsizepath = get_attached_file( $imagenew->ID );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
        wp_update_attachment_metadata( $attach_id, $attach_data ); 

        return $attach_id;
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
