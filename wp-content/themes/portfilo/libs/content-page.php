<?php
/**
 * The template used for displaying page content in page.php and Page Templates
 *
 * @package Portfilo
 * @author August Infotech
 */

global $wp_query;


while ( have_posts() ) : the_post();

$portfilo_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'portfilo-aboutus-thumbnail' ) );

$portfilo_attr = array(
	'src'   => $portfilo_url,
	'class' => "marbottom img-responsive",
	'alt'   => get_the_title()
);

if( !empty( $portfilo_url ) ){
	$portfilo_img_class = 'col-xs-12 col-sm-12 col-md-12 wow fadeInLeft';
	$portfilo_content_class = 'col-xs-12 col-sm-12 col-md-12 wow fadeInRight';
	
}
else {
	$portfilo_img_class = '';
	$portfilo_content_class = 'col-xs-12 col-sm-12 col-md-12 wow fadeInRight';
}


	 if( !empty( $portfilo_url ) ){ ?>
			<article class="<?php echo $portfilo_img_class; ?>" data-wow-delay="0.5s">
				<?php the_post_thumbnail('portfilo-aboutus-thumbnail',$portfilo_attr); ?>
			</article>
	<?php } ?>

	<article class="<?php echo $portfilo_content_class; ?>" data-wow-delay="1s">                  
		<div class="overview">
	        <h3><?php the_title();  ?></h3>
	        <div class="title-divider"></div>
	        <?php the_content(); ?>
	    </div>
	    <?php
	    	 if( get_theme_mod( 'hide_comments' ) == '' ) {
				// If comments are open or we have at least one comment, load up the comment template.
			    if ( comments_open() || get_comments_number() ) {
			        comments_template();
			    }
			}
		?>
	</article>

<?php 
endwhile;

wp_reset_postdata();

	
	

?>                					