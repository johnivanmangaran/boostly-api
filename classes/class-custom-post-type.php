<?php


//Custom Post Type
add_action('init', 'create_listing_cpt', 0);

//Custom Taxonomy
add_action('init', 'category_listing_type', 0);
add_action('init', 'category_listing_city', 0);
add_action('init', 'category_listing_country', 0);
add_action('init', 'category_listing_state', 0);
add_action('init', 'category_listing_amenities', 0);

//Listing Save Post
add_action('save_post','save_meta_box_data');

//Custom Listing Post Type
function create_listing_cpt() {
    $labels = array(
        'name' => esc_html__( 'Listings','boostly-api-training'),
        'singular_name' => esc_html__( 'Listing','boostly-api-training' ),
        'add_new' => esc_html__('Add New','boostly-api-training'),
        'add_new_item' => esc_html__('Add New','boostly-api-training'),
        'edit_item' => esc_html__('Edit Listing','boostly-api-training'),
        'new_item' => esc_html__('New Listing','boostly-api-training'),
        'view_item' => esc_html__('View Listing','boostly-api-training'),
        'search_items' => esc_html__('Search Listing','boostly-api-training'),
        'not_found' =>  esc_html__('No Listing found','boostly-api-training'),
        'not_found_in_trash' => esc_html__('No Listing found in Trash','boostly-api-training'),
        'parent_item_colon' => ''
      );

    $labels = apply_filters( 'homey_listing_post_type_labels', $labels );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'map_meta_cap'    => true,
        'hierarchical' => true,
        'menu_icon' => 'dashicons-admin-multisite',
        'menu_position' => 20,
        'can_export' => true,
        'custom-fields' => true,
        'show_in_rest'       => true,
        'supports' => array('title','editor','thumbnail','revisions','author','page-attributes','excerpt'),
    );

    $args = apply_filters( 'homey_listing_post_type_args', $args );

    register_post_type('listing',$args);
}

//Custom Listing Post Type End

//Custom Taxonomy of Listing Post Type

//Listing Type Category
function category_listing_type() {

    $listing_city_labels = array(
        'name'              => esc_html__('Listing Type','boostly-api-training'),
        'add_new_item'      => esc_html__('Add New','boostly-api-training'),
        'new_item_name'     => esc_html__('New Listing Type','boostly-api-training')
    );
    $listing_city_labels = apply_filters( 'category_listing_type_labels', $listing_city_labels );

    $args = array(
        'labels' => $listing_city_labels,
        'hierarchical'  => true,
        'query_var'     => true,
        'show_in_rest'  => true,
        'rest_base'     => 'listing_type',
    );
    $args = apply_filters( 'category_listing_type_args', $args );

    register_taxonomy('listing_type', 'listing', $args);
}

//Listings City Category

function category_listing_city() {

    $listing_city_labels = array(
        'name'              => esc_html__('City','boostly-api-training'),
        'add_new_item'      => esc_html__('Add New','boostly-api-training'),
        'new_item_name'     => esc_html__('New City','boostly-api-training')
    );
    $listing_city_labels = apply_filters( 'category_listing_city_labels', $listing_city_labels );

    $args = array(
        'labels' => $listing_city_labels,
        'hierarchical'  => true,
        'query_var'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'listing_cities',
    );
    $args = apply_filters( 'category_listing_city_args', $args );

    register_taxonomy('listing_city', 'listing', $args);
}

//Listings Country Category
function category_listing_country() {

    $listing_country_labels = array(
        'name'              => esc_html__('Country','boostly-api-training'),
        'add_new_item'      => esc_html__('Add New','boostly-api-training'),
        'new_item_name'     => esc_html__('New Country','boostly-api-training')
    );
    $listing_country_labels = apply_filters( 'category_listing_country_labels', $listing_country_labels );

    $args = array(
        'labels' => $listing_country_labels,
        'hierarchical'  => true,
        'query_var'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'listing_countries',
    );
    $args = apply_filters( 'category_listing_country_args', $args );

    register_taxonomy('listing_country', 'listing', $args);
}


//Listings State Category
function category_listing_state() {

    $listing_state_labels = array(
        'name'              => esc_html__('State','boostly-api-training'),
        'add_new_item'      => esc_html__('Add New','boostly-api-training'),
        'new_item_name'     => esc_html__('New State','boostly-api-training')
    );
    $listing_state_labels = apply_filters( 'category_listing_state_labels', $listing_state_labels );

    $args = array(
        'labels' => $listing_state_labels,
        'hierarchical'  => true,
        'query_var'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'listing_states',
    );
    $args = apply_filters( 'category_listing_state_args', $args );

    register_taxonomy('listing_state', 'listing', $args);
}

//Listings Amenities Category

function category_listing_amenities() {

    $listing_amenities_labels = array(
        'name'              => esc_html__('Amenities','boostly-api-training'),
        'add_new_item'      => esc_html__('Add New','boostly-api-training'),
        'new_item_name'     => esc_html__('New Amenities','boostly-api-training')
    );
    $listing_amenities_labels = apply_filters( 'category_listing_amenities_labels', $listing_amenities_labels );

    $args = array(
        'labels' => $listing_amenities_labels,
        'hierarchical'  => true,
        'query_var'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'listing_amenities',
    );
    $args = apply_filters( 'category_listing_amenities_args', $args );

    register_taxonomy('listing_amenities', 'listing', $args);
}


//Custom Taxonomy of Listing Post Type End


//Listing Meta Boxes
add_action('add_meta_boxes','boostly_listing_meta_boxes');

//Custom Listing Meta Boxes 
function boostly_listing_meta_boxes() {
    add_meta_box('listing-details', 'Listing Details', 'boostly_api_custom_fields', 'listing');
    add_meta_box('listing-meta', 'Listing Data', 'boostly_api_meta_box_data', 'listing');
    add_meta_box('listing-availability', 'Availability', 'boostly_api_metabox_availability', 'listing');
    
}
//Custom Listing Meta Boxes End

//Save Listing Meta Boxes 
function save_meta_box_data($post_id) {
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if ( $parent_id = wp_is_post_revision( $post_id )) {
        $post_id = $parent_id;
    }

    $field_list = [
        'listing_guests',
        'listing_beds',
        'listing_baths',
        'listing_price',
        'listing_currency',
        'listing_address',
        'listing_latitude',
        'listing_longitude',
        'listing_id',
        'listing_gallery',
    ];
        // update_post_meta($post_id, 'boostly_geolocation_long', $long);
    foreach ($field_list as $fieldName) {
        if (array_key_exists( $fieldName, $_POST)) {
            update_post_meta( $post_id, $fieldName, sanitize_text_field($_POST[$fieldName]) );
        }
    }
    

}
//Save Listing Meta Boxes End
