<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/*
 *constants
 */
if( !function_exists('event_conference_setup') ):

    function event_conference_setup() {

        /**
         * Set the content width based on the theme's design and stylesheet.
         */
        global $content_width;
        if ( ! isset( $content_width ) )
            $content_width = 900;

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain( 'event_conference', get_parent_theme_file_path( '/languages' ) );

        /**
         * plazart theme setup.
         *
         * Set up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support post thumbnails.
         *
         */
        //Enable support for Header (tz-demo)
        add_theme_support( 'custom-header' );

        //Enable support for Background (tz-demo)
        add_theme_support( 'custom-background' );

        //Enable support for Post Thumbnails
        add_theme_support('post-thumbnails');

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menu('primary','Primary Menu');
        register_nav_menu('footer-menu','Footer Menu');

        // add theme support title-tag
        add_theme_support( 'title-tag' );

        /*  Post Type   */
        add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );

        /*
	    * This theme styles the visual editor to resemble the theme style,
	    * specifically font, colors, icons, and column width.
	    */
        add_editor_style( array( 'css/editor-style.css', event_conference_fonts_url()) );
    }

    add_action( 'after_setup_theme', 'event_conference_setup' );

endif;

/* Custom post formats post type */
function event_conference_get_allowed_project_formats() {

    return array( 'gallery' );
}

add_action( 'load-post.php',     'event_conference_post_format_support_filter' );
add_action( 'load-post-new.php', 'event_conference_post_format_support_filter' );
add_action( 'load-edit.php',     'event_conference_post_format_support_filter' );

function event_conference_post_format_support_filter() {

    $screen = get_current_screen();

    // Bail if not on the projects screen.
    if ( empty( $screen->post_type ) ||  $screen->post_type !== 'event' )
        return;

    // Check if the current theme supports formats.
    if ( current_theme_supports( 'post-formats' ) ) {

        $formats = get_theme_support( 'post-formats' );

        // If we have formats, add theme support for only the allowed formats.
        if ( isset( $formats[0] ) ) {
            $new_formats = array_intersect( $formats[0], event_conference_get_allowed_project_formats() );

            // Remove post formats support.
            remove_theme_support( 'post-formats' );

            // If the theme supports the allowed formats, add support for them.
            if ( $new_formats )
                add_theme_support( 'post-formats', $new_formats );
        }
    }

    // Filter the default post format.
    add_filter( 'option_default_post_format', 'event_conference_default_post_format_filter', 95 );
}

function event_conference_default_post_format_filter( $format ) {

    return in_array( $format, event_conference_get_allowed_project_formats() ) ? $format : 'standard';
}

/*
 * post formats
 * */
function event_conference_post_formats() {

    if( has_post_format('audio') || has_post_format('video') ):
        get_template_part( 'template-parts/post/content','video' );
    elseif ( has_post_format('image') ):
        get_template_part( 'template-parts/post/content','image' );
    elseif ( has_post_format('gallery') ):
        get_template_part( 'template-parts/post/content','gallery' );
    endif;

}

/*
* Required: include plugin theme scripts
*/
require get_parent_theme_file_path( '/extension/tz-process-option.php' );

if ( class_exists( 'ReduxFramework' ) ) {
    /*
     * Required: Redux Framework
     */
    require get_parent_theme_file_path( '/extension/option-reudx/theme-options.php' );
}

if ( class_exists( 'RW_Meta_Box' ) ) {
    /*
     * Required: Meta Box Framework
     */
    require get_parent_theme_file_path( '/extension/meta-box/meta-box-options.php' );
}

if ( ! function_exists( 'event_conference_check_rwmb_meta' ) ) {
    function event_conference_check_rwmb_meta( $event_conference_rwmb_metakey, $event_conference_opt_args = '', $event_conference_rwmb_post_id = null ) {
        return false;
    }
}

if ( did_action( 'elementor/loaded' ) ) :
    /*
     * Required: Elementor
     */
    require get_parent_theme_file_path( '/extension/elementor/elementor.php' );

    require get_parent_theme_file_path( '/extension/elementor/function-elementor.php' );

endif;

/* Require Post Type */
require get_parent_theme_file_path( '/extension/post-type/events.php' );

/* Require Widgets */
foreach(glob( get_parent_theme_file_path( '/extension/widgets/*.php' ) ) as $event_conference_file_widgets ) {
    require $event_conference_file_widgets;
}

/**
 * Register Sidebar
 */
add_action( 'widgets_init', 'event_conference_widgets_init');

