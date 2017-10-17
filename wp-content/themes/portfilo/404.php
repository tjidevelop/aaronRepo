<?php
/**
 * The template for displaying 404 pages (Not Found)
 * Portfilo theme functions and definitions
 * @package Portfilo
 * @author August Infotech
*/

get_header(); ?>

<!-- breadcrum section start -->
 <?php if( get_theme_mod( 'hide_breadcrumbs_from_bar') == '' ) { ?>
    <section class="breadcrum-area">
        <div class="container">
            <h2 data-wow-delay="0.7s" class="wow fadeIn animated pull-right" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;"><?php _e( 'Page Not Found' , 'portfilo' ); ?></h2>
            <span data-wow-delay="1s" class="breadcrum pull-left wow fadeIn animated" style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;"><a href="<?php echo site_url(); ?>"><i class="glyphicon glyphicon-home"></i></a>&nbsp;&nbsp;/&nbsp;&nbsp;<span class="active"><?php _e( 'Page Not Found' , 'portfilo' ); ?></span></span>
        </div>
    </section>
    <?php } ?>
<!-- breadcrum section end -->

<!-- 404 section -->
<div class="mtop"></div>
  <div class="container">
    <section class="about-section page-not">
      <div class="title-area wow fadeIn">
        <div class="page-not-found text-center">
            <i class="fa fa-warning fa-2x"></i>
        	<span><?php _e( '404' , 'portfilo' ); ?></span>
        </div>
        <p class="section-sub-text"><?php _e( 'Sorry, It appears the page you were looking for does not exist anymore or might have been moved.' , 'portfilo' );?></p>
     	</div>      
    </section> 
  </div>
<!-- 404 section end -->

<?php get_footer(); ?>
