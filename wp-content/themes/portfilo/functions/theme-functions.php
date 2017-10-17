<?php
/**
 * Theme functions.
 *
 * Portfilo theme functions and definitions
 * @package Portfilo
 * @author  August Infotech
 */


/* ---------------------------------------------------------------------------
 * Theme support
 * --------------------------------------------------------------------------- */

if (!function_exists('portfilo_portfolio_theme_setup')) :


    function portfilo_portfolio_theme_setup()
    {

        add_theme_support('title-tag');
        add_theme_support('custom-background');
        $args = array(
            'flex-width' => true,
            'width' => 1400,
            'flex-height' => true,
            'height' => 600,
            'default-image' => get_template_directory_uri() . '/images/overlay.jpg',
        );
        add_theme_support('custom-header', $args);

        /* ---------------------------------------------------------------------------
         * Loads Theme Textdomain
         * --------------------------------------------------------------------------- */

        load_theme_textdomain('portfilo', PORTFILO_LANG_DIR);

        add_theme_support('automatic-feed-links');
        add_theme_support('woocommerce');
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(260, 146, false); // admin - featured image
        add_image_size('portfilo_50x50', 50, 50, false); // admin - lists

        add_image_size('portfilo-aboutus-thumbnail', 1140, 640, true);

        add_image_size('portfilo-blog-listing-thumbnail', 458, 244, true);
        add_image_size('portfilo-blog-detail-thumbnail', 750, 400, true);
        add_image_size('portfilo-slider-thumbnail', 1400, 786, true);

        /* ---------------------------------------------------------------------------
         * Registers a menu location to use with navigation menus.
         * --------------------------------------------------------------------------- */
        /*register_nav_menu('primary', __('Main menu', 'portfilo'));
        register_nav_menu('footer', __('Footer menu', 'portfilo'));*/
        
        register_nav_menus( array(  
		  'primary' => __( 'Primary Navigation', 'portfilo' ),  
		  'secondary' => __('Secondary Navigation', 'portfilo')  
		) );
        add_action('add_meta_boxes', 'portfilo_Slider');
        add_action('save_post', 'PortfiloSaveHomePageSlider');

    }
endif; // portfilo_portfolio_theme_setup

add_action('after_setup_theme', 'portfilo_portfolio_theme_setup');


/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function portfilo_add_editor_styles() {

    add_editor_style( get_stylesheet_uri() );

}
add_action( 'init', 'portfilo_add_editor_styles' );

/***************** Pagination function *****************/

if (!function_exists('portfilo_pagenum_link')) :


    function portfilo_pagenum_link($link)
    {
        return preg_replace('~/page/(\d+)/?~', '?paged=\1', $link);
    }
endif; // portfilo_pagenum_link


/***************** Pagination function *****************/    

if ( ! function_exists( 'portfilo_pagination' ) ):  

function portfilo_pagination($pages = '', $range = 2) {
 	$showitems = ($range * 2)+1;  
	global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
        
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'><i class='fa fa-angle-double-left'></i></a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'><i class='fa fa-angle-left'></i></a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class='active'><a href='".get_pagenum_link($i)."' >".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'><i class='fa fa-angle-right'></i></a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'><i class='fa fa-angle-double-right'></i></a></li>";
        
     }

	
}
endif; //portfilo_pagination