function event_conference_widgets_init() {

    $event_conference_widgets_arr  =   array(

        'event_conference-sidebar'    =>  array(
            'name'              =>  esc_html__( 'Sidebar', 'event_conference' ),
            'description'       =>  esc_html__( 'Display sidebar right or left on all page.', 'event_conference' )
        ),

        'event_conference-footer-1'   =>  array(
            'name'              =>  esc_html__( 'Footer 1', 'event_conference' ),
            'description'       =>  esc_html__('Display footer column 1 on all page.', 'event_conference' )
        ),

        'event_conference-footer-2'   =>  array(
            'name'              =>  esc_html__( 'Footer 2', 'event_conference' ),
            'description'       =>  esc_html__('Display footer column 2 on all page.', 'event_conference' )
        ),

        'event_conference-footer-3'   =>  array(
            'name'              =>  esc_html__( 'Footer 3', 'event_conference' ),
            'description'       =>  esc_html__('Display footer column 3 on all page.', 'event_conference' )
        ),

        'event_conference-footer-4'   =>  array(
            'name'              =>  esc_html__( 'Footer 4', 'event_conference' ),
            'description'       =>  esc_html__('Display footer column 4 on all page.', 'event_conference' )
        ),

        'event_conference-footer-1-2'   =>  array(
            'name'              =>  esc_html__( 'Footer 1-2', 'event_conference' ),
            'description'       =>  esc_html__('Display footer column 1 on all page.', 'event_conference' )
        ),

        'event_conference-footer-2-2'   =>  array(
            'name'              =>  esc_html__( 'Footer 2-2', 'event_conference' ),
            'description'       =>  esc_html__('Display footer column 2 on all page.', 'event_conference' )
        ),

        'event_conference-footer-3-2'   =>  array(
            'name'              =>  esc_html__( 'Footer 3-2', 'event_conference' ),
            'description'       =>  esc_html__('Display footer column 3 on all page.', 'event_conference' )
        ),

        'event_conference-footer-4-2'   =>  array(
            'name'              =>  esc_html__( 'Footer 4-2', 'event_conference' ),
            'description'       =>  esc_html__('Display footer column 4 on all page.', 'event_conference' )
        ),

    );

    foreach ( $event_conference_widgets_arr as $event_conference_widgets_id => $event_conference_widgets_value ) :

        register_sidebar( array(
            'name'          =>  esc_attr( $event_conference_widgets_value['name'] ),
            'id'            =>  esc_attr( $event_conference_widgets_id ),
            'description'   =>  esc_attr( $event_conference_widgets_value['description'] ),
            'before_widget' =>  '<section id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</section>',
            'before_title'  =>  '<h2 class="widget-title">',
            'after_title'   =>  '</h2>'
        ));

    endforeach;

}

// Remove jquery migrate
add_action( 'wp_default_scripts', 'event_conference_remove_jquery_migrate' );
function event_conference_remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}

// Load jquery script in footer
add_action( 'init', 'event_conference_init_load'  );
function event_conference_init_load() {

    if ( !is_admin() ) :
        wp_deregister_script('jquery');

        // Load the copy of jQuery that comes with WordPress
        // The last parameter set to TRUE states that it should be loaded
        // in the footer.
        wp_register_script( 'jquery', '/wp-includes/js/jquery/jquery.js', false, '', true );

        wp_enqueue_script('jquery');
    endif;

    /* Require HTML Compression */
    global $event_conference_options;
    $event_conference_minify_html =   $event_conference_options['event_conference_minify_html'];

    if ( $event_conference_minify_html == 1 ) :

        require get_parent_theme_file_path( '/extension/WP-HTML-Compression.php' );

    endif;

}

// Check deregister styles
add_action( 'wp_print_styles', 'event_conference_deregister_styles', 100 );
function event_conference_deregister_styles() {
    global $post;

    wp_deregister_style('font-awesome');
    wp_deregister_style('wpcr_font-awesome');

    if ( !is_singular( 'post' ) ) :
        wp_deregister_style( 'wpcr_style' );
        wp_dequeue_script( 'wpcr_js' );
    endif;

    if ( ! empty( $post ) && is_a( $post, 'WP_Post' ) ) :
        $plugin_photo = $post->post_content;

        if ( !has_shortcode( $plugin_photo, 'contact-form-7' ) ) :

            wp_deregister_style( 'contact-form-7' );
            wp_dequeue_script('contact-form-7');

        endif;

    endif;

}

//Register Back-End script
add_action('admin_enqueue_scripts', 'event_conference_register_back_end_scripts');

