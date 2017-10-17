<?php
/** 
 * The Template for displaying all single posts.
 * 
 * @package Portfilo
 * @author August Infotech
 */
 
get_header();
global $wp_query;
$portfilo_post_id = $wp_query->get_queried_object_id();


switch ( get_post_meta($portfilo_post_id, 'Layout', true) ) {
	
	case 'left_sidebar':
		$portfilo_class = 'left';
        break;
	case 'right_sidebar':
		$portfilo_class = 'right';
		break;
	case 'both_sidebar':
		$portfilo_class = 'both';
		break;
	default:
		$portfilo_class = 'full';
		break;
}
 
if($portfilo_class == 'left'){  
    $portfilo_right_class = 'col-xs-12 col-sm-8 col-md-8 pull-right';
    $portfilo_left_class = 'col-xs-12 col-sm-4 col-md-4 pull-left';
    $portfilo_class = 'left';
}    
elseif($portfilo_class == 'right'){   
    $portfilo_right_class = 'col-xs-12 col-sm-8 col-md-8';
    $portfilo_left_class = 'col-xs-12 col-sm-4 col-md-4';
    $portfilo_class = 'right';
}
elseif($portfilo_class == 'both'){    
    $portfilo_center_class = 'col-xs-12 col-sm-6 col-md-6';
    $portfilo_left_class = 'col-xs-12 col-sm-3 col-md-3';
    $portfilo_class = 'both';
    
} 
else{	
	$portfilo_right_class = 'col-xs-12 col-sm-12 col-md-12';
	$portfilo_class = 'full';
} 
?>
<div class="mtop"></div>
 <div class="container">
    <section class="news-section">
        <section class="row">
        	<?php if($portfilo_class) {
			
				if($portfilo_class == 'both') {
				
					echo '<article class="' .$portfilo_left_class. '">';
	                            echo'<aside>';
	                                    echo'<div class="sidebar">';
	                                            get_sidebar();
	                                    echo '</div>';
	                            echo '</aside>';
	                    echo'</article>';
	                    
	                echo'<article class="' .$portfilo_center_class.'">';
								echo '<div class="news-list">';
	                    				
	                    				get_template_part( 'libs/content', 'blog' );
	                    					
	                    		echo '</div>';
	                    					
						echo '</article>';
	                
				} 				
				else {
				
					echo'<article class="' .$portfilo_right_class.'">';
												
		                    	echo '<div class="news-list">';
		                    						
		                    				get_template_part( 'libs/content', 'blog' );
		                    					
		                    	echo '</div>';
		                    					
						echo '</article>';
				}
			
			}				
			
			if($portfilo_class){ 
			
					if($portfilo_class == 'full') {					
						echo '';
					}					
					else {						
						echo '<article class="' .$portfilo_left_class. '">';
	                              echo'<aside>';
	                                    echo'<div class="sidebar">';
	                                        get_template_part( 'sidebar', 'blog' );
	                                   echo '</div>';
	                              echo '</aside>';
	                    echo'</article>';
					}
	                    
        
               } 
        ?>
		</section>
    </section>
</div>
<?php  get_footer(); ?>