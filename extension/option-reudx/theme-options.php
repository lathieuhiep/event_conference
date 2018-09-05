<?php
/**
 * ReduxFramework Config File
 * TemPlaza Plazart Default Theme
 */
if (!class_exists('Redux')) {
    return;
}


// This is your option name where all the Redux data is stored.
$event_conference_opt_name = "event_conference_options";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * */

$event_conference_theme = wp_get_theme(); // For use with some settings. Not necessary.

$event_conference_opt_args = array(

    'opt_name' => $event_conference_opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $event_conference_theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $event_conference_theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => false,
    // Show the sections below the admin menu item or not
    'menu_title' => $event_conference_theme->get('Name') . esc_html__(' Options', 'event_conference'),
    'page_title' => $event_conference_theme->get('Name') . esc_html__(' Options', 'event_conference'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,

    // OPTIONAL -> Give you extra features
    'page_priority' => 2,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => '',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => '',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave',
            ),
        ),
    )
);
Redux::setArgs($event_conference_opt_name, $event_conference_opt_args);
/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */

$event_conference_opt_tabs = array(
    array(
        'id' => 'redux-help-tab-1',
        'title' => esc_html__('Theme Information 1', 'event_conference'),
        'content' => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'event_conference')
    ),
    array(
        'id' => 'redux-help-tab-2',
        'title' => esc_html__('Theme Information 2', 'event_conference'),
        'content' => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'event_conference')
    )
);
Redux::setHelpTab($event_conference_opt_name, $event_conference_opt_tabs);

// Set the help sidebar
$event_conference_opt_content = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'event_conference');
Redux::setHelpSidebar($event_conference_opt_name, $event_conference_opt_content);


/*
 * <--- END HELP TABS
 */

/*
 *
 * ---> START SECTIONS
 *
 */

// -> START option background

Redux::setSection($event_conference_opt_name, array(
    'id' => 'event_conference_theme_option',
    'title' => $event_conference_theme->get('Name') . ' ' . $event_conference_theme->get('Version'),
    'customizer_width' => '400px',
    'icon' => '',
));

// -> END option background

/* Start General Options */

Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('General Options', 'event_conference'),
    'id' => 'event_conference_general',
    'desc' => esc_html__('General all config', 'event_conference'),
    'customizer_width' => '400px',
    'icon' => 'el el-th-large',
));

// Favicon Config
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Favicon', 'event_conference'),
    'id' => 'event_conference_favicon_config',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'event_conference_favicon_upload',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Upload Favicon Image', 'event_conference'),
            'subtitle' => esc_html__('Favicon image for your website', 'event_conference'),
            'desc' => esc_html__('', 'event_conference'),
            'default' => false,
        ),
    )
));

//Loading config
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Loading config', 'event_conference'),
    'id' => 'event_conference_general_loading',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'event_conference_general_show_loading',
            'type' => 'switch',
            'title' => esc_html__('Loading On/Off', 'event_conference'),
            'default' => false,
        ),
        array(
            'id' => 'event_conference_general_image_loading',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Upload image loading', 'event_conference'),
            'subtitle' => esc_html__('Upload image .gif', 'event_conference'),
            'default' => '',
            'required' => array('event_conference_general_show_loading', '=', true),
        ),
    )
));

//Background Options
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Background', 'event_conference'),
    'id' => 'event_conference_background',
    'desc' => esc_html__('Background all config', 'event_conference'),
    'customizer_width' => '400px',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'event_conference_background_body',
            'output' => 'body',
            'type' => 'background',
            'clone' => 'true',
            'title' => esc_html__('Body background', 'event_conference'),
            'subtitle' => esc_html__('Body background with image, color, etc.', 'event_conference'),
            'hint' => array(
                'content' => 'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
            )
        ),
    ),
));

