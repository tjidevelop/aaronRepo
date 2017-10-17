<?php
/**
 * The template for displaying the footer.
 *
 * @package Portfilo
 * @author August Infotech
 */
?>
<!-- footer section -->
<footer>
        <section class="footer-navigation">
            <div class="container">
                <section class="row">
                    <article class="col-xs-12 col-sm-4 col-md-4">
                        <!-- footer social section -->
                        <?php if ( get_theme_mod( 'social_checkbox' )  != '' ) { ?>
	                        <div class="social-follow wow fadeInUp">
	                            <h5><?php _e('Follow Us On','portfilo'); ?></h5>
	                            <ul class="socials">
	                            <?php 
			                        if( get_theme_mod( 'twitter_url' ) )
			                        	echo '<li><a class="ir" href="'.esc_url( get_theme_mod( 'twitter_url' ) ).'" target="_blank" title="'. __('Share on Twitter','portfilo') .'"><i class="fa fa-twitter"></i></a></li>'; 			                        	
			                       	if( get_theme_mod( 'facebook_url' ) )
			                       		echo '<li><a class="ir" href="'.esc_url( get_theme_mod( 'facebook_url' ) ).'" target="_blank" title="'. __('Share on Facebook','portfilo') .'"><i class="fa fa-facebook"></i></a></li>';			                       		
			                       	if( get_theme_mod( 'googleplus_url' ) )
			                       		echo '<li><a class="ir" href="'.esc_url( get_theme_mod( 'googleplus_url' ) ).'" target="_blank" title="'. __('Share on Google Plus','portfilo') .'"><i class="fa fa-google-plus"></i></a></li>';			                       		
			                       	if( get_theme_mod( 'linkedin_url' ) )
			                       		echo '<li><a class="ir" href="'.esc_url( get_theme_mod( 'linkedin_url' ) ).'" target="_blank" title="'. __('Share on LinkedIn','portfilo') .'"><i class="fa fa-linkedin"></i></a></li>';			                       	
			                       	if( get_theme_mod( 'pinterest_url' ) )
			                       		echo ' <li><a class="ir" href="'.esc_url( get_theme_mod( 'pinterest_url' ) ).'" target="_blank" title="'. __('Link to your Pinterest profile','portfilo') .'"><i class="fa fa-pinterest"></i></a></li>';
									if( get_theme_mod( 'blogger_url' ) )
			                       		echo '<li><a class="ir" href="'.esc_url( get_theme_mod( 'blogger_url' ) ).'" target="_blank" title="'. __('Share on RSS','portfilo'). '"><i class="fa fa-rss"></i></a></li>';			                       		
			                       	if( get_theme_mod( 'youtube_url' ) )
			                       		echo ' <li><a class="ir" href="'.esc_url( get_theme_mod( 'youtube_url' ) ).'" target="_blank" title="'. __('Share on YouTube','portfilo') .'"><i class="fa fa-youtube"></i></a></li>';		                       		
			                       	if( get_theme_mod( 'flikr_url' ) )
			                       		echo '<li><a class="ir" href="'.esc_url( get_theme_mod( 'flikr_url' ) ).'" target="_blank" title="'. __('Share on Flickr','portfilo') .'"><i class="fa fa-flickr"></i></a></li>';
			                       	if( get_theme_mod( 'vimeo_url' ) )
			                       		echo '<li><a class="ir" href="'.esc_url( get_theme_mod( 'vimeo_url' ) ).'" target="_blank" title="'. __('Share on Vimeo','portfilo') .'"><i class="fa fa-vimeo-square"></i></a></li>';		                        
	                        	?>   	                            
	                            </ul>
	                        </div>
                        <?php } ?>
                        <!-- footer social section end -->
                    </article>
                    
                    <?php if ( is_active_sidebar( 'sidebar-3' ) ){
						$portfilo_col = 'col-xs-12 col-sm-4 col-md-4';
					} else {
						$portfilo_col = 'col-xs-12 col-sm-8 col-md-8';
					} ?>
                    
                    <!--To display footer widget contents-->
				         <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
				        <div class="<?php echo $portfilo_col; ?>">
				       		<?php dynamic_sidebar( 'sidebar-3' ); ?>
				    	</div>
				        <?php endif; ?>
                   
                    
                    <article class="<?php echo $portfilo_col; ?>">
                        <!-- sitemap section -->
                        <div class="sitemap-block">
                        	<?php wp_nav_menu( array( 'theme_location' => 'secondary' , 'menu_class' => 'sitemap' ) ); ?> 
                        </div>
                    </article>
                     <!-- sitemap section end -->
                    
                </section>
            </div>
        </section>
    </footer>
    <!-- footer section end-->
    
    <!-- scroll to top section -->
    <a href="#" class="back-to-top"><i class="glyphicon glyphicon-arrow-up"></i></a> 
    <!-- scroll to top section end -->
	<!-- main body section end -->
	
<!-- wp_footer() -->
<!-- included javascript section -->	
<?php wp_footer(); ?>	
</body>
</html>