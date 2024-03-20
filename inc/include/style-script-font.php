<?php

// Add css and script
function imagroup_add_css_script(){

    // Register Styles
    wp_enqueue_style( 'imagroup-fonts-css', 'https://use.typekit.net/teb7ubj.css', array(), IMAGROUP_THEME_VERSION, 'all' );
    wp_enqueue_style( 'imagroup-library-css', get_template_directory_uri().'/assets/css/library.min.css', array(), IMAGROUP_THEME_VERSION, 'all' );
    wp_enqueue_style( 'imagroup-animate-css', get_template_directory_uri().'/assets/css/animate.css', array(), IMAGROUP_THEME_VERSION, 'all' );
    wp_enqueue_style( 'imagroup-style-css', get_template_directory_uri().'/assets/css/style.css', array(), IMAGROUP_THEME_VERSION, 'all' );
    wp_enqueue_style( 'imagroup-additional-styles-css', get_template_directory_uri().'/assets/css/additional_styles.css', array(), IMAGROUP_THEME_VERSION, 'all' );
    wp_enqueue_style( 'imagroup-responsive-css', get_template_directory_uri().'/assets/css/responsive.css', array(), IMAGROUP_THEME_VERSION, 'all' );
    wp_enqueue_style( 'imagroup-imagroup-style', get_stylesheet_uri(), array(), IMAGROUP_THEME_VERSION, 'all' );
    
    // Register Scripts
    
    // HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    // WARNING: Respond.js doesn't work if you view the page via file://
    wp_enqueue_script( 'wp-html5shiv', 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js' );
    wp_script_add_data( 'wp-html5shiv', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'wp-respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js' );
    wp_script_add_data( 'wp-respond', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'imagroup-library-js', get_template_directory_uri().'/assets/js/library.min.js', array('jquery') );
    wp_enqueue_script( 'imagroup-script-js', get_template_directory_uri().'/assets/js/script.js', array('jquery') );
    
    $googlemap_api_key = imagroup_theme_option('api_key');

    wp_enqueue_script('google-marker-clusterer', 'https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js', [], '1.0', false );
    // wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?libraries=places&language=' . get_locale() . '&key=' . esc_html($googlemap_api_key), array('jquery'), '1.0', false );

    // Ajax Calls
    wp_enqueue_script( 'helper-console', get_template_directory_uri() . '/assets/js/helper-console.js', [], IMAGROUP_THEME_VERSION, true );
    wp_enqueue_script( 'imagroup-ajax-where-to-find-us', get_template_directory_uri() . '/assets/js/imagroup-ajax-where-to-find-us.js', array('jquery'), IMAGROUP_THEME_VERSION, true );
    wp_enqueue_script( 'imagroup_ajax_calls', get_template_directory_uri() . '/assets/js/imagroup-ajax-call.js', array('jquery'), IMAGROUP_THEME_VERSION, true );
    wp_enqueue_script( 'imagroup_ajax_calls_utils', get_template_directory_uri() . '/assets/js/imagroup_ajax_calls_utils.js', array('jquery'), IMAGROUP_THEME_VERSION, true );
    wp_localize_script( 'imagroup_ajax_calls', 'IMAGroup_ajax_calls_vars',
        array(
            'admin_url' => get_admin_url(),
            'googlemap_default_zoom' => imagroup_theme_option( 'default_map_zoom' ),
            'google_map_style' => imagroup_theme_option('map_style'),
        )
    );
    
}
add_action( 'wp_enqueue_scripts', 'imagroup_add_css_script' );

?>