function event_conference_register_back_end_scripts(){

    /* Start Get CSS Admin */
    wp_enqueue_style( 'event_conference-admin-styles', get_theme_file_uri( '/extension/assets/css/admin-styles.css' ) );

    /* Get JS Admin */
    wp_enqueue_script( 'event_conference_meta_boxes_option', get_theme_file_uri( '/extension/assets/js/meta_box_option.js' ), array(), '', true );

}

//Register Front-End Styles
add_action('wp_enqueue_scripts', 'event_conference_register_front_end');

function event_conference_register_front_end() {

    /*
    * Start Get Css Front End
    * */

    /* Start Font */
    wp_enqueue_style( 'event_conference_fonts', event_conference_fonts_url(), array(), null );
    /* End Font */

    wp_enqueue_style( 'main', get_theme_file_uri( '/css/main.css' ), array(), '' );

    /*  Start Style Css   */
    wp_enqueue_style( 'event_conference-style', get_stylesheet_uri() );
    /*  Start Style Css   */

    /*
    * End Get Css Front End
    * */

    /*
    * Start Get Js Front End
    * */

    // Load the html5 shiv.

    wp_enqueue_script( 'html5', get_theme_file_uri( '/js/html5.js' ), array(), '3.7.3' );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'event-conference-main-js', get_theme_file_uri( '/js/main.min.js' ), array(), '', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
        wp_enqueue_script( 'comment-reply' );
    endif;

    wp_enqueue_script( 'event-conference-custom', get_theme_file_uri( '/js/custom.js' ), array(), '1.0.0', true );

    /*
   * End Get Js Front End
   * */

}

/**
 * Show full editor
 */
if ( !function_exists('event_conference_ilc_mce_buttons') ) :

    function event_conference_ilc_mce_buttons( $event_conference_buttons_TinyMCE ) {

        array_push( $event_conference_buttons_TinyMCE,
                "backcolor",
                "anchor",
                "hr",
                "sub",
                "sup",
                "fontselect",
                "fontsizeselect",
                "styleselect",
                "cleanup"
            );

        return $event_conference_buttons_TinyMCE;

    }

    add_filter("mce_buttons_2", "event_conference_ilc_mce_buttons");

endif;

