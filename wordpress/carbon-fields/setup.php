<?php

/* Load functions for frontend */
require_once( THEME_INC_DIR . 'carbon-fields/functions-frontend.php' );

if ( ! is_admin() )
    return;

// Setup Carbon Fields (installed via composer) 
add_action( 'after_setup_theme', 'rmrt_carbon_fields_load' );

// Register Fields 
add_action( 'carbon_fields_register_fields', 'rmrt_carbon_fields_register_fields' );

/**
 * Load Carbon Fields
 */
function rmrt_carbon_fields_load() {

    require_once( THEME_INC_DIR . 'vendor/autoload.php' );
    require_once( THEME_INC_DIR . 'carbon-fields/custom-theme-options.php' );
    require_once( THEME_INC_DIR . 'carbon-fields/custom-post-meta.php' );
    
    \Carbon_Fields\Carbon_Fields::boot();

    /* Remove default capability restricting theme-options */
    add_filter( 'carbon_fields_theme_options_container_admin_only_access', '__return_false' );

    /* Register Google Maps API */
    add_action( 'carbon_fields_map_field_api_key', 'rmrt_get_google_maps_api_key' );
}

/**
 * Register Options
 */
function rmrt_carbon_fields_register_fields() {
    include_once( THEME_INC_DIR . 'carbon-fields/functions-helpers.php' );
    include_once( THEME_INC_DIR . 'carbon-fields/setup-theme-options.php' );
    include_once( THEME_INC_DIR . 'carbon-fields/setup-post-meta.php' );
}