//Minify HTML Options
Redux::setSection( $event_conference_opt_name, array(
    'title'             =>  esc_html__( 'Minify HTML', 'event_conference' ),
    'id'                =>  'event_conference_minify_html_option',
    'customizer_width'  =>  '400px',
    'subsection'        => true,
    'fields'            => array(

        array(
            'id'        =>  'event_conference_minify_html',
            'type'      =>  'select',
            'title'     =>  esc_html__( 'Usage Minify HTML', 'event_conference' ),
            'default'   =>  0,
            'options'   =>  array(
                0   =>  esc_html__( 'Off', 'event_conference' ),
                1   =>  esc_html__( 'On', 'event_conference' )
            )
        ),

    ),
));

/* End General Options */

/* Start Header Options */
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Header Options', 'event_conference'),
    'id' => 'event_conference_header',
    'desc' => esc_html__('Header all config', 'event_conference'),
    'customizer_width' => '400px',
    'icon' => 'el el-arrow-up',
));
// General Header option
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('General Header', 'event_conference'),
    'id' => 'event_conference_general_header_config',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'event_conference_header_background_image',
            'type' => 'background',
            'url' => true,
            'title' => esc_html__('Header background', 'event_conference'),
            'subtitle' => esc_html__('logo image for your website', 'event_conference'),
            'desc' => esc_html__('', 'event_conference'),
            'default' => false,
            'output'  => '.header-relative'
        ),
    )
));

//Logo Config
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Logo', 'event_conference'),
    'id' => 'event_conference_logo_config',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'event_conference_logo_image',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Upload logo', 'event_conference'),
            'subtitle' => esc_html__('logo image for your website', 'event_conference'),
            'desc' => esc_html__('', 'event_conference'),
            'default' => false,
        ),

        array(
            'id' => 'event_conference_logo_images_size',
            'type' => 'dimensions',
            'units' => array('em', 'px', '%'),
            'title' => esc_html__('Set width/height for logo', 'event_conference'),
            'subtitle' => esc_html__('', 'event_conference'),
            'units_extended' => 'true',
            'default' => array(
                'width' => '',
                'height' => '',
            ),
            'output' => array('.site-logo img'),
        ),

        array(
            'id' => 'event_conference_logo_text_footer',
            'type' => 'text',
            'title' => esc_html__('Logo text footer', 'event_conference'),
            'default' => 'Events',
        ),
    )
));

/* End Header Options */

