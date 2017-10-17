<?php
/**
 * Header functions.
 * @package Portfilo
 * @author August Infotech
 * 
 */

/* ---------------------------------------------------------------------------
 * Favicon
* --------------------------------------------------------------------------- */
if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) ) {
	if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {

		if ( ! function_exists( 'portfilo_portfolio_favicon' ) ) :

		function portfilo_portfolio_favicon()
		{
		  $portfilo_favicon = (get_theme_mod( 'portfilo_favicon' ) != '') ? get_theme_mod( 'portfilo_favicon' ) : '';

		    if( !empty( $portfilo_favicon ) ){
				
				echo '<!-- favicon section -->'."\n";
				
				echo '<link rel="shortcut icon" type="image/x-icon" href="'.esc_url( $portfilo_favicon ).'" />'."\n";
		    
		        echo '<!-- favicon section end -->'."\n";
			}    
		}
		endif; //portfilo_portfolio_favicon
		add_action('wp_head', 'portfilo_portfolio_favicon');
	}
}
/* ---------------------------------------------------------------------------
 * IE fix
 * --------------------------------------------------------------------------- */

if ( ! function_exists( 'portfilo_portfolio_ie_fix' ) ) :
 
function portfilo_portfolio_ie_fix() {
	
	if( ! is_admin() ){
		
		echo "\n".'<!--[if lt IE 9]>'."\n";
		echo '<script src="'.PORTFILO_THEME_URI .'/js/html5shiv.min.js'.'"></script>'."\n";
		echo '<script src="'.PORTFILO_THEME_URI .'/js/respond.min.js'.'"></script>'."\n";
		echo '<![endif]-->'."\n";
		
	}	
	
}
endif; //portfilo_portfolio_ie_fix
add_action('wp_head', 'portfilo_portfolio_ie_fix');

/* ---------------------------------------------------------------------------
 * Scripts
 * --------------------------------------------------------------------------- */
 
if ( ! function_exists( 'portfilo_portfolio_scripts' ) ) :
 
function portfilo_portfolio_scripts() {
	
	/* css section  */
    
    wp_enqueue_style('bootstrap', PORTFILO_THEME_URI.'/css/bootstrap.css', array(), PORTFILO_THEME_VERSION,'all');
    	        
    wp_enqueue_style('font-awesome', PORTFILO_THEME_URI.'/css/font-awesome.css', array(), PORTFILO_THEME_VERSION,'all');
		        
	wp_enqueue_style('animate', PORTFILO_THEME_URI.'/css/animate.css', array(), PORTFILO_THEME_VERSION,'all');
	
	wp_enqueue_style('smartmenus', PORTFILO_THEME_URI.'/css/jquery.smartmenus.bootstrap.css', array('bootstrap'), PORTFILO_THEME_VERSION,'all');
	   
    // Load our custom main stylesheet.
    wp_enqueue_style('portfilo.custom', PORTFILO_THEME_URI.'/css/custom.css', array(), PORTFILO_THEME_VERSION,'all');
    
    // Load our wordpress default stylesheet.
	wp_enqueue_style( 'portfilo.portfolio.style', get_stylesheet_uri() );
	
	wp_enqueue_style('portfilo.main.font.css','//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic');

    /* css section end  */ 
	
	if( ! is_admin() ) {
	    /* included javascript section */
		
		wp_enqueue_script('jquery');

		wp_enqueue_script( 'bootstrap', PORTFILO_THEME_URI .'/js/bootstrap.js', false, PORTFILO_THEME_VERSION, true );
		
		wp_enqueue_script( 'smartmenus', PORTFILO_THEME_URI .'/js/jquery.smartmenus.js', false, PORTFILO_THEME_VERSION, true  );
		
		wp_enqueue_script( 'smartmenus.bootstrap', PORTFILO_THEME_URI .'/js/jquery.smartmenus.bootstrap.js', false, PORTFILO_THEME_VERSION, true  );
		
		wp_enqueue_script( 'flexslider', PORTFILO_THEME_URI. '/js/jquery.flexslider.js', true, PORTFILO_THEME_VERSION, true );
		
		wp_enqueue_script( 'bxslider', PORTFILO_THEME_URI. '/js/jquery.bxslider.js', false, PORTFILO_THEME_VERSION, true );
				
        wp_enqueue_script( 'counterup', PORTFILO_THEME_URI. '/js/jquery.counterup.js', false, PORTFILO_THEME_VERSION, true );
        
        wp_enqueue_script( 'waypoints', PORTFILO_THEME_URI. '/js/waypoints.js', false, PORTFILO_THEME_VERSION, true );
        
		wp_enqueue_script( 'wow-min', PORTFILO_THEME_URI. '/js/wow.js', false, PORTFILO_THEME_VERSION, true );
		
		wp_enqueue_script( 'portfilo-ai-menu', PORTFILO_THEME_URI. '/js/ai-menu.js', false, PORTFILO_THEME_VERSION, true );
		
		//wp_enqueue_script('portfilo-google-maps-api', PORTFILO_THEME_URI. '/js/google-map-api.js', true, PORTFILO_THEME_VERSION, false );
		
		wp_enqueue_script( 'portfilo-main', PORTFILO_THEME_URI. '/js/main.js', false, PORTFILO_THEME_VERSION, true );
		
		if ( is_singular() && get_option( 'thread_comments' ) ) 
		{ 
			wp_enqueue_script( 'comment-reply' ); 
		}
				
	}
    /* included javascript section end */
}
endif; //portfilo_portfolio_scripts
add_action('wp_enqueue_scripts', 'portfilo_portfolio_scripts');


/* ---------------------------------------------------------------------------
 * Portfolio logo
* --------------------------------------------------------------------------- */

if ( ! function_exists( 'portfilo_portfolio_logo' ) ) :

function portfilo_portfolio_logo() {
	
	if( get_bloginfo( 'name' ) ) {
		$portfilo_title = get_bloginfo( 'name' );
	}
	else {
		$portfilo_title = __('Theme Review', 'portfilo');
	}

	if( get_bloginfo( 'description' ) ) {
		$portfilo_desc = get_bloginfo( 'description' );
	}
	else {
		$portfilo_desc = __('Set your tagline from customizer', 'portfilo');
	}
	
	
    
    if ( get_theme_mod( 'portfilo_logo' ) ) {
		echo '<a href="'.PORTFILO_SITE_URL.'" class="navbar-brand">';
        echo '<img src="'.esc_url( get_theme_mod( 'portfilo_logo' ) ).'" alt="'.$portfilo_title.'" title="'.$portfilo_title.'"/>';
       echo '</a>';
        if ( display_header_text() ) {
			echo '<small>'.esc_attr( $portfilo_desc ) .'</small>';
		}
		else {
			echo '<small>';
			_e ('Check Display Site Title & Tagline checkbox.','portfilo');
			echo '</small></a>';
		}
	}
	

	else {
		if ( display_header_text() ) {
			echo '<a href="'.PORTFILO_SITE_URL.'" class="navbar-brand">';
			echo '<h3>' .esc_attr( $portfilo_title ) . '</h3>';
			echo '</a>';
	        echo '<small>'.esc_attr( $portfilo_desc ) .'</small>';
		}
		else {
			echo '<a href="'.PORTFILO_SITE_URL.'" class="navbar-brand">';
			echo '<small>';
			_e ('Check Display Site Title & Tagline checkbox.','portfilo');
			echo '</small></a>';
			
		}
		
	}
   

}
endif; //portfilo_portfolio_logo


?>