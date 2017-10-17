<?php
/**
 * The main template file
 
   Portfilo theme functions and definitions
 * @package Portfilo
 * @author August Infotech
 */

get_header(); 
?>
<div class="mtop"></div>
<div class="container">
    <section class="news-section">
        <section class="row">  
		<?php
			while ( have_posts() ) {				
				the_post();
				echo '<div class="news-list">';
					get_template_part( 'libs/content', get_post_type() );
				echo '</div>';						
			}
			echo '<article class="col-xs-12 col-sm-12 col-md-12 text-right">';
				    echo '<ul class="pagination wow fadeInUp" data-wow-delay="0.3s">';
				        if(function_exists( 'portfilo_pagination' )):
						  portfilo_pagination();
						else:
						 wp_link_pages();  
						endif; 
                    echo '</ul>';
			echo '</article>';

		?>
 		</section>
    </section>
</div>
<!-- news listing section -->
<?php get_footer(); ?>