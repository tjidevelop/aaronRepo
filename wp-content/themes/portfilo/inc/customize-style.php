<?php
/*
	Customize Style
*/



$portfilo_style = array();
$portfilo_style['font_heading'] = esc_attr( get_theme_mod('font_heading', 'Open Sans') );
$portfilo_style['font_content'] = esc_attr( get_theme_mod('font_content', 'Open Sans') );
$portfilo_style['bodybg_color'] = esc_attr( get_option('bodybg_color') );
$portfilo_style['headerbg_color'] = esc_attr( get_option('headerbg_color') );
$portfilo_style['footerbg_color'] = esc_attr( get_option('footerbg_color') );
//$portfilo_style['menubg_color'] = esc_attr( get_option('menubg_color') );
$portfilo_style['menu_color'] = esc_attr( get_option('menu_color') );
$portfilo_style['hover_menu_color'] = esc_attr( get_option('hover_menu_color') );
$portfilo_style['breadcrumb_bg_color'] = esc_attr( get_option('breadcrumb_bg_color') );
$portfilo_style['link_color'] = esc_attr( get_option('link_color') );
$portfilo_style['link_hover_color'] = esc_attr( get_option('link_hover_color') );
$portfilo_style['link_bg_color'] = esc_attr( get_option('link_bg_color') );
$portfilo_style['title_font_color'] = esc_attr( get_option('title_font_color') );
$portfilo_style['content_font_color'] = esc_attr( get_option('content_font_color') );

?>
 <?php if( !empty( $portfilo_style['font_heading'] ) ): 
        wp_enqueue_style('portfilo_font_css','//fonts.googleapis.com/css?family='.$portfilo_style['font_heading']);
     endif ;
  ?>  
 
 <?php if( !empty( $portfilo_style['font_content'] ) ):
        wp_enqueue_style('portfilo_font_content_css','//fonts.googleapis.com/css?family='.$portfilo_style['font_content']);
    endif ;
  ?>    

<style>

	<?php if( !empty( $portfilo_style['bodybg_color'] ) ): ?>
	body {
		background-color: <?php echo $portfilo_style['bodybg_color']; ?>
	}
	<?php endif; ?>
	
	<?php if( !empty( $portfilo_style['headerbg_color'] ) ): ?>
	.navbar-inverse {
		background: <?php echo $portfilo_style['headerbg_color']; ?>
	}
	<?php endif; ?>
	
	<?php if( !empty( $portfilo_style['footerbg_color'] ) ): ?>
	footer {
		background-color: <?php echo $portfilo_style['footerbg_color']; ?>
	}
	<?php endif; ?>
	
	<?php if( !empty( $portfilo_style['menu_color'] ) ): ?>
	.custom-nav .navbar-nav > li > a, .custom-nav .navbar-nav > .current-menu-item > a {
		color: <?php echo $portfilo_style['menu_color']; ?>
	}
	<?php endif; ?>
	
	<?php if( !empty( $portfilo_style['hover_menu_color'] ) ): ?>
	.dropdown-menu > li > a:hover, .custom-nav .navbar-nav > li > a:hover,.custom-nav .navbar-nav > .current-menu-item > a, .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .custom-nav .navbar-nav > .current-menu-item > a, .custom-nav .navbar-nav > .current-menu-item > a:hover, .custom-nav .navbar-nav > .current-menu-item > a:focus, .custom-nav .dropdown-menu > .current-menu-item > a, .custom-nav .dropdown-menu > .current-menu-item > a:hover, .custom-nav .dropdown-menu > .current-menu-item > a:focus {
		color: <?php echo $portfilo_style['hover_menu_color']; ?>
	}
	<?php endif; ?>
	
	<?php if( !empty( $portfilo_style['breadcrumb_bg_color'] ) ): ?>
	.breadcrum-area {
		background: <?php echo $portfilo_style['breadcrumb_bg_color']; ?>
	}
	<?php endif; ?>
	
	<?php if( !empty( $portfilo_style['link_color'] ) ): ?>
	a, .service-container a, .company-info a, .more-news, .news-info h2 a, .footer-navigation .copyright a {
		color: <?php echo $portfilo_style['link_color']; ?>
	}
	<?php endif; ?>
	
	
	<?php if( !empty( $portfilo_style['link_hover_color'] ) ): ?>
	.contact-info .info a:hover, .news-info h2 a:hover, .project-container h4 a:hover, .circle:hover, .footer-navigation .social-follow .socials li a:hover, .footer-navigation .copyright a:hover, .footer-navigation .copyright a:active, .footer-navigation .copyright a:focus, .sitemap ul li a:hover, a:hover, .breadcrum-area .breadcrum a:hover, .breadcrum-area .breadcrum a:active, .pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus, .breadcrum-area .breadcrum span.active, .back-to-top:hover, .sidebar ul li a:hover, .slider-banner h2 strong {
		color: <?php echo $portfilo_style['link_hover_color']; ?>
	}
	<?php endif; ?>
    
    <?php if( !empty( $portfilo_style['link_bg_color'] ) ): ?>
    .plan-entry-hover a:hover, .back-to-top, .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus, .custom-nav .navbar-brand,.title-divider, .slider-banner .flex-control-paging li a.flex-active {
        background-color: <?php echo $portfilo_style['link_bg_color']; ?> !important;
    }
    <?php endif; ?>
    
    <?php if( !empty( $portfilo_style['font_heading'] ) ): ?>
    h1, h2, h3, h4, h5, h6 {
		font-family: <?php echo $portfilo_style['font_heading']; ?> , sans-serif
	}
	<?php endif; ?>
	 
	<?php if( !empty( $portfilo_style['font_content'] ) ): ?>
	 body {
		font-family: <?php echo $portfilo_style['font_content']; ?> , sans-serif
	}
	<?php endif; ?>
	
	<?php if( !empty( $portfilo_style['title_font_color'] ) ): ?>
	.contact-info .info-title, .section-title,  h1, h2, h3, h4, h5, h6 {
		color: <?php echo $portfilo_style['title_font_color']; ?> !important;
	   }
	 <?php endif; ?>
	 
	 <?php if( !empty( $portfilo_style['content_font_color'] ) ): ?>	
	 .date, .copyright,.news-info .meta span, .service-container span, p {
		color: <?php echo $portfilo_style['content_font_color']; ?>	!important;
	 }	
	 <?php endif; ?>
	
</style>
	