/* Start Blog Option */
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Blog Options', 'event_conference'),
    'id' => 'event_conference_blog_option',
    'customizer_width' => '400px',
    'icon' => 'el el-blogger',
    'fields' => array(

        array(
            'id' => 'event_conference_blog_sidebar_archive',
            'type' => 'image_select',
            'title' => esc_html__('Sidebar Archive', 'event_conference'),
            'desc' => esc_html__('Use for archive, index, page search', 'event_conference'),
            'default' => 'right',
            'options' => array(
                'hide' => array(
                    'alt' => 'None Sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' => array(
                    'alt' => 'Sidebar Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' => array(
                    'alt' => 'Sidebar Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

        array(
            'id' => 'event_conference_blog_sidebar_single',
            'type' => 'image_select',
            'title' => esc_html__('Sidebar Single', 'event_conference'),
            'default' => 'right',
            'options' => array(
                'hide' => array(
                    'alt' => 'None Sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' => array(
                    'alt' => 'Sidebar Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' => array(
                    'alt' => 'Sidebar Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

        array(
            'id' => 'event_conference_on_off_share_single',
            'type' => 'switch',
            'title' => esc_html__('On/Off Share Post Single', 'event_conference'),
            'default' => true,
        ),

    )
));
/* End Blog Option */

/* Start Event Options */
Redux::setSection( $event_conference_opt_name, array(

    'title' => esc_html__('Event Options', 'event_conference'),
    'id' => 'event_conference_event_option',
    'customizer_width' => '400px',
    'icon' => 'el eicon-countdown',
    'fields' => array(

        array(
            'id' => 'event_conference_event_support',
            'type' => 'text',
            'title' => esc_html__('Phone Support', 'event_conference'),
            'default' => '123456789',
        ),

        array(
            'id' => 'event_conference_event_short_code_form',
            'type' => 'text',
            'title' => esc_html__('ShortCode Contact Form', 'event_conference'),
            'desc' => esc_html__('Use Contact Form 7', 'event_conference'),
            'default' => '',
        ),

        array(
            'id' => 'event_conference_event_notification',
            'type' => 'text',
            'title' => esc_html__('Notification', 'event_conference'),
            'default' => 'Liên hệ để tổ chức sự kiện tương tự: SĐT 123456789',
        ),

    )

) );

Redux::setSection( $event_conference_opt_name, array(

    'title' => esc_html__('Events Categories', 'event_conference'),
    'id' => 'event_conference_event_cat_option',
    'customizer_width' => '400px',
    'subsection' => true,
    'fields' => array(

        array(
            'title' => esc_html__('On / Off Slides Category Event', 'event_conference'),
            'id' => 'event_conference_event_cat_slides_on_off',
            'type' => 'button_set',
            'options' => array(
                1 => 'Off',
                2 => 'On',
            ),
            'default' => 1
        ),

        array(
            'title' => esc_html__('Slides Category Event', 'event_conference'),
            'id' => 'event_conference_event_cat_gallery',
            'type' => 'gallery',
            'desc' => esc_html__('Slides event category', 'event_conference'),
            'required' => array(
                'event_conference_event_cat_slides_on_off','equals','2'
            )
        ),

        array(
            'title' => esc_html__('Number of events to show', 'event_conference'),
            'id' => 'event_conference_event_cat_limit',
            'type' => 'slider',
            'default' => 10,
            'min' => 1,
            'step' => 1,
            'max' => 250,
        ),

        array(
            'id' => 'event_conference_event_cat_sidebar',
            'type' => 'image_select',
            'title' => esc_html__('Sidebar', 'event_conference'),
            'default' => 'right',
            'options' => array(
                'hide' => array(
                    'alt' => 'None Sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' => array(
                    'alt' => 'Sidebar Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' => array(
                    'alt' => 'Sidebar Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

    )

) );

Redux::setSection( $event_conference_opt_name, array(

    'title' => esc_html__('Event Single', 'event_conference'),
    'id' => 'event_conference_event_single_option',
    'customizer_width' => '400px',
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'event_conference_event_single_sidebar',
            'type' => 'image_select',
            'title' => esc_html__('Sidebar ( Type Standard )', 'event_conference'),
            'default' => 'right',
            'options' => array(
                'hide' => array(
                    'alt' => 'None Sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),

                'left' => array(
                    'alt' => 'Sidebar Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),

                'right' => array(
                    'alt' => 'Sidebar Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),

            ),
        ),

        array(
            'title'     =>  esc_html__('Number of event related to show', 'event_conference'),
            'id'        =>  'event_conference_event_related_limit',
            'type'      =>  'slider',
            'default'   =>  5,
            'min'       =>  1,
            'step'      =>  1,
            'max'       =>  100,
        ),

        array(
            'title'     =>  esc_html__('Number of event other to show', 'event_conference'),
            'id'        =>  'event_conference_event_other_limit',
            'type'      =>  'slider',
            'default'   =>  5,
            'min'       =>  1,
            'step'      =>  1,
            'max'       =>  100,
        ),

    )

) );
/* End Event Options */

/* Start Social Network */
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Social Network', 'event_conference'),
    'id' => 'event_conference_social_network',
    'customizer_width' => '400px',
    'icon' => 'el el-globe-alt',
    'fields' => array(
        array(
            'id' => 'event_conference_social_network_facebook',
            'type' => 'text',
            'title' => esc_html__('Facebook', 'event_conference'),
            'default' => '#',
        ),

        array(
            'id' => 'event_conference_social_network_twitter',
            'type' => 'text',
            'title' => esc_html__('Twitter', 'event_conference'),
            'default' => '#',
        ),

        array(
            'id' => 'event_conference_social_network_google-plus',
            'type' => 'text',
            'title' => esc_html__('Google Plus', 'event_conference'),
            'default' => '#',
        ),

        array(
            'id' => 'event_conference_social_network_linkedin',
            'type' => 'text',
            'title' => esc_html__('Linkedin', 'event_conference'),
            'default' => '#',
        ),

        array(
            'id' => 'event_conference_social_network_pinterest',
            'type' => 'text',
            'title' => esc_html__('Pinterest', 'event_conference'),
            'default' => '#',
        ),

        array(
            'id' => 'event_conference_social_network_youtube',
            'type' => 'text',
            'title' => esc_html__('Youtube', 'event_conference'),
            'default' => '#',
        ),

        array(
            'id' => 'event_conference_social_network_instagram',
            'type' => 'text',
            'title' => esc_html__('Instagram', 'event_conference'),
            'default' => '#',
        ),

        array(
            'id' => 'event_conference_social_network_vimeo',
            'type' => 'text',
            'title' => esc_html__('Vimeo', 'event_conference'),
            'default' => '#',
        ),

    )
));
/* End Social Network */

/* Start Typography Options */
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Typography', 'event_conference'),
    'id' => 'event_conference_typography',
    'desc' => esc_html__('Typography all config', 'event_conference'),
    'customizer_width' => '400px',
    'icon' => 'el el-fontsize'
));

// Body font
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Body Typography', 'event_conference'),
    'id' => 'event_conference_body_typography',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'event_conference_body_typography_font',
            'type' => 'typography',
            'output' => array('body'),
            'title' => esc_html__('Body Font', 'event_conference'),
            'subtitle' => esc_html__('Specify the body font properties.', 'event_conference'),
            'google' => true,
            'default' => array(
                'color' => '',
                'font-size' => '',
                'font-family' => '',
                'font-weight' => '',
            ),
        ),

        array(
            'id' => 'event_conference_link_color',
            'type' => 'link_color',
            'output' => array('a'),
            'title' => esc_html__('Link Color', 'event_conference'),
            'subtitle' => esc_html__('Controls the color of all text links.', 'event_conference'),
            'default' => ''
        ),
    )
));

// Header font
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Custom Typography', 'event_conference'),
    'id' => 'event_conference_custom_typography',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'event_conference_custom_typography_1',
            'type' => 'typography',
            'title' => esc_html__('Custom 1 Typography', 'event_conference'),
            'subtitle' => esc_html__('These settings control the typography for all Custom 1.', 'event_conference'),
            'google' => true,
            'default' => array(
                'font-size' => '',
                'font-family' => '',
                'font-weight' => '',
                'color' => '',
            ),
        ),

        //selector custom typo 1
        array(
            'id' => 'event_conference_custom_typography_1_selector',
            'type' => 'textarea',
            'title' => esc_html__('Selectors 1', 'event_conference'),
            'desc' => esc_html__('Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'event_conference'),
            'default' => ''
        ),

        array(
            'id' => 'event_conference_custom_typography_2',
            'type' => 'typography',
            'title' => esc_html__('Custom 2 Typography', 'event_conference'),
            'subtitle' => esc_html__('These settings control the typography for all Custom 2.', 'event_conference'),
            'google' => true,
            'default' => array(
                'font-size' => '',
                'font-family' => '',
                'font-weight' => '',
                'color' => '',
            ),
        ),

        //selector custom typo 2
        array(
            'id' => 'event_conference_custom_typography_2_selector',
            'type' => 'textarea',
            'title' => esc_html__('Selectors 2', 'event_conference'),
            'desc' => esc_html__('Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'event_conference'),
            'default' => ''
        ),

        array(
            'id' => 'event_conference_custom_typography_3',
            'type' => 'typography',
            'title' => esc_html__('Custom 3 Typography', 'event_conference'),
            'subtitle' => esc_html__('These settings control the typography for all Custom 3.', 'event_conference'),
            'google' => true,
            'default' => array(
                'font-size' => '',
                'font-family' => '',
                'font-weight' => '',
                'color' => '',
            ),
            'output' => '',
        ),

        //selector custom typo 3
        array(
            'id' => 'event_conference_custom_typography_3_selector',
            'type' => 'textarea',
            'title' => esc_html__('Selectors 3', 'event_conference'),
            'desc' => esc_html__('Import selectors. You can import one or multi selector.Example: #selector1,#selector2,.selector3', 'event_conference'),
            'default' => ''
        ),

    )
));

/* End Typography Options */

/* Start 404 Options */
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('404 Options', 'event_conference'),
    'id' => 'event_conference_404',
    'desc' => esc_html__('404 page all config', 'event_conference'),
    'customizer_width' => '400px',
    'icon' => 'el el-warning-sign',
    'fields' => array(

        array(
            'id' => 'event_conference_404_background',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('404 Background', 'event_conference'),
            'default' => false,
        ),

        array(
            'id' => 'event_conference_404_title',
            'type' => 'text',
            'title' => esc_html__('404 Title', 'event_conference'),
            'default' => esc_html__('Awww...Don’t Cry', 'event_conference'),
        ),

        array(
            'id' => 'event_conference_404_editor',
            'type' => 'editor',
            'title' => esc_html__('404 Content', 'event_conference'),
            'default' => esc_html__("It's just a 404 Error! What you’re looking for may have been misplaced in Long Term Memory.", 'event_conference'),
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => true,
            )
        ),

    )
));
/* End 404 Options */

/* Start Footer Options */
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Footer Options', 'event_conference'),
    'id' => 'event_conference_footer',
    'desc' => esc_html__('Footer all config', 'event_conference'),
    'customizer_width' => '400px',
    'icon' => 'el el-arrow-down'
));

