<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * Portfilo theme functions and definitions
 * @package Portfilo
 * @author August Infotech
 */
 
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
 
    
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    
     <!-- stylesheet -->
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php 

	get_template_part( 'libs/header', 'top-area' );
    
    $portfilo_slider = false;
    if( get_post_type()=='page' && is_front_page() ) {
    	get_template_part( 'libs/header', 'slider' ) ;
    	$portfilo_slider = true;
    }	
    if( get_theme_mod( 'hide_breadcrumbs_from_bar') == '' ) {
        if( ! is_404() && $portfilo_slider != 1 ) {  
            if( trim( wp_title( '', false ) ) ) {
          	// Page title
          	    echo '<section class="breadcrum-area">';
                    echo '<div class="container">';                    
                           if( get_post_type()=='page' || is_single() ) {
                           	
						    echo '<h2 data-wow-delay="0.7s" class="wow fadeIn animated pull-right" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">'. $post->post_title .'</h2>';
				       } 
				       else if( is_home() ){
				       		
						   	 echo '<h2 data-wow-delay="0.7s" class="wow fadeIn animated pull-right" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">'. __('Your Latest Post','portfilo') .'</h2>';
						   }
                           else if( is_tax() ) {
                           
                                 $portfilo_queried_object = get_queried_object(); 
                                 $portfilo_term_id = $portfilo_queried_object->term_id; 
                                 $portfilo_term_obj = get_term( $portfilo_term_id, "portfolio_types"); 
                                 if( ! is_wp_error( $portfilo_term_obj ) ) {
									 echo '<h2 data-wow-delay="0.7s" class="wow fadeIn animated pull-right" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">'. $portfilo_term_obj->name .'</h2>';
								}
                                
                           }
                           
                           else if( get_post_type()=='post' ) {
							   	$portfilo_pagename = get_query_var('pagename');
							   	$post = $wp_query->get_queried_object();
								if( !empty( $post ))
								{
									echo '<h2 data-wow-delay="0.7s" class="wow fadeIn animated pull-right" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">'. $portfilo_pagename .'</h2>';
								    
								}     

						   }
                           else {
                           
						    echo '<h2 data-wow-delay="0.7s" class="wow fadeIn animated pull-right" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">'. trim( wp_title( '', false ) ) .'</h2>';
				       	   }
                         
                              	 portfilo_breadcrumbs();
                              
                    echo '</div>';
               echo '</section>';
            }
        }  
    }//end of if    
?>
