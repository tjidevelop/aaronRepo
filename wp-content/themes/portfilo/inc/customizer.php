<?php
/**
 * Portfilo Customizer functionality
 *
 * @package Portfilo
 * @since Portfilo 1.0
 */

function portfilo_customize_register( $wp_customize ) {
	
	/* Load JavaScript files. */
	add_action( 'customize_preview_init', 'portfilo_enqueue_customizer_scripts' );

	/* Enable live preview for WordPress theme features. */
	$wp_customize->get_setting( 'blogname' )->transport              = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport       = 'postMessage';
	
	
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'portfilo' );
   //All our sections, settings, and controls will be added here
  

/**----------------------------------------------------------------
* 
* Colors Section
* 
-------------------------------------------------------------------*/
  
$colors = array();

$colors[] = array(
  'slug'=>'bodybg_color', 
  'default' => '#ffffff',
  'label' => __('Body Background Color', 'portfilo'),
  
);

$colors[] = array(
  'slug'=>'headerbg_color', 
  'default' => '#030501',
  'label' => __('Header Background Color', 'portfilo')
);

$colors[] = array(
  'slug'=>'footerbg_color', 
  'default' => '#000000',
  'label' => __('Footer Background Color', 'portfilo')
);

$colors[] = array(
  'slug'=>'menu_color', 
  'default' => '#ffffff',
  'label' => __('Menu Color', 'portfilo')
);

$colors[] = array(
  'slug'=>'hover_menu_color', 
  'default' => '#D9534F',
  'label' => __('Hover Menu Color', 'portfilo')
);

$colors[] = array(
  'slug'=>'breadcrumb_bg_color', 
  'default' => '#f0f0f0',
  'label' => __('Breadcrumb Background Color', 'portfilo')
);

$colors[] = array(
  'slug'=>'link_color', 
  'default' => '#8f8f8f',
  'label' => __('Link Color', 'portfilo')
);

$colors[] = array(
  'slug'=>'link_hover_color', 
  'default' => '#D9534F',
  'label' => __('Link Hover Color', 'portfilo')
);

$colors[] = array(
  'slug'=>'link_bg_color', 
  'default' => '#D9534F',
  'label' => __('Link Background Color', 'portfilo')
);

$colors[] = array(
  'slug'=>'title_font_color', 
  'default' => '#666262',
  'label' => __('Heading Color', 'portfilo')
);

$colors[] = array(
  'slug'=>'content_font_color', 
  'default' => '#9b9999',
  'label' => __('Content Color', 'portfilo')
);

$wp_customize->add_section( 'colors', array(
	'title' => __( 'Theme Colors', 'portfilo' ),
	'priority' => 3,
) );

foreach( $colors as $color ) {
  // SETTINGS
  $wp_customize->add_setting(
    $color['slug'], array(
      'default' => $color['default'],
      'sanitize_callback' => 'sanitize_hex_color',
      'type' => 'option', 
      'capability' => 'edit_theme_options'
    )
  );
  // CONTROLS
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $color['slug'], 
      array('label' => $color['label'], 
      'section' => 'colors',
      'settings' => $color['slug'])
    )
  );
}

/**----------------------------------------------------------------
* 
* Typography Section
* 
-------------------------------------------------------------------*/

$wp_customize->add_section( 'font' , array(
    'title'      => __('Typography', 'portfilo'),
    'priority'   => 4,
));

// Heading Fonts
$wp_customize->add_setting( 'font_heading', array(
		'default'           => 'Open Sans',
		'sanitize_callback' => 'portfilo_sanitize_font_scheme',
	) );

	$wp_customize->add_control( 'font_heading', array(
		'label'    => __( 'Heading Font', 'portfilo' ),
		'section'  => 'font',
		'type'     => 'select',
		'choices'  => portfilo_get_font_scheme_choices(),
	) );  


