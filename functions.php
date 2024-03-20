<?php

define( 'IMAGROUP_THEME_NAME', 'imagroup' );
define( 'IMAGROUP_THEME_SLUG', 'imagroup' );
define( 'IMAGROUP_THEME_VERSION', '1.0.1' );

define( 'ALLOW_UNFILTERED_UPLOADS', true );
define( 'IMAGE_ASSETS_URL', get_template_directory_uri().'/assets/images' );

function imagroup_setup(){

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Add support for post thumbnails.
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'woocommerce' );

	// Set port default thumbnails
	set_post_thumbnail_size( 150, 150 );
	add_image_size( 'news-thumbnail', 720, 380, true );
    add_image_size( 'news-thumbnail-v2', 360, 189, true );
	
	// Register nav menus
	register_nav_menus( array(
		'main-menu' => esc_html__( 'Main Menu', 'imagroup' ),
	) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Remove gallery style css
	add_filter( 'use_default_gallery_style', '__return_false' );

}
add_action( 'after_setup_theme', 'imagroup_setup' );

// ACF theme options
if( function_exists('acf_add_options_page') ){
	acf_add_options_page( array(
		'page_title' 	=> esc_html__( 'Theme Options', 'imagroup' ),
		'menu_title'	=> esc_html__( 'Theme Options', 'imagroup' ),
		'menu_slug' 	=> esc_html__( 'imagroup_option', 'imagroup' ),
		'capability'	=> esc_html__( 'edit_posts', 'imagroup' ),
		'redirect'		=> false
	) );
}

// Enqueue scripts, styles and fonts.
require_once( get_template_directory() . '/inc/include/style-script-font.php' );

// Helper functions
require_once( get_template_directory() . '/inc/functions/helper-functions.php' );
require_once( get_template_directory() . '/inc/functions/helper-explore-our-sites.php' );
require_once( get_template_directory() . '/inc/functions/helper-locations-radius.php' );

/*----------------------------------------------------------------------
Allow SVG upload
------------------------------------------------------------------------*/
function imagroup_svg_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$new_filetypes['svgz'] = 'image/svg+xml';
    $new_filetypes['exe'] = 'application/exe';
	$file_types = array_merge( $file_types, $new_filetypes );
	return $file_types;
}
add_action( 'upload_mimes', 'imagroup_svg_uploads' );

/*----------------------------------------------------------------------
Disable gutenberg editor
------------------------------------------------------------------------*/
add_filter( 'use_block_editor_for_post', '__return_false' );

/*----------------------------------------------------------------------
Set Excerpt Length
------------------------------------------------------------------------*/
add_filter( 'excerpt_length', function( $length ) { return 17; }, 999 );

/*----------------------------------------------------------------------
Excerpt Read More
------------------------------------------------------------------------*/
add_filter( 'excerpt_more', function( $length ) { return '...'; }, 999 );

/*----------------------------------------------------------------------
Remove <p> and <br/> from Contact Form 7
------------------------------------------------------------------------*/
add_filter( 'wpcf7_autop_or_not', '__return_false' );

//  Added 2023/12/13 - sf helpers
include_once 'helpers/helpers-sf.php';

?>