/***************** Breadcrumbs function *****************/
if (!function_exists('portfilo_breadcrumbs')):

    function portfilo_breadcrumbs()
    {

        global $post, $wp_query;
        $homeLink = home_url();
        $showCurrent = 1;

        echo '<div data-wow-delay="1s" class="breadcrum pull-left wow fadeIn animated" style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;">';
        echo '<ul>';
        echo '<li><a href="' . $homeLink . '"><i class="glyphicon glyphicon-home"></i></a> <span class="breadcrum-sep">/</span></li>';

        // Blog Category
        if (is_category()) {
            echo '<li><span class="active">' . __('Archive by category', 'portfilo') . ' "' . single_cat_title('', false) . '"</span></li>';
        } elseif (is_search()) {
            echo '<li><span class="active">' . __('Search results for', 'portfilo') . ' "' . get_search_query() . '"</span></li>';

        } // Blog Day
        elseif (is_day()) {
            echo '<li><a href="' . get_year_link($wp_query->query_vars['year']) . '">' . $wp_query->query_vars['year'] . '</a> <span class="breadcrum-sep">/</span></li>';
            echo '<li><a href="' . get_month_link($wp_query->query_vars['year'], $wp_query->query_vars['monthnum']) . '">' . date_i18n("F", mktime(0, 0, 0, $wp_query->query_vars['monthnum'], 10)) . '</a> <span class="breadcrum-sep">/</span></li>';
            echo '<li><span class="active">' . $wp_query->query_vars['day'] . '</span></li>';
        } // Blog Month
        elseif (is_month()) {

            echo '<li><a href="' . get_year_link($wp_query->query_vars['year']) . '">' . $wp_query->query_vars['year'] . '</a> <span class="breadcrum-sep">/</span></li>';
            echo '<li><span class="active">' . date_i18n("F", mktime(0, 0, 0, $wp_query->query_vars['monthnum'], 10)) . '</span></li>';
        } // Blog Year
        elseif (is_year()) {

            echo '<li><span class="active">' . $wp_query->query_vars['year'] . '</span></li>';
        } elseif (get_post_type() == 'post') {
            $post_for_page_id = get_option('page_for_posts');
            echo '<li><a href="' . get_page_link($post_for_page_id) . '">' . get_the_title($post_for_page_id) . '</a></li>';

        } // Single Post
        elseif (is_single() && !is_attachment()) {

            // Custom post type
            if (get_post_type() != 'post') {

                global $wpdb;
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;

                if ($slug['slug'] == 'portfolio-item' && $portfolio_page_id = get_option('portfolio-page')) {
                    echo '<li><a href="' . get_page_link($portfolio_page_id) . '">' . get_the_title($portfolio_page_id) . '</a> <span class="breadcrum-sep">/</span></li>';
                } else {
                    echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> <span class="breadcrum-sep">/</span></li>';
                }
                if ($showCurrent == 1)
                    echo '<li><span class="active">' . get_the_title() . '</span></li>';
            } // Blog post
            else {
                $cat = get_the_category();
                $cat = $cat[0];

                echo '<li>';
                echo get_category_parents($cat, TRUE, ' <span class="breadcrum-sep">/</span>');
                echo '</li>';
                echo '<li><span class="active">' . wp_title('', false) . '</span></li>';
            }


        } // Taxonomy
        elseif (get_post_taxonomies()) {
            global $wpdb;
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;

            if ($post_type->name == 'portfolio' && $portfolio_page_id = get_option('portfolio-page')) {
                echo '<li><a href="' . get_page_link($portfolio_page_id) . '">' . get_the_title($portfolio_page_id) . '</a> <span class="breadcrum-sep">/</span></li>';
            } else {
                echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> <span class="breadcrum-sep">/</span></li>';
            }
            if (is_tax()) {
                $terms_object = get_queried_object();
                echo '<li><span class="active">' . $terms_object->name . '</span></li>';
            }
        } // Page with parent
        elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a> <span class="breadcrum-sep">/</span></li>';
                $parent_id = $page->post_parent;

            }

            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
            }

            if ($showCurrent == 1) echo '<li><span class="active">' . get_the_title() . '</span></li>';

        } // Default
        else {
            echo '<li><span class="active">' . get_the_title() . '</span></li>';
        }
        echo '</ul>';
        echo '</div>';
    }
endif; //portfilo_breadcrumbs


