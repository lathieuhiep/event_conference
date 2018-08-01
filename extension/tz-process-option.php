<?php
    /*
     * Method process option
     * # option 1: config font
     * # option 2: process config theme
    */
    if( !is_admin() ):

        add_action('wp_head','event_conference_config_theme');

        function event_conference_config_theme() {

            if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :

                    global $event_conference_options;
                    $event_conference_favicon = $event_conference_options['event_conference_favicon_upload']['url'];

                    if( $event_conference_favicon != '' ) :

                        echo '<link rel="shortcut icon" href="' . esc_url($event_conference_favicon) . '" type="image/x-icon" />';

                    endif;

            endif;
        }

        // Method add custom css, Css custom add here
        // Inline css add here
        /**
         * Enqueues front-end CSS for the custom css.
         *
         * @since Plazart Theme 1.1
         *
         * @see wp_add_inline_style()
         */

        add_action( 'wp_enqueue_scripts', 'event_conference_custom_css', 99 );

        function event_conference_custom_css() {

            global $event_conference_options;

            $event_conference_typo_selecter_1   =   $event_conference_options['event_conference_custom_typography_1_selector'];

            $event_conference_typo1_font_family   =   $event_conference_options['event_conference_custom_typography_1']['font-family'] == '' ? '' : $event_conference_options['event_conference_custom_typography_1']['font-family'];

            $event_conference_css_style = '';

            if ( $event_conference_typo1_font_family != '' ) :
                $event_conference_css_style .= ' '.esc_attr( $event_conference_typo_selecter_1 ).' { font-family: '.balanceTags( $event_conference_typo1_font_family, true ).' }';
            endif;

            if ( $event_conference_css_style != '' ) :
                wp_add_inline_style( 'event_conference-style', $event_conference_css_style );
            endif;

        }

    endif;