// Footer Content
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Footer content', 'event_conference'),
    'id' => 'event_conference_footer_content',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'event_conference_footer_background',
            'type' => 'background',
            'url' => true,
            'title' => esc_html__('Footer background', 'event_conference' ),
            'default' => false,
            'output'  => '.site-footer__top'
        ),
    )

));

// Footer multi column 1
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Footer multi column 1', 'event_conference'),
    'id' => 'event_conference_footer_multi_column_1',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'event_conference_footer_column_col',
            'type' => 'image_select',
            'title' => esc_html__('Number of Footer Columns', 'event_conference'),
            'subtitle' => esc_html__('Controls the number of columns in the footer', 'event_conference'),
            'default' => 0,
            'options' => array(
                '0' => array(
                    'alt' => 'No Footer',
                    'img' => get_theme_file_uri('/extension/assets/images/no-footer.png')
                ),

                '1' => array(
                    'alt' => '1 Columnn',
                    'img' => get_theme_file_uri('/extension/assets/images/1column.png')
                ),

                '2' => array(
                    'alt' => '2 Columnn',
                    'img' => get_theme_file_uri('/extension/assets/images/2column.png')
                ),
                '3' => array(
                    'alt' => '3 Columnn',
                    'img' => get_theme_file_uri('/extension/assets/images/3column.png')
                ),
                '4' => array(
                    'alt' => '4 Columnn',
                    'img' => get_theme_file_uri('/extension/assets/images/4column.png')
                ),
            ),
        ),

        array(
            'id' => 'event_conference_footer_column_w1',
            'type' => 'slider',
            'title' => esc_html__('Footer width 1', 'event_conference'),
            'subtitle' => esc_html__('Select the number of columns to display in the footer', 'event_conference'),
            'desc' => esc_html__('Min: 1, max: 12, default value: 1', 'event_conference'),
            'default' => 1,
            'min' => 1,
            'step' => 1,
            'max' => 12,
            'display_value' => 'label',
            'required' => array(
                array('event_conference_footer_column_col', 'equals', '1', '2', '3', '4'),
                array('event_conference_footer_column_col', '!=', '0'),
            )
        ),

        array(
            'id' => 'event_conference_footer_column_w2',
            'type' => 'slider',
            'title' => esc_html__('Footer width 2', 'event_conference'),
            'subtitle' => esc_html__('Select the number of columns to display in the footer', 'event_conference'),
            'desc' => esc_html__('Min: 1, max: 12, default value: 1', 'event_conference'),
            'default' => 1,
            'min' => 1,
            'step' => 1,
            'max' => 12,
            'display_value' => 'label',
            'required' => array(
                array('event_conference_footer_column_col', 'equals', '2', '3', '4'),
                array('event_conference_footer_column_col', '!=', '1'),
                array('event_conference_footer_column_col', '!=', '0'),
            )
        ),

        array(
            'id' => 'event_conference_footer_column_w3',
            'type' => 'slider',
            'title' => esc_html__('Footer width 3', 'event_conference'),
            'subtitle' => esc_html__('Select the number of columns to display in the footer', 'event_conference'),
            'desc' => esc_html__('Min: 1, max: 12, default value: 1', 'event_conference'),
            'default' => 1,
            'min' => 1,
            'step' => 1,
            'max' => 12,
            'display_value' => 'label',
            'required' => array(
                array('event_conference_footer_column_col', 'equals', '3', '4'),
                array('event_conference_footer_column_col', '!=', '1'),
                array('event_conference_footer_column_col', '!=', '2'),
                array('event_conference_footer_column_col', '!=', '0'),
            )
        ),

        array(
            'id' => 'event_conference_footer_column_w4',
            'type' => 'slider',
            'title' => esc_html__('Footer width 4', 'event_conference'),
            'subtitle' => esc_html__('Select the number of columns to display in the footer', 'event_conference'),
            'desc' => esc_html__('Min: 1, max: 12, default value: 1', 'event_conference'),
            'default' => 1,
            'min' => 1,
            'step' => 1,
            'max' => 12,
            'display_value' => 'label',
            'required' => array(
                array('event_conference_footer_column_col', 'equals', '4'),
                array('event_conference_footer_column_col', '!=', '1'),
                array('event_conference_footer_column_col', '!=', '2'),
                array('event_conference_footer_column_col', '!=', '3'),
                array('event_conference_footer_column_col', '!=', '0'),
            )
        ),
    )

));

