<?php

namespace Elementor;

class event_conference_plugin_elementor_widgets {

    /**
     * Plugin constructor.
     */
    public function __construct() {

        $this->event_conference_elementor_add_actions();
    }

    function event_conference_elementor_add_actions() {

        add_action( 'elementor/elements/categories_registered', [ $this, 'event_conference_elementor_widget_categories' ] );

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'event_conference_elementor_widgets_registered' ] );

        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'event_conference_elementor_script'] );

    }

    function event_conference_elementor_widget_categories() {

        Plugin::instance()->elements_manager->add_category(
            'event_conference_widgets',
            [
                'title' => esc_html__( 'Basic theme Widgets', 'event_conference' ),
                'icon'  => 'icon-goes-here'
            ]
        );

    }

    function event_conference_elementor_widgets_registered() {
        foreach(glob( get_parent_theme_file_path( '/extension/elementor/widgets/*.php' ) ) as $file){
            require $file;
        }
    }

    function event_conference_elementor_script() {
        wp_register_script( 'event_conference-elementor-custom', get_theme_file_uri( '/js/elementor-custom.min.js' ), array(), '1.0.0', true );
    }

}

new event_conference_plugin_elementor_widgets();


/* Start get Category check box */
function event_conference_check_get_cat( $type_taxonomy ) {

    $cat_check    =   array();
    $category     =   get_categories( array( 'taxonomy'   =>  $type_taxonomy ) );

    if ( isset( $category ) && !empty( $category ) ):

        foreach( $category as $item ) {

            $cat_check[$item->term_id]  =   $item->name.'('. $item->count .')';

        }

    endif;

    return $cat_check;

}
/* End get Category check box */