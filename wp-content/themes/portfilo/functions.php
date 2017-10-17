<?php
/**
   Portfilo theme functions and definitions
 * @package Portfilo
 * @author August Infotech
 */

define('PORTFILO_THEME_DIR', get_template_directory());
define('PORTFILO_THEME_URI', get_template_directory_uri());
define('PORTFILO_SITE_URL', site_url());

define('PORTFILO_LIBS_DIR', PORTFILO_THEME_DIR. '/inc');
define('PORTFILO_LIBS_URI', PORTFILO_THEME_URI. '/inc');
define('PORTFILO_LANG_DIR', PORTFILO_THEME_DIR. '/languages');

define('PORTFILO_THEME_VERSION', '1.0');

/* ---------------------------------------------------------------------------
 * Loads Theme Files
* --------------------------------------------------------------------------- */
 
// Loads Theme Functions ------------------------------------------------------------------
require_once( PORTFILO_THEME_DIR. '/functions/theme-functions.php' );

// Load Header Theme Fucntion -------------------------------------------------------------
require_once( PORTFILO_THEME_DIR. '/functions/theme-head.php' );

// Load Theme Layout ----------------------------------------------------------------------
require_once( PORTFILO_THEME_DIR. '/functions/theme-layouts.php' );

// Load Theme Menu ------------------------------------------------------------------------
require_once( PORTFILO_THEME_DIR. '/functions/theme-menu.php' );


// Load Theme Shortcode -------------------------------------------------------------------
require_once( PORTFILO_THEME_DIR. '/functions/class-tgm-plugin-activation.php' );

/**
 * Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Portfolio theme only works in WordPress 3.6 or later.
 */
/*if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}
*/

/**
 * Adjust content_width value for image attachment template.
 */

if ( ! function_exists( 'portfilo_portfoliotheme_content_width' ) ) :
 
function portfilo_portfoliotheme_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
endif; // portfilo_portfoliotheme_content_width
add_action( 'template_redirect', 'portfilo_portfoliotheme_content_width' );


/**
 * Register three Portfolio theme widget areas.
 */
if ( ! function_exists( 'portfilo_portfoliotheme_widgets_init' ) ) :
 
function portfilo_portfoliotheme_widgets_init() {
	

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'portfilo' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar.', 'portfilo' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><div class="title-divider"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'portfilo' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar.', 'portfilo' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><div class="title-divider"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Homepage Title area', 'portfilo' ),
		'id'            => 'homepage-title',
		'description'   => __( 'Add homepage main sction title and content here.', 'portfilo' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="section-title">',
		'after_title'   => '</h2><div class="section-divider divider-inside-top"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Homepage Content area', 'portfilo' ),
		'id'            => 'homepage-content',
		'description'   => __( 'Add homepage main sction content text here.', 'portfilo' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'portfilo' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'portfilo' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"></h4>',
		'after_title'   => '<div class="title-divider"></div>',
	) );
}

endif; // portfilo_portfoliotheme_widgets_init
add_action( 'widgets_init', 'portfilo_portfoliotheme_widgets_init' );
   


if ( ! function_exists( 'portfilo_remove_comment_fields' ) ) : 

function portfilo_remove_comment_fields($portfilo_fields) {
   
    unset($portfilo_fields['url']);
    return $portfilo_fields;
}
endif; // portfilo_remove_comment_fields
add_filter('comment_form_default_fields', 'portfilo_remove_comment_fields');

//remove_filter( 'the_content', 'wpautop' );

require get_template_directory() . '/inc/customizer.php';