if (!function_exists('portfilo_taxonomy_slug_rewrite')) :
    /*
     * Replace Taxonomy slug with Post Type slug in url
     * Version: 1.1
     */

    function portfilo_taxonomy_slug_rewrite($wp_rewrite)
    {

        $rules = array();
        // get all custom taxonomies
        $taxonomies = get_taxonomies(array('_builtin' => false), 'objects');
        // get all custom post types
        $post_types = get_post_types(array('public' => true, '_builtin' => false), 'objects');


        foreach ($post_types as $post_type) {
            foreach ($taxonomies as $taxonomy) {

                // go through all post types which this taxonomy is assigned to
                foreach ($taxonomy->object_type as $object_type) {

                    // check if taxonomy is registered for this custom type
                    if ($object_type == $post_type->rewrite['slug']) {

                        // get category objects
                        $terms = get_categories(array('type' => $object_type, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0));

                        // make rules
                        foreach ($terms as $term) {
                            $rules[$object_type . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
                        }
                    }
                }
            }
        }
        // merge with global rules
        $wp_rewrite->rules = $rules + $wp_rewrite->rules;

    }
endif; // portfilo_taxonomy_slug_rewrite

/* ---------------------------------------------------------------------------
*	TGM Plugin Activation
* --------------------------------------------------------------------------- */

if (!function_exists('portfilo_register_required_plugins')) :


    add_action('tgmpa_register', 'portfilo_register_required_plugins');

    function portfilo_register_required_plugins()
    {

        $plugins = array(
            array(
                'name' => __('Responsive Contact Form','portfilo'), // The plugin name
                'slug' => __('responsive-contact-form','portfilo'), // The plugin slug (typically the folder name)
                'required' => false, // If false, the plugin is only 'recommended' instead of required
            ),
            array(
                'name' => __('Bootstrap Multi-language Responsive Portfolio','portfilo'), // The plugin name
                'slug' => __('bootstrap-multi-language-responsive-portfolio','portfilo'), // The plugin slug (typically the folder name)
                'required' => false, // If false, the plugin is only 'recommended' instead of required
            ),
            array(
                'name' => __('Bootstrap Multi-language Responsive Gallery','portfilo'), // The plugin name
                'slug' => __('bootstrap-multi-language-responsive-gallery','portfilo'), // The plugin slug (typically the folder name)
                'required' => false, // If false, the plugin is only 'recommended' instead of required
            ),
            array(
                'name' => __('Bootstrap Multi-language Responsive Testimonials','portfilo'), // The plugin name
                'slug' => __('bootstrap-multi-language-responsive-testimonials','portfilo'), // The plugin slug (typically the folder name)
                'required' => false, // If false, the plugin is only 'recommended' instead of required
            ),

        );


        $config = array(
            'id' => 'tgmpa-portfilo'          // Unique ID for hashing notices for multiple instances of TGMPA.
        );

        tgmpa($plugins, $config);

    }
endif; // portfilo_register_required_plugins


/* ---------------------------------------------------------------------------
 * Excerpt
* --------------------------------------------------------------------------- */

if (!function_exists('portfilo_excerpt')) :

    function portfilo_excerpt($post, $length = 180, $tags_to_keep = '<a><em><strong>', $extra = '...')
    {

        if (is_int($post)) {
            $post = get_post($post);
        } elseif (!is_object($post)) {
            return false;
        }

        if (has_excerpt($post->ID)) {
            $the_excerpt = $post->post_excerpt;
            return apply_filters('the_content', $the_excerpt);
        } else {
            $the_excerpt = $post->post_content;
        }

        $the_excerpt = strip_shortcodes(strip_tags($the_excerpt, $tags_to_keep));
        $the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2 + 1);
        $excerpt_waste = array_pop($the_excerpt);
        $the_excerpt = implode($the_excerpt);
        $the_excerpt .= $extra;

        return apply_filters('the_content', $the_excerpt);
    }
endif; //portfilo_excerpt

/* ---------------------------------------------------------------------------
 * Excerpt length
 * --------------------------------------------------------------------------- */

if (!function_exists('portfilo_excerpt_length')) :

    function portfilo_excerpt_length($length)
    {
        return 40;
    }
endif; //portfilo_excerpt_length
add_filter('excerpt_length', 'portfilo_excerpt_length', 999);


// custom excerpt ellipses for 2.9+
if (!function_exists('portfilo_custom_excerpt_more')) :

    function portfilo_custom_excerpt_more($more)
    {
        return '...';
    }
endif; //portfilo_custom_excerpt_more
add_filter('excerpt_more', 'portfilo_custom_excerpt_more');


/* ---------------------------------------------------------------------------
 * Add checkbox for slider
 * --------------------------------------------------------------------------- */

    function portfilo_Slider()
    {

        add_meta_box("home_slider", "Set as Home Page Slider", 'PortfiloAddHomePageSlider', "post", "side", "high");

    }


function PortfiloAddHomePageSlider(){
    global $post;
    $portfilo_home_slider = get_post_meta( $post->ID, '_portfilo_home_slider', true );

    ?>
    <label for="<?php esc_attr_e( 'homeslider_checkbox' , 'portfilo' ); ?>">
        <input type="checkbox" id="<?php esc_attr_e( 'home_slider' , 'portfilo' ); ?>" name="<?php esc_attr_e( 'home_slider' , 'portfilo' ); ?>" <?php echo $portfilo_home_slider; ?> />
        <?php _e( 'Set as Home Page Slider', 'portfilo' ); ?>
    </label>

<?php

}

function PortfiloSaveHomePageSlider($post_id)
{
    global $post;

    if ( isset( $_POST['home_slider'] ) )
        $value='checked';
    else
        $value=' ';

    update_post_meta( $post_id, '_portfilo_home_slider', $value );
}
?>