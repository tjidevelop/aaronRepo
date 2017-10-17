<?php
/**
 * The file containing the main homepage area
 *
   Portfilo theme functions and definitions
 * @package Portfilo
 * @author August Infotech
 */
 
 
?>

<!-- our services section-->
		<section class="our_service">
		    <div class="title-area wow fadeIn">
		        <?php get_template_part( 'libs/content', 'hptitle' ); ?>
		    </div>
		                
		    <article class="service-list">
		        <section class="row">
		        	<?php 
		              echo '<article class="col-xs-12-col-sm-12 col-md-12">';
		                        	get_template_part( 'libs/content', 'hpcontent' ); 
		                        	
		                        echo '</article>';
	                
		            ?>
		                      
		        </section>
		    </article>
		</section>
		<!-- our services section end -->
<?php 		
$post_id = $wp_query->get_queried_object_id();
$args=array(
  'page_id' => $post_id,
  'post_type' => 'page',
  'post_status' => 'publish',
  'posts_per_page' => 1,
  'ignore_sticky_posts' =>1
);

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); 
	the_content();
endforeach;

wp_reset_postdata();	
?>	