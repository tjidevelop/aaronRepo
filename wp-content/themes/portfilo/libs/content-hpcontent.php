<?php
/**
 * The Page containes the homepage content area
 *
   Portfilo theme functions and definitions
 * @package Portfilo
 * @author August Infotech
 */
?>

<div style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInRight;" class="popular wow fadeInRight animated animated" data-wow-delay="0.3s">
	
    <?php if ( is_active_sidebar( 'homepage-content' ) ) : ?>
      <?php dynamic_sidebar( 'homepage-content' ); ?>
    <?php endif; ?>  
</div>
                    