// Content Fonts
$wp_customize->add_setting( 'font_content', array(
		'default'           => 'Open Sans',
		'sanitize_callback' => 'portfilo_sanitize_font_scheme',
	) );

	$wp_customize->add_control( 'font_content', array(
		'label'    => __( 'Content Font', 'portfilo' ),
		'section'  => 'font',
		'type'     => 'select',
		'choices'  => portfilo_get_font_scheme_choices(),
	) );

/**----------------------------------------------------------------
* 
* Logo and Favicon Section
* 
-------------------------------------------------------------------*/
	$wp_customize->add_section( 'logo_section' , array(
    'title'       => __( 'Upload Logo', 'portfilo' ),
    'description' => __( 'Upload Logo to be displayed in your theme', 'portfilo' ),
    'priority' => 2
) );


// Logo
	$wp_customize->add_setting( 'portfilo_logo',
	    array ( 'default' => '',
	    'sanitize_callback' => 'esc_url_raw'
	 ));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'portfilo_logo', array(
    'label'    => __( 'Logo', 'portfilo' ),
    'section'  => 'logo_section',
    'settings' => 'portfilo_logo',
) ) );   

// Favicon
if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) ) {
    $wp_customize->add_setting( 'portfilo_favicon',
        array ( 'default' => '',
	    'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'portfilo_favicon', array(
    'label'    => __( 'Favicon', 'portfilo' ),
    'description' => __( 'Upload favicon from here if You are using WordPress below version 4.3', 'portfilo' ),
    'section'  => 'logo_section',
    'settings' => 'portfilo_favicon',
) ) );
}
/**--------------------------------------------------------------------
* 
* General
* 
-----------------------------------------------------------------------*/

$wp_customize->add_section( 'general_section' , array(
    'title'       => __( 'General', 'portfilo' ),
    'description' => __( 'Set general settings from here.', 'portfilo' ),
    'priority' => 5
) );

$wp_customize->add_setting( 'hide_comments',
     array(
        'default' => '',
        'sanitize_callback' => 'portfilo_sanitize_checkbox_field',
     ));
     
$wp_customize->add_control( 'hide_comments', array(
    'type' => 'checkbox',
    'label' => __( 'Hide Comments', 'portfilo' ),
    'section' => 'general_section',
    'description' => __( 'Check this to hide WordPress commenting system', 'portfilo' ),
));

$wp_customize->add_setting( 'hide_author_bio',
     array(
        'default' => '',
        'sanitize_callback' => 'portfilo_sanitize_checkbox_field',
     ));
     
$wp_customize->add_control( 'hide_author_bio', array(
    'type' => 'checkbox',
    'label' => __( 'Hide Author Bio', 'portfilo' ),
    'section' => 'general_section',
    'description' => __( 'Check this to hide author biography under post content', 'portfilo' ),
));

$wp_customize->add_setting( 'hide_breadcrumbs_from_bar',
     array(
        'default' => '',
        'sanitize_callback' => 'portfilo_sanitize_checkbox_field',
     ));
     
$wp_customize->add_control( 'hide_breadcrumbs_from_bar', array(
    'type' => 'checkbox',
    'label' => __( 'Hide Breadcrumbs', 'portfilo' ),
    'section' => 'general_section',
    'description' => __( 'Check this to hide breadcrumbs', 'portfilo' ),
));


/**----------------------------------------------------------------------------
*
* Social icons
*
------------------------------------------------------------------------------*/

$wp_customize -> add_section( 'social_icon_link', array(
	'title' => __( 'Social Icons','portfilo' ),
	'description' => __('Type your social links here','portfilo'),
	'priority' => 9
));

$wp_customize->add_setting( 'social_checkbox',
     array(
        'default' => '',
        'sanitize_callback' => 'portfilo_sanitize_checkbox_field',
));

$wp_customize->add_control( 'social_checkbox', array(
    'type' => 'checkbox',
    'label' => __( 'Show Social Icons','portfilo' ),
    'section' => 'social_icon_link',
    'description' => __( 'Check this to show your social icons','portfilo' ),
));
 
