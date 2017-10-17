<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Portfilo
 * @author August Infotech
 */
 
get_header(); 
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'portfilo' ), 'after' => '</div>' ) ); ?>
					<?php posts_nav_link(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->
			
         <?php 
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	endwhile; // end of the loop. ?>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php  get_footer(); ?>