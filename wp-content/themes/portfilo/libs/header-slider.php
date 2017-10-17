<?php

$SliderArgs = array(
    'post_type' => 'post',
    'no_found_rows' => true,
    'meta_key' => '_portfilo_home_slider',
    'meta_value' => 'checked',
    'post_status' => 'publish',
    'ignore_sticky_posts' => true,
    'order' => 'ASC',
    'orderby' => 'date'
);
$portfilo_result = new WP_Query($SliderArgs);?>


<div class="slider-banner">
 <?php if ($portfilo_result->have_posts()){ ?>
    <ul class="slides">
   
	<?php while ($portfilo_result->have_posts()) {
            $portfilo_result->the_post();
            $portfilo_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'portfilo-slider-thumbnail');
            $portfilo_post_image_url = $portfilo_post_image[0];
            $portfilo_full_title = get_the_title();
            $portfilo_sub_title = explode(' ',$portfilo_full_title); 
            $portfilo_last_word = array_pop($portfilo_sub_title);
            $portfilo_title = implode(" ", $portfilo_sub_title);
            $portfilo_content = portfilo_excerpt(get_the_ID(), 15, '');
            $portfilo_post_url = get_the_permalink();
            if (!empty($portfilo_post_image_url)) {
                ?>
                <li style="background-image: url('<?php echo $portfilo_post_image_url ?>');" class="slide">
            <?php } else { ?>
                <li style="background-image: url('<?php echo PORTFILO_THEME_URI . '/images/no-img-portfolio.jpg' ?>');"
                class="slide">
            <?php } ?>

            <div class="slider-overlay"></div>
            <div class="info" style="margin-top: 0px; opacity: 1;">
                <?php if (!empty($portfilo_full_title)) { ?>
                    <h2><?php echo $portfilo_title; ?><strong><?php echo ' '.$portfilo_last_word; ?></strong></h2>
                <?php } ?>
                <?php if (!empty($portfilo_content)) { ?>
                    <p><?php echo $portfilo_content; ?></p>
                <?php } ?>
                <?php if (!empty($portfilo_post_url)) { ?>
                    <a class="btn-white" href="<?php echo $portfilo_post_url; ?>"><?php _e('Read More', 'portfilo'); ?></a>
                <?php } ?>
            </div>
            </li>
        <?php
        }
       	 wp_reset_postdata();
       ?>
    </ul>
    <?php }
       else if( get_header_image() != '' ) { 
	   		 ?>
	   		<div class="info text-center" style="margin-top: 0px; opacity: 1; height:100%; background-image: url('<?php header_image(); ?>'); width:'<?php echo get_custom_header()->width; ?>'">
			</div>
		<?php  }
		else { ?>
		<div class="info text-center" style="margin-top: 0px; opacity: 1;">
			<h2><?php _e ('Want to enable slider ? ','portfilo');?><br/><?php _e ('Go To ','portfilo');?><strong><?php _e ('Posts', 'portfilo'); ?></strong><?php _e (' and enable ','portfilo');?><strong><?php _e ('Set as Homepage Slider ', 'portfilo'); ?></strong><?php _e ('checkbox.','portfilo'); ?></h2>
		</div>
		
		<?php }	?>
	   	
	   
    <ul class="flex-direction-nav">
        <li><a href="#" class="flex-prev"><?php _e('Previous', 'portfilo'); ?></a></li>
        <li><a href="#" class="flex-next"><?php _e('Next', 'portfilo'); ?></a></li>
    </ul>
</div>