// Start Customize mce editor font sizes
if ( ! function_exists( 'event_conference_mce_text_sizes' ) ) :

    function event_conference_mce_text_sizes( $event_conference_font_size_text ){
        $event_conference_font_size_text['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 17px 18px 19px 20px 21px 24px 28px 32px 36px";
        return $event_conference_font_size_text;
    }

    add_filter( 'tiny_mce_before_init', 'event_conference_mce_text_sizes' );

endif;
// End Customize mce editor font sizes

/* callback comment list */
function event_conference_comments( $event_conference_comment, $event_conference_comment_args, $event_conference_comment_depth ) {

    if ( 'div' === $event_conference_comment_args['style'] ) :

        $event_conference_comment_tag       = 'div';
        $event_conference_comment_add_below = 'comment';

    else :

        $event_conference_comment_tag       = 'li';
        $event_conference_comment_add_below = 'div-comment';

    endif;

?>
    <<?php echo $event_conference_comment_tag ?> <?php comment_class( empty( $event_conference_comment_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

    <?php if ( 'div' != $event_conference_comment_args['style'] ) : ?>

        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">

    <?php endif; ?>

    <div class="comment-author vcard">
        <?php if ( $event_conference_comment_args['avatar_size'] != 0 ) echo get_avatar( $event_conference_comment, $event_conference_comment_args['avatar_size'] ); ?>

    </div>

    <?php if ( $event_conference_comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation">
            <?php esc_html_e( 'Your comment is awaiting moderation.', 'event_conference' ); ?>
        </em>
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
        <div class="comment-meta-box d-flex">
             <span class="name">
                <?php comment_author_link(); ?>
            </span>
            <span class="comment-metadata">
                <?php comment_date(); ?>
            </span>

            <?php edit_comment_link( esc_html__( 'Edit ', 'event_conference' ) ); ?>

            <?php comment_reply_link( array_merge( $event_conference_comment_args, array( 'add_below' => $event_conference_comment_add_below, 'depth' => $event_conference_comment_depth, 'max_depth' => $event_conference_comment_args['max_depth'] ) ) ); ?>

        </div>
        <div class="comment-text-box">
            <?php comment_text(); ?>
        </div>
    </div>

    <?php if ( 'div' != $event_conference_comment_args['style'] ) : ?>
        </div>
    <?php endif; ?>

<?php
}
/* callback comment list */

if ( ! function_exists( 'event_conference_fonts_url' ) ) :

    function event_conference_fonts_url() {
        $event_conference_fonts_url = '';

        /* Translators: If there are characters in your language that are not
        * supported by Open Sans, translate this to 'off'. Do not translate
        * into your own language.
        */
        $event_conference_font_google = _x( 'on', 'Google font: on or off', 'event_conference' );

        if ( 'off' !== $event_conference_font_google ) {
            $event_conference_font_families = array();

            if ( 'off' !== $event_conference_font_google ) {
                $event_conference_font_families[] = 'Roboto:400,500,700';
            }

            $event_conference_query_args = array(
                'family' => urlencode( implode( '|', $event_conference_font_families ) ),
                'subset' => urlencode( 'latin' ),
            );

            $event_conference_fonts_url = add_query_arg( $event_conference_query_args, 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw( $event_conference_fonts_url );
    }

endif;

/*
 * Content Nav
 */

if ( ! function_exists( 'event_conference_comment_nav' ) ) :

    function event_conference_comment_nav() {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

    ?>
            <nav class="navigation comment-navigation">
                <h2 class="screen-reader-text">
                    <?php _e( 'Comment navigation', 'event_conference' ); ?>
                </h2>
                <div class="nav-links">
                    <?php
                    if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'event_conference' ) ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;

                    if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'event_conference' ) ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->

    <?php
        endif;
    }

endif;

/*
 * TWITTER AMPERSAND ENTITY DECODE
 */
if( ! function_exists( 'event_conference_social_title' )):

    function event_conference_social_title( $event_conference_title ) {

        $event_conference_title = html_entity_decode( $event_conference_title );
        $event_conference_title = urlencode( $event_conference_title );

        return $event_conference_title;

    }

endif;

/****************************************************************************************************************
 * Fuction override post_class()
 * */

if ( ! function_exists( 'event_conference_post_classes' ) ) :

    function event_conference_post_classes( $event_conference_body_class ) {

        if ( is_category() || is_tag() || is_search() || is_author() || is_archive() || is_home() ) {
            $event_conference_body_class[] = 'site-post-item';
        }

        if ( is_single() ) {
            $event_conference_body_class[] = 'site-post-single-item';
        }
        return $event_conference_body_class;

    }

    add_filter( 'post_class', 'event_conference_post_classes' );

endif;

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_parent_theme_file_path( '/plugins/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'event_conference_register_required_plugins' );
function event_conference_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $event_conference_plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Redux Framework',
            'slug'      =>  'redux-framework',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Meta Box',
            'slug'      =>  'meta-box',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Elementor',
            'slug'      =>  'elementor',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Contact Form 7',
            'slug'      =>  'contact-form-7',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Categories Images',
            'slug'      =>  'categories-images',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Breadcrumb navxt',
            'slug'      =>  'breadcrumb-navxt',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'WP Post Comment Rating',
            'slug'      =>  'wp-post-comment-rating',
            'required'  =>  true,
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $event_conference_config = array(
        'id'           => 'event_conference',          // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $event_conference_plugins, $event_conference_config );
}

/* Start Social Network */
function event_conference_get_social_url() {

    global $event_conference_options;
    $event_conference_social_networks = event_conference_get_social_network();

?>

        <?php
        foreach( $event_conference_social_networks as $event_conference_social ) :

            $event_conference_social_url = $event_conference_options['event_conference_social_network_' . $event_conference_social['id']];

            if( $event_conference_social_url ) :

        ?>

                <div class="social-network-item">
                    <a href="<?php echo esc_url( $event_conference_social_url ); ?>">
                        <i class="fa fa-<?php echo esc_attr( $event_conference_social['id'] ); ?>" aria-hidden="true"></i>
                    </a>
                </div>

        <?php
            endif;

        endforeach;
        ?>

<?php

}

function event_conference_get_social_network() {
    return array(

        array('id' => 'facebook', 'title' => 'Facebook'),
        array('id' => 'twitter', 'title' => 'Twitter'),
        array('id' => 'google-plus', 'title' => 'Google Plus'),
        array('id' => 'linkedin', 'title' => 'linkedin'),
        array('id' => 'pinterest', 'title' => 'Pinterest'),
        array('id' => 'youtube', 'title' => 'Youtube'),
        array('id' => 'instagram', 'title' => 'instagram'),
        array('id' => 'vimeo', 'title' => 'Vimeo'),

    );
}
/* End Social Network */

/* Start pagination */
function event_conference_pagination() {

    the_posts_pagination( array(
        'type' => 'list',
        'mid_size' => 2,
        'prev_text' => esc_html__( 'Previous', 'event_conference' ),
        'next_text' => esc_html__( 'Next', 'event_conference' ),
        'screen_reader_text' => esc_html__( '&nbsp;', 'event_conference' ),
    ) );

}

// pagination nav query
function event_conference_paging_nav_query( $event_conference_query ) {

    $event_conference_pagination_args  =   array(
        'prev_text' => '<i class="fa fa-angle-double-left"></i>' . esc_html__(' Previous', 'event_conference' ),
        'next_text' => esc_html__('Next', 'event_conference' ) . '<i class="fa fa-angle-double-right"></i>',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $event_conference_query->max_num_pages,
        'type'      => 'list',
    );

    $event_conference_paginate_links = paginate_links( $event_conference_pagination_args );

    if ( $event_conference_paginate_links ) :

    ?>
        <nav class="pagination">

            <?php echo $event_conference_paginate_links; ?>

        </nav>

    <?php

    endif;

}

/* End pagination */
function event_conference_sanitize_pagination( $event_conference_content ) {
    // Remove role attribute
    $event_conference_content = str_replace('role="navigation"', '', $event_conference_content);

    // Remove h2 tag
    $event_conference_content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $event_conference_content);

    return $event_conference_content;
}

add_action('navigation_markup_template', 'event_conference_sanitize_pagination');

/* Posts per page taxonomy */
$event_conference_option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'event_conference_posts_per_page_taxonomy', 0);

function event_conference_posts_per_page_taxonomy() {
    add_filter( 'option_posts_per_page', 'event_conference_option_posts_per_page_taxonomy' );
}

function event_conference_option_posts_per_page_taxonomy() {
    
    global $event_conference_option_posts_per_page, $event_conference_options;

    $event_conference_event_cat_limit = $event_conference_options['event_conference_event_cat_limit'];

    if ( is_tax( 'event_cat') ) :
        return $event_conference_event_cat_limit;
    else :
        return $event_conference_option_posts_per_page;
    endif;
    
}

/* Start Count View Post */
function event_conference_post_view_set( $postID ) {

    $event_conference_count_key = 'postview_number';
    $event_conference_count = get_post_meta( $postID, $event_conference_count_key, true );

    if( $event_conference_count == '' ) :
        $count = 0;
        delete_post_meta( $postID, $event_conference_count_key );
        add_post_meta( $postID, $event_conference_count_key, '0' );
    else :
        $event_conference_count++;
        update_post_meta( $postID, $event_conference_count_key, $event_conference_count );
    endif;

}

function event_conference_post_view_get( $postID ) {

    $event_conference_count_key = 'postview_number';
    $event_conference_count = get_post_meta( $postID, $event_conference_count_key, true );

    if( $event_conference_count == '' ) :
        delete_post_meta($postID, $event_conference_count_key);
        add_post_meta( $postID, $event_conference_count_key, '0' );
        return "0";
    endif;

    return $event_conference_count;

}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
/* End Count View Post */

/* Start Get col global */
function event_conference_col_use_sidebar( $option_position_sidebar_meta, $active_sidebar ) {

    if ( $option_position_sidebar_meta != 'hide' && is_active_sidebar( $active_sidebar ) ):
        $class_col_content_sidebar = 'col-12 col-md-12 col-lg-8';
    else:
        $class_col_content_sidebar = 'col-md-12';
    endif;

    return $class_col_content_sidebar;
}

function event_conference_col_sidebar() {
    $class_col_sidebar = 'col-12 col-md-12 col-lg-4';

    return $class_col_sidebar;
}
/* End Get col global */

/* Start social network share */
function event_conference_social_network_share() {
?>

    <div class="site-post-share">
        <!-- Facebook Button -->
        <a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
            <i class="fa fa-facebook"></i>
            <span>
                <?php echo esc_html( 'Facebook' ); ?>
            </span>
        </a>

        <!-- Twitter Button -->
        <a class="twitter" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php print event_conference_social_title( get_the_title() ); ?>%20-%20<?php the_permalink(); ?>">
            <i class="fa fa-twitter"></i>
            <span>
                <?php echo esc_html( 'Tweet' ); ?>
            </span>
        </a>

        <!-- Google Button -->
        <a class="google" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
            <i class="fa fa-google-plus"></i>
        </a>
    </div>

<?php
}
/* End social network share */