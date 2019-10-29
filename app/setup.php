<?php 
if ( !function_exists( '_theme_scripts' ) ) {

    /**
     * Initially Remove Unused Jquery Dependencies
     */
    function remove_jquery_wordpress( $scripts ) {
         if ( !is_admin() ) {
            $script = $scripts->registered['jquery'];
         
             if ( $script->deps ) { 
                $script->deps = array_diff( $script->deps, array( 'jquery-core', 'jquery-migrate' ) );
               
             }
         }
    }
     
    add_action( 'wp_default_scripts', 'remove_jquery_wordpress' );


    function _theme_scripts() {
      //  wp_deregister_script( 'jquery' );

        // STYLESHEETS
        wp_enqueue_style( 'main-style-preload', get_template_directory_uri() . '/assets/css/main.css' );
        wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/main.css' );
        wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );

        // JS
       
        wp_enqueue_script( 'main-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js', array(), '3.3.1', false );
        wp_enqueue_script( 'main-modernizer', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), '2.8.3', false );

        // wp_enqueue_script('gmaps','https://maps.googleapis.com/maps/api/js?key='.get_field('google_map_key','options').'&v=3.exp&libraries=places&language=en',array('jquery'),'',true );
       //wp_enqueue_script( 'main-js', get_template_directory_uri() . '/dist/assets/js/main.min.js', '1', true );
       
        wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'),'1', true );

        
    }
    add_action( 'wp_enqueue_scripts', '_theme_scripts', 10 );


    // Add script handles to Scripts
    function AddRelAttribute($tag, $handle) {
    

        if($handle == 'main-style-preload'){

            return str_replace("rel='stylesheet'", "rel='preload' as='style'", $tag); 

        }else{
            
            return str_replace('href', 'defer="defer" href', $tag);
        }

    }
    add_filter('style_loader_tag', 'AddRelAttribute', 10, 4);

}


/**
 * Theme Setup
 */
if ( !function_exists( '_theme_setup' ) ) {
    
    function _theme_setup() {
        // REGISTER MENU
        register_nav_menu( 'primary', __( 'Primary Navigation', '_theme_setup' ) );

        // THEME SUPPORTS
        add_theme_support( 'post-thumbnails' );
        //add_theme_support( 'woocommerce' );
        // add_theme_support( 'wc-product-gallery-zoom' );
        // add_theme_support( 'wc-product-gallery-lightbox' );
        // add_theme_support( 'wc-product-gallery-slider' );

        // WIDGETS SECTION
        register_sidebar( array(
            'name'          => __( 'Sidebar' ),
            'id'            => 'sidebar-default',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

        // RUN SHORTCODES FROM WIDGETS
        add_filter( 'widget_text', 'do_shortcode' );
    }
    add_action( 'after_setup_theme', '_theme_setup' );
}


/**
 * Set Cropper For Medium Sized Images
 */
add_image_size('medium', get_option( 'medium_size_w' ), get_option( 'medium_size_h' ), true );
add_image_size('large', get_option( 'large' ), get_option( 'large' ), true );


/**
 * Disable Notifications (Updates, Wordpress Core, Plugins)
 */
if( get_field( 'hide_notification_updates','options' ) ) {

    add_action('after_setup_theme','remove_core_updates');
    function remove_core_updates() {
        if( !current_user_can('update_core') ){ return; }
        // add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
        add_filter('pre_option_update_core','__return_null');
        add_filter('pre_site_transient_update_core','__return_null');

        global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
    }
    add_filter('pre_site_transient_update_core','remove_core_updates');
    add_filter('pre_site_transient_update_plugins','remove_core_updates');
    add_filter('pre_site_transient_update_themes','remove_core_updates');
    remove_action('load-update-core.php','wp_update_plugins');
    add_filter('pre_site_transient_update_plugins','__return_null');
}

/**
 * Disable the emoji's
 */
function disableEmojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disableEmojisTinymce' );
    add_filter( 'wp_resource_hints', 'disableEmojisRemoveDnsPrefetch', 10, 2 );
}
add_action( 'init', 'disableEmojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 */
function disableEmojisTinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 */
function disableEmojisRemoveDnsPrefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
}

/**
 * Menu Walker for Mobile Menu
 */
class Add_Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth=0, $args=array()) {
        $indent = str_repeat("\t", $depth);
       // var_dump($args);
       //if('primary' == $args->theme_location && $depth ==0){
            $output .='<span class="sub-ctrl"><i class="fas fa-caret-right"></i></span>';
       // }
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
}

/**
 * Auto Add Alt Text to Images
 */
add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );
function my_set_image_meta_upon_image_upload( $post_ID ) {
    if ( wp_attachment_is_image( $post_ID ) ) {
        $my_image_title = get_post( $post_ID )->post_title;
        $my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );
        $my_image_title = ucwords( strtolower( $my_image_title ) );
        $my_image_meta = array(
            'ID'        => $post_ID,
            'post_title'    => $my_image_title,
        );
        update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );
        wp_update_post( $my_image_meta );
    }
}


/**
 * Admin Theme OPtions
 */
add_action('admin_head', 'themeOptionsCss');
function themeOptionsCss() {
    echo '<style>
        #toplevel_page_theme-general-settings .toplevel_page_theme-general-settings .wp-menu-image img {
            max-width:16px;
            width:100%;
            height:auto;
            padding:10px 0;
            margin:0;
        }
    </style>';
}


/**
 * =====================================
 * Search Filter , Redirect to Home if Search is Blank
 * =====================================
 */
function searchRequestFilter( $query_vars ) {
    if( isset( $_GET['s']) && $_GET['s'] == '' ) {
        wp_redirect( site_url() );
        exit;
    }
    return $query_vars;
}
 
add_filter( 'request', 'searchRequestFilter' );


/**
 * Disable Guttenburg
 */
function DisableGutenberg($is_enabled, $post_type) {
    
    return false;
    
}
//add_filter('use_block_editor_for_post_type', 'DisableGutenberg', 10, 2);


/**
 * Hide Admin Bar on Frontend
 */
add_filter('show_admin_bar', '__return_false');


/**
 * Add SVG to Backend
 */
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');       


/**
 * Add bootstrap class to WP Thumbnail
 */
function add_class_thumbnail($attr) {
  remove_filter('wp_get_attachment_image_attributes','add_class_thumbnail');
  $attr['class'] .= ' img-fluid';
  return $attr;
}
add_filter('wp_get_attachment_image_attributes','add_class_thumbnail'); 


/**
 * Change Search Icon on Widgets
 */
add_filter('get_search_form', 'my_search_form_text');
 
function my_search_form_text($text) {
     $text = str_replace('value="Search"', 'value="&#xf002;"', $text); //set as value the text you want
     return $text;
}


/**
 * WP Excerpt Settings
 */
function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );



/**
 * Update Add Title
 */
add_filter( 'enter_title_here', 'custom_enter_title' );
function custom_enter_title( $input ) {
    if ( 'ccm_testimonials' === get_post_type() ) {
        return __( 'Enter Author Name Here', '_theme_setup' );
    }

    return $input;
}