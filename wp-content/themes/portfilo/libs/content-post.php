<?php
/**
 * The template for displaying blog posts.
 *
 * @package Portfilo
 * @author August Infotech
 */ 

global $wp_query;
$portfilo_post_id = $wp_query->get_queried_object_id();
$portfilo_blog_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'portfilo-blog-listing-thumbnail' ) ); 

$portfilo_attr = array(
	'src'   => $portfilo_blog_url,
	'class' => "img-responsive",
	'alt'   => get_the_title()
);
?>
 
 <figure class="news wow fadeInLeft" data-wow-delay="0.3s">
        <div class="col-xs-12 col-sm-5 col-md-5">
            <div class="news-img">
                <a href="<?php the_permalink(); ?>">
                	<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail('portfilo-blog-listing-thumbnail',$portfilo_attr);
						} 
                    	else { ?>
						<img class="img-responsive" src="<?php echo PORTFILO_THEME_URI. '/images/no-img-portfolio.jpg'; ?>" alt="<?php the_title(); ?>" /> 
					<?php } ?>
                </a>
            </div>
        </div>
                       
        <figure class="col-xs-12 col-sm-7 col-md-7">
            <figcaption class="news-info">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="meta">
                   <span class="date">
                     <i class="glyphicon glyphicon-calendar"></i>
                     <?php echo get_the_date(); ?>
                   </span>
                   <span class="category">
                    <?php if( has_category() == true ) { ?>
						  <span class="categories"><i class="fa fa-bookmark" title="<?php esc_attr_e( 'Categories' , 'portfilo' ); ?>"></i>&nbsp;<?php the_category(', '); ?></span>
						<?php } ?>
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
               
                <a class="more-news" href="<?php the_permalink(); ?>"><?php _e( 'Find Out More' , 'portfilo' )?></a> 
            </figcaption>
        </figure>
</figure>
<div class="divider"></div>