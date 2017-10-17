<?php
/**
 * Menu functions.
 * @package Portfilo
 * @author August Infotech
 * 
 */


/* ---------------------------------------------------------------------------
 * Main menu
 * --------------------------------------------------------------------------- */

if ( ! function_exists( 'portfilo_wp_nav_menu' ) ) : 
 
function portfilo_wp_nav_menu() {
	$args = array( 
	    'container' 	  => 'nav',
		'container_id'	  => 'menu',
		'menu_class'      => 'nav navbar-nav portfilo-menu',
		'fallback_cb'	  => 'portfilo_wp_page_menu', 
		'theme_location'  => 'primary',
        'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
		'depth' 		  => 0,
        
	);
   
	wp_nav_menu( $args ); 
}

endif; //portfilo_wp_nav_menu


if ( ! function_exists( 'portfilo_wp_page_menu' ) ) : 

function portfilo_wp_page_menu() {
	$args = array(
		'title_li' => '0',
		'sort_column' => 'menu_order',
		'depth' => 0
	);

	echo '<nav id="menu" class="nav navbar-nav navbar-right">'."\n";
		echo '<ul class="nav navbar-nav navbar-right">'."\n";
			wp_list_pages( $args ); 
		echo '</ul>'."\n";
	echo '</nav>'."\n";
}

endif; //portfilo_wp_page_menu


?>