// Footer multi column 2
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Footer multi column 2', 'event_conference'),
    'id' => 'event_conference_footer_multi_column_2',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'event_conference_footer_column_col_2',
            'type' => 'image_select',
            'title' => esc_html__('Number of Footer Columns', 'event_conference'),
            'subtitle' => esc_html__('Controls the number of columns in the footer', 'event_conference'),
            'default' => 0,
            'options' => array(
                '0' => array(
                    'alt' => 'No Footer',
                    'img' => get_theme_file_uri('/extension/assets/images/no-footer.png')
                ),

                '1' => array(
                    'alt' => '1 Columnn',
                    'img' => get_theme_file_uri('/extension/assets/images/1column.png')
                ),

                '2' => array(
                    'alt' => '2 Columnn',
                    'img' => get_theme_file_uri('/extension/assets/images/2column.png')
                ),
                '3' => array(
                    'alt' => '3 Columnn',
                    'img' => get_theme_file_uri('/extension/assets/images/3column.png')
                ),
                '4' => array(
                    'alt' => '4 Columnn',
                    'img' => get_theme_file_uri('/extension/assets/images/4column.png')
                ),
            ),
        ),

        array(
            'id' => 'event_conference_footer_column_w1_2',
            'type' => 'slider',
            'title' => esc_html__('Footer width 1', 'event_conference'),
            'subtitle' => esc_html__('Select the number of columns to display in the footer', 'event_conference'),
            'desc' => esc_html__('Min: 1, max: 12, default value: 1', 'event_conference'),
            'default' => 1,
            'min' => 1,
            'step' => 1,
            'max' => 12,
            'display_value' => 'label',
            'required' => array(
                array('event_conference_footer_column_col_2', 'equals', '1', '2', '3', '4'),
                array('event_conference_footer_column_col_2', '!=', '0'),
            )
        ),

        array(
            'id' => 'event_conference_footer_column_w2_2',
            'type' => 'slider',
            'title' => esc_html__('Footer width 2', 'event_conference'),
            'subtitle' => esc_html__('Select the number of columns to display in the footer', 'event_conference'),
            'desc' => esc_html__('Min: 1, max: 12, default value: 1', 'event_conference'),
            'default' => 1,
            'min' => 1,
            'step' => 1,
            'max' => 12,
            'display_value' => 'label',
            'required' => array(
                array('event_conference_footer_column_col_2', 'equals', '2', '3', '4'),
                array('event_conference_footer_column_col_2', '!=', '1'),
                array('event_conference_footer_column_col_2', '!=', '0'),
            )
        ),

        array(
            'id' => 'event_conference_footer_column_w3_2',
            'type' => 'slider',
            'title' => esc_html__('Footer width 3', 'event_conference'),
            'subtitle' => esc_html__('Select the number of columns to display in the footer', 'event_conference'),
            'desc' => esc_html__('Min: 1, max: 12, default value: 1', 'event_conference'),
            'default' => 1,
            'min' => 1,
            'step' => 1,
            'max' => 12,
            'display_value' => 'label',
            'required' => array(
                array('event_conference_footer_column_col_2', 'equals', '3', '4'),
                array('event_conference_footer_column_col_2', '!=', '1'),
                array('event_conference_footer_column_col_2', '!=', '2'),
                array('event_conference_footer_column_col_2', '!=', '0'),
            )
        ),

        array(
            'id' => 'event_conference_footer_column_w4_2',
            'type' => 'slider',
            'title' => esc_html__('Footer width 4', 'event_conference'),
            'subtitle' => esc_html__('Select the number of columns to display in the footer', 'event_conference'),
            'desc' => esc_html__('Min: 1, max: 12, default value: 1', 'event_conference'),
            'default' => 1,
            'min' => 1,
            'step' => 1,
            'max' => 12,
            'display_value' => 'label',
            'required' => array(
                array('event_conference_footer_column_col_2', 'equals', '4'),
                array('event_conference_footer_column_col_2', '!=', '1'),
                array('event_conference_footer_column_col_2', '!=', '2'),
                array('event_conference_footer_column_col_2', '!=', '3'),
                array('event_conference_footer_column_col_2', '!=', '0'),
            )
        ),
    )

));

// Copyright
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Copyright', 'event_conference'),
    'id' => 'event_conference_footer_copyright',
    'desc' => esc_html__('', 'event_conference'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'event_conference_footer_copyright_editor',
            'type' => 'editor',
            'title' => esc_html__('Enter content copyright', 'event_conference'),
            'full_width' => true,
            'default' => 'Copyright &amp; DiepLK',
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => true,
            )
        ),
    )
));

// Footer logo partner
Redux::setSection($event_conference_opt_name, array(
    'title' => esc_html__('Logo partner', 'event_conference'),
    'id' => 'event_conference_footer_logo_partner',
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'event_conference_logo_partner_image',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Logo partner', 'event_conference'),
            'default' => false,
        ),

    )
));

/* End Footer Options */


/*
 * <--- END SECTIONS
 */

// Function to test the compiler hook and demo CSS output.
add_filter('redux/options/' . $event_conference_opt_name . '/compiler', 'compiler_action', 10, 3);

/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */
if (!function_exists('compiler_action')) {
    function compiler_action($options, $css, $changed_values)
    {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r($changed_values); // Values that have changed since the last save
        echo "</pre>";
        print_r($options); //Option values
        print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }
}
