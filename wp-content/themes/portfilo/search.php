<?php
/**
 * The search template file.
 *
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
	      if ( have_posts() ) :	
       			while ( have_posts() ) {
				the_post();               
                ?>   
			      <div class="news-list">
					  <figure class="news wow fadeInLeft" data-wow-delay="0.3s">
					    <figure class="col-xs-12 col-sm-12 col-md-12">
			              <figcaption class="news-info">
			                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			                <div class="meta">
			                   <span class="date">
			                     <i class="glyphicon glyphicon-calendar"></i>
			                     <?php echo get_the_date(); ?>
			                   </span>
			                   <span class="category">
			                    <i class="glyphicon glyphicon-tag"></i> 
			                	 <?php 
						        	 $portfilo_tags_list = get_the_tag_list('',', ',''); 
							         if ( $portfilo_tags_list ) {
										 echo $portfilo_tags_list;
								     }
									 else {
									     _e( 'No Tags Found' , 'portfilo' );
									 }
						        	 
						        	 ?>
							   </span> 
			                </div>
			                <?php the_excerpt(); ?>
			               
			                <a class="more-news" href="<?php the_permalink(); ?>"><?php _e( 'Find Out More' , 'portfilo' );?></a> 
			              </figcaption>
			            </figure>
			          </figure> 
			          <div class="divider"></div> 
				  </div>			
			<?php			
			}
			
			 // pagination
			echo '<article class="col-xs-12 col-sm-12 col-md-12 text-right">';
				    echo '<ul class="pagination wow fadeInUp" data-wow-delay="0.3s">';
						if(function_exists( 'portfilo_pagination' )):
							portfilo_pagination();
						else:
							?>
							<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'portfilo')) ?></div>
							<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'portfilo')) ?></div>
							<?php
						endif;
                    echo '</ul>';
			echo '</article>';
          else :
	         ?>
	         <section class="about-section page-not">
			      <div class="title-area wow fadeIn">
			        <div class="page-not-found text-center">
			            <i class="fa fa-warning fa-2x"></i>
			        	<span><?php _e( 'No Data Found ' , 'portfilo' ); ?></span>
			        </div>
			        <p class="section-sub-text"><?php _e( 'Sorry, It looks like nothing was found at this location.' , 'portfilo' );?></p>
			        
			     	</div>      
			    </section>
	         
         <?php endif; ?>   
 		</section>
    </section>
</div>
<!-- news listing section -->

<?php get_footer(); ?>