$wp_customize->add_setting( 'twitter_url', array( 
 'sanitize_callback' => 'esc_url',
 'capability' => 'edit_theme_options'
 ) );
 $wp_customize->add_control( 'twitter_url', array(
 'label' => __( 'Twitter Profile','portfilo' ),
 'section' => 'social_icon_link',
 'type' => 'text'
 ) );
 
$wp_customize->add_setting( 'facebook_url', array( 
 'sanitize_callback' => 'esc_url',
 'capability' => 'edit_theme_options'
 ) );
 $wp_customize->add_control( 'facebook_url', array(
 'label' => __( 'Facebook Profile','portfilo' ),
 'section' => 'social_icon_link',
 'type' => 'text'
 ) );
 
$wp_customize->add_setting( 'googleplus_url', array(
 'sanitize_callback' => 'esc_url',
 'capability' => 'edit_theme_options'
 ) );
 $wp_customize->add_control( 'googleplus_url', array(
 'label' => __( 'Google+ Profile','portfilo' ),
 'section' => 'social_icon_link',
 'type' => 'text'
 ) );
 
$wp_customize->add_setting( 'linkedin_url', array( 
 'sanitize_callback' => 'esc_url',
 'capability' => 'edit_theme_options'
 ) );
 $wp_customize->add_control( 'linkedin_url', array(
 'label' => __( 'LinkedIn Profile','portfilo' ),
 'section' => 'social_icon_link',
 'type' => 'text'
 ) );
 
$wp_customize->add_setting( 'pinterest_url', array(
 'sanitize_callback' => 'esc_url',
 'capability' => 'edit_theme_options'
 ) );
 $wp_customize->add_control( 'pinterest_url', array(
 'label' => __( 'Pinterest Profile','portfilo' ),
 'section' => 'social_icon_link',
 'type' => 'text'
 ) );
 
$wp_customize->add_setting( 'blogger_url', array( 
 'sanitize_callback' => 'esc_url',
 'capability' => 'edit_theme_options'
 ) );
 $wp_customize->add_control( 'blogger_url', array(
 'label' => __( 'Blogger Profile','portfilo' ),
 'section' => 'social_icon_link',
 'type' => 'text'
 ) );
 
$wp_customize->add_setting( 'youtube_url', array(
 'sanitize_callback' => 'esc_url',
 'capability' => 'edit_theme_options'
 ) );
 $wp_customize->add_control( 'youtube_url', array(
 'label' => __( 'Youtube Profile','portfilo' ),
 'section' => 'social_icon_link',
 'type' => 'text'
 ) );
 
$wp_customize->add_setting( 'flikr_url', array(
 'sanitize_callback' => 'esc_url',
 'capability' => 'edit_theme_options'
 ) );
 $wp_customize->add_control( 'flikr_url', array(
 'label' => __( 'Flickr Profile','portfilo' ),
 'section' => 'social_icon_link',
 'type' => 'text'
 ) );
 
$wp_customize->add_setting( 'vimeo_url', array(
 'sanitize_callback' => 'esc_url',
 'capability' => 'edit_theme_options'
 ) );
 $wp_customize->add_control( 'vimeo_url', array(
 'label' => __( 'Vimeo Profile','portfilo' ),
 'section' => 'social_icon_link',
 'type' => 'text'
 ) );


}
add_action( 'customize_register', 'portfilo_customize_register' );


/*
Enqueue Script for top buttons
*/
if ( ! function_exists( 'portfilo_customizer_controls' ) ){
	function portfilo_customizer_controls(){

	wp_enqueue_script( 'portfilo_customizer_top_buttons', PORTFILO_THEME_URI .'/js/theme-customizer-top-buttons.js', false, PORTFILO_THEME_VERSION, true  );

		wp_localize_script( 'portfilo_customizer_top_buttons', 'topbtns', array(
			'pro' => esc_html__( 'Buy our PRO version', 'portfilo' ),
            'documentation' => esc_html__( 'Documentation', 'portfilo' )
		) );
	}
}//end if function_exists
add_action( 'customize_controls_enqueue_scripts', 'portfilo_customizer_controls' );


