<?php
/**
 * The template for displaying blog content
 *
 * @package Portfilo
 * @author August Infotech
 */
 
global $wp_query; 

$portfilo_post_id = $wp_query->get_queried_object_id(); 
$portfilo_blog_detail_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'portfilo-blog-detail-thumbnail' ) );  
$portfilo_uid = get_current_user_id();

$portfilo_attr = array(
	'src'   => $portfilo_blog_detail_url,
	'class' => "img-responsive",
	'alt'   => get_the_title()
);

while ( have_posts() ) {
						                			
	the_post();
?>
 
		<figure class="news wow fadeInLeft" data-wow-delay="0.3s">
		    <div <?php post_class( 'news-img' ); ?>>
		    <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail('portfilo-blog-detail-thumbnail',$portfilo_attr);
				} 
		        else { ?>
					<img class="img-responsive" src="<?php echo PORTFILO_THEME_URI. '/images/no-img-portfolio.jpg'; ?>"  alt="<?php the_title(); ?>" />	
				<?php } ?> 
		    </div>
		    <figcaption class="news-info">
		        <h2><?php the_title(); ?></h2>
		        <div class="meta">
		           <span class="date">
		             <i class="glyphicon glyphicon-calendar"></i>
		             <?php echo get_the_date(); ?>
		           </span>
		           <?php if( has_category() == true ) { ?>
						  <span class="categories"><i class="fa fa-bookmark" title="<?php esc_attr_e( 'Categories' , 'portfilo' ); ?>"></i>&nbsp;<?php the_category(', '); ?></span>
						<?php } ?>
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
				   <?php 
						$portfilo_user_exists = (is_user_logged_in() && current_user_can( 'edit_posts') )? true:false;
						if( $portfilo_user_exists == 1 ) {
							echo '<div class="postmetabottom">'; ?>
								<span class="edit"><i class="fa fa-edit" title="<?php esc_attr_e( 'Edit' , 'portfilo' ); ?>"></i>&nbsp;<?php edit_post_link(__('Edit','portfilo')); ?></span>
						   <?php
						  echo '</div>';
						 }
				?>    
		        </div>
		        
		       
		        
		        <?php the_content(); ?>
		        
		        <?php
	                $portfilo_link_pages_exist = (wp_link_pages('echo=0') != '' )? true:false;
	                if( $portfilo_link_pages_exist ): ?>
	                  <span class="pagelist"><?php $portfilo_page_text = '<i class="fa fa-copy" title="' .esc_attr_e( 'Pages' , 'portfilo' ).'"></i>&nbsp;'; wp_link_pages('before='.$portfilo_page_text.':&after='); ?></span>
	           <?php endif; ?>
		        
		        <div class="postpagenav">
			      <ul>
					<?php if (is_attachment()) {
						   previous_image_link( '<li class="prev_page">'.__('&lsaquo;','portfilo').'&nbsp;&nbsp;%link </li>','%title',false);
						   next_image_link( '<li class="next_page">%link&nbsp;&nbsp;'.__('&rsaquo;','portfilo').' </li>','%title',false);
						   
	                    } else {
						    previous_post_link( '<li class="prev_page">'.__('&lsaquo;','portfilo').'&nbsp;&nbsp;%link </li>','Previous',false);
						   next_post_link( '<li class="next_page">%link&nbsp;&nbsp;'.__('&rsaquo;','portfilo').' </li>','Next',false);
						  
					} ?>
				  </ul>	
				</div>
		     </figcaption>
		     
		</figure>

		<div class="news-detail-divider"></div>

		<!-- news sharing section -->
		<div class="btn-group sharing-btns">
		    <button class="btn btn-default disabled"><?php _e( 'Share:' , 'portfilo' ); ?></button>    
		    
		    <a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( the_permalink( '' , '' , false ) ); ?>&amp;t=<?php echo strip_tags( $post->post_title ); ?>" target="_blank" class="btn btn-default facebook"> <i class="fa fa-facebook fa-lg fb"></i></a>
		  
		    <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode( the_permalink( '' , '' , false ) ); ?>&amp;text=<?php echo strip_tags( $post->post_title ); ?>&amp;tw_p=tweetbutton&amp;url=<?php echo urlencode( the_permalink( '' , '' , false ) ); ?>" target="_blank" class="btn btn-default twitter"><i class="fa fa-twitter fa-lg tw"></i></a>
		  
		    <a href="//pinterest.com/pin/create/button/?url=<?php echo urlencode( the_permalink( '' , '' , false ) ); ?>&amp;media=<?php echo $portfilo_blog_detail_url; ?>&amp;description=<?php echo strip_tags( $post->post_title ); ?>" target="_blank" class="btn btn-default pinterest"> <i class="fa fa-pinterest fa-lg pinterest"></i></a>
		  
		    <a href="https://plusone.google.com/_/+1/confirm?hl=<?php language_attributes(); ?>&amp;url=<?php echo urlencode( the_permalink( '' , '' , false ) ); ?>" target="_blank" class="btn btn-default google"> <i class="fa fa-google-plus fa-lg google"></i></a>
		 
		    <a href="https://plus.google.com/share?url=<?php echo urlencode( the_permalink( '' , '' , false ) ); ?>&amp;title=<?php echo strip_tags( $post->post_title ); ?>" class="btn btn-default linkedin"><i class="fa fa-linkedin"></i></a>
		    
		    
		    <a href="mailto:?subject=<?php echo strip_tags( $post->post_title ); ?>&amp;body=<?php echo urlencode( the_permalink( '' , '' , false ) ); ?>" class="btn btn-default mail"> <i class="fa fa-envelope"></i></a>
		 
		</div>
		<!-- news sharing section end --> 
		 
		<?php 

		if ( get_theme_mod( 'hide_author_bio' ) == '' ) { ?>
		<div class="author_bio">
			<h4><?php _e( 'Author Biography:', 'portfilo'); ?></h4>
			<div class="title-divider"></div>
			<p><?php the_author_meta( 'description' , $portfilo_uid ); ?></p>
		</div>
		<?php
		} 

		if( get_theme_mod( 'hide_comments' ) == '' ) {
			// If comments are open or we have at least one comment, load up the comment template.
		    if ( comments_open() || get_comments_number() ) {
		        comments_template();
		    }
		}
}
?>