function portfilo_enqueue_customizer_scripts() {

	/* Use the .min script if SCRIPT_DEBUG is turned off. */
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'portfilo-customize',
		trailingslashit( get_template_directory_uri() ) . "js/customize{$suffix}.js",
		array( 'jquery' ),
		null,
		true
	);
}


/**
 * Register font schemes for Portfolio theme.
 *
 *
 * @since Portfolio 1.0
 *
 * @return array An associative array of font scheme options.
 */
function portfilo_get_font_schemes () {
	return array(
	        'Times New Roman' => 'Times New Roman',
            'Arial'     => 'Arial',
            'Courier New'   => 'Courier New',
			'Open Sans' => 'Open Sans',
			'Slabo'		=> 'Slabo',
			'Roboto'	=> 'Roboto',
			'Oswald'	=> 'Oswald',
			'Lato'		=> 'Lato',
			'Source Sans Pro' => 'Source Sans Pro',
			'PT Sans'	=> 'PT Sans',
			'Open Sans Condensed' => 'Open Sans Condensed',
			'Droid Sans' => 'Droid Sans',
			'Montserrat' => 'Montserrat',
			'Merriweather' => 'Merriweather',
			'Lora'		=> 'Lora',
			'Arimo'		=> 'Arimo',
			'Bitter'	=> 'Bitter',
			'Lobster'	=> 'Lobster',
			'Indie Flower' => 'Indie Flower',
			'Oxygen'	=> 'Oxygen'
	);
	
} 


if ( ! function_exists( 'portfilo_get_font_scheme_choices' ) ) :
/**
 * Returns an array of font scheme choices registered for Portfolio.
 *
 * @since Portfolio 1.0
 *
 * @return array Array of font schemes.
 */
 function portfilo_get_font_scheme_choices() {
	$font_schemes                = portfilo_get_font_schemes();
	$font_scheme_control_options = array();

	foreach ( $font_schemes as $font_scheme => $value ) {
		$font_scheme_control_options[ $font_scheme ] = $value;
	}

	return $font_scheme_control_options;
}
endif; // portfilo_get_font_scheme_choices

if ( ! function_exists( 'portfilo_sanitize_font_scheme' ) ) :
/**
 * Sanitization callback for font schemes.
 *
 * @since Portfolio 1.0
 *
 * @param string $value font scheme name value.
 * @return string font scheme name.
 */
function portfilo_sanitize_font_scheme( $value ) {
	$font_schemes = portfilo_get_font_scheme_choices();

	if ( ! array_key_exists( $value, $font_schemes ) ) {
		$value = 'Open Sans';
	}

	return $value;
}
endif; // portfilo_sanitize_font_scheme


if ( ! function_exists( 'portfilo_sanitize_checkbox_field' ) ) :
/**
 * Sanitization callback for checkbox field.
 *
 * @param string $input of checkbox .
 * @return string if checkbox input is a 1 returns one and If the input is anything else at all, the function returns a blank string .
 */
function portfilo_sanitize_checkbox_field( $input ) {
	if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
endif; // portfilo_sanitize_checkbox_field

if ( ! function_exists( 'portfilo_sanitize_textarea' ) ) :
/**
 * Sanitization callback for textarea field.
 *
 * @param string $text of textarea .
 * @return string 
 */
function portfilo_sanitize_textarea( $text ) {
	$value = wp_kses_post( $text );
	//return html_entity_decode($value);
	return $value;
}
endif; // portfilo_sanitize_textarea 

//Add Customise css into header part
if ( ! function_exists( 'portfilo_customizer_css' ) ) :
function portfilo_customizer_css() {
	
   //require get_template_directory() . '/inc/customize-style.php';
   get_template_part( 'inc/customize', 'style' );
}
endif; // portfilo_customizer_css
add_action( 'wp_head', 'portfilo_customizer_css' );
?>