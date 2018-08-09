<?php

add_filter( 'rwmb_meta_boxes', 'event_conference_register_meta_boxes' );

function event_conference_register_meta_boxes() {

    /* Start meta box post */
    $event_conference_meta_boxes[] = array(
        'id'         => 'post_format_option',
        'title'      => esc_html__( 'Post Format', 'event_conference' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'id'               => 'event_conference_post_gallery',
                'name'             => 'Gallery',
                'type'             => 'image_advanced',
                'force_delete'     => false,
                'max_status'       => false,
                'image_size'       => 'thumbnail',
            ),

            array(
                'id'            => 'event_conference_post_video',
                'name'          => 'Video Or Audio',
                'type'          => 'oembed',
            ),


        )
    );
    /* End meta box post */

    /* Start meta box post events */
    $event_conference_meta_boxes[] = array(
        'id'         => 'post_event_option',
        'title'      => esc_html__( 'Event Options', 'event_conference' ),
        'post_types' => array( 'event' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(

            array(
                'id'          => 'event_conference_post_event_address',
                'name'        => esc_html__( 'Address', 'event_conference' ),
                'type'        => 'text',
                'placeholder' => esc_html__( 'Address', 'event_conference' ),
                'size'        => 70,
            ),

            array(
                'id'          => 'event_conference_post_event_scale',
                'name'        => esc_html__( 'Scale', 'event_conference' ),
                'type'        => 'text',
                'placeholder' => esc_html__( 'Scale', 'event_conference' ),
                'size'        => 70,
            ),

            array(
                'id'    => 'event_conference_post_event_time',
                'name'  => esc_html__( 'Time', 'event_conference' ),
                'type'  => 'date',
                'js_options' => array(
                    'dateFormat'      => 'dd-mm-yy',
                    'stepMinute'      => 15,
                    'showTimepicker'  => true,
                    'controlType'     => 'select',
                    'showButtonPanel' => false,
                    'oneLine'         => true,
                ),
                'inline'     => false,
                'timestamp'  => false,
            ),

            array(
                'id'               => 'event_conference_post_event_gallery',
                'name'             => 'Gallery',
                'type'             => 'image_advanced',
                'force_delete'     => false,
                'max_status'       => false,
                'image_size'       => 'thumbnail',
            ),

        )
    );
    /* End meta box post events */

    /* Start meta box page*/
    $event_conference_meta_boxes[] = array(
        'id'         => 'page_option_side',
        'title'      => esc_html__( 'Page Option', 'event_conference' ),
        'post_types' => array( 'page' ),
        'context'    => 'side',
        'priority'   => 'low',
        'fields' => array(

            array(
                'name' => esc_html__( 'Position Header', 'event_conference' ),
                'id' => 'event_conference_position_header',
                'type' => 'select',
                'options' => array(
                    1 => 'Relative',
                    2 => 'Absolute',
                ),
            ),

        )
    );
    /* End meta box page */

    /* Start meta box page event cat */
    $event_conference_meta_boxes[] = array(
        'id'            =>  'page_option_event_cat',
        'title'         =>  esc_html__( 'Event Category Options', 'event_conference' ),
        'post_types'    =>  array( 'page' ),
        'context'       =>  'normal',
        'priority'      =>  'low',
        'fields'        =>  array(

            array(
                'name'      =>  esc_html__( 'Use Slides', 'event_conference' ),
                'id'        =>  'event_conference_use_slides_event_cat',
                'type'      =>  'select',
                'options'   =>  array(
                    1   =>  esc_html__( 'Slides Category Event Option', 'event_conference' ),
                    2   =>  esc_html__( 'Custom Slides', 'event_conference' ),
                    3   =>  esc_html__( 'Disabled', 'event_conference' ),
                ),
            ),

            array(
                'id'            =>  'event_conference_slides_event_cat',
                'name'          =>  'Slides',
                'type'          =>  'image_advanced',
                'force_delete'  =>  false,
                'max_status'    =>  false,
                'image_size'    =>  'thumbnail',
            ),

            array(
                'type'  =>  'divider',
            ),

            array(
                'name'          =>  esc_html__( 'Select Event Category', 'event_conference' ),
                'id'            =>  'event_conference_select_event_cat',
                'type'          =>  'taxonomy_advanced',
                'taxonomy'      =>  'event_cat',
                'field_type'    =>  'select_advanced',
            ),

            array(
                'name'      =>  esc_html__( 'Post Format', 'event_conference' ),
                'id'        =>  'event_conference_post_format_event',
                'type'      =>  'select',
                'options'   =>  array(
                    1   =>  esc_html__( 'Standard', 'event_conference' ),
                    2   =>  esc_html__( 'Gallery', 'event_conference' ),
                    3   =>  esc_html__( 'All', 'event_conference' )
                ),
            ),

            array(
                'name'          =>  esc_html__( 'Number of events to show', 'event_conference' ),
                'id'            =>  'event_conference_get_number_event',
                'type'          =>  'number',
                'field_type'    =>  'select_advanced',
                'std'           =>  10,
                'min'           =>  1,
                'step'          =>  1,
            ),

            array(
                'name'      =>  esc_html__( 'Order By', 'event_conference' ),
                'id'        =>  'event_conference_order_by_event',
                'type'      =>  'select',
                'options'   =>  array(
                    'id'    =>  esc_html__( 'Post ID', 'event_conference' ),
                    'title' =>  esc_html__( 'Title', 'event_conference' ),
                    'date'  =>  esc_html__( 'Date', 'event_conference' ),
                    'rand'  =>  esc_html__( 'Random', 'event_conference' ),
                ),
            ),

            array(
                'name'      =>  esc_html__( 'Order', 'event_conference' ),
                'id'        =>  'event_conference_order_event',
                'type'      =>  'select',
                'options'   =>  array(
                    'ASC'   =>  esc_html__( 'Ascending', 'event_conference' ),
                    'DESC'  =>  esc_html__( 'Descending', 'event_conference' ),
                ),
            ),

            array(
                'name'      =>  esc_html__( 'Sidebar', 'event_conference' ),
                'id'        =>  'event_conference_sidebar_event_template',
                'type'      =>  'select',
                'options'   =>  array(
                    'right' =>  esc_html__( 'Right', 'event_conference' ),
                    'left'  =>  esc_html__( 'Left', 'event_conference' ),
                    'hide'  =>  esc_html__( 'Hide', 'event_conference' ),
                ),
            ),

        )
    );
    /* End meta box page event cat */

    /* Start meta box page category post */
    $event_conference_meta_boxes[] = array(
        'id'            =>  'page_option_cat_post',
        'title'         =>  esc_html__( 'Category Post Options', 'event_conference' ),
        'post_types'    =>  array( 'page' ),
        'context'       =>  'normal',
        'priority'      =>  'low',
        'fields'        =>  array(

            array(
                'name'      =>  esc_html__( 'Use Slides', 'event_conference' ),
                'id'        =>  'event_conference_cat_post_use_slides',
                'type'      =>  'select',
                'options'   =>  array(
                    1   =>  esc_html__( 'Yes', 'event_conference' ),
                    0   =>  esc_html__( 'No', 'event_conference' ),
                ),
            ),

            array(
                'id'            =>  'event_conference_cat_post_slides',
                'name'          =>  'Slides',
                'type'          =>  'image_advanced',
                'force_delete'  =>  false,
                'max_status'    =>  false,
                'image_size'    =>  'thumbnail',
            ),

            array(
                'type'  =>  'divider',
            ),

            array(
                'name'          =>  esc_html__( 'Select Category Post', 'event_conference' ),
                'id'            =>  'event_conference_cat_post_select_category',
                'type'          =>  'taxonomy_advanced',
                'taxonomy'      =>  'category',
                'field_type'    =>  'select_advanced',
            ),

            array(
                'name'          =>  esc_html__( 'Number of events to show', 'event_conference' ),
                'id'            =>  'event_conference_cat_post_limit',
                'type'          =>  'number',
                'field_type'    =>  'select_advanced',
                'std'           =>  10,
                'min'           =>  1,
                'step'          =>  1,
            ),

            array(
                'name'      =>  esc_html__( 'Order By', 'event_conference' ),
                'id'        =>  'event_conference_cat_post_order_by',
                'type'      =>  'select',
                'options'   =>  array(
                    'id'    =>  esc_html__( 'Post ID', 'event_conference' ),
                    'title' =>  esc_html__( 'Title', 'event_conference' ),
                    'date'  =>  esc_html__( 'Date', 'event_conference' ),
                    'rand'  =>  esc_html__( 'Random', 'event_conference' ),
                ),
            ),

            array(
                'name'      =>  esc_html__( 'Order', 'event_conference' ),
                'id'        =>  'event_conference_cat_post_order',
                'type'      =>  'select',
                'options'   =>  array(
                    'ASC'   =>  esc_html__( 'Ascending', 'event_conference' ),
                    'DESC'  =>  esc_html__( 'Descending', 'event_conference' ),
                ),
            ),

            array(
                'name'      =>  esc_html__( 'Sidebar', 'event_conference' ),
                'id'        =>  'event_conference_cat_post_sidebar_template',
                'type'      =>  'select',
                'options'   =>  array(
                    'right' =>  esc_html__( 'Right', 'event_conference' ),
                    'left'  =>  esc_html__( 'Left', 'event_conference' ),
                    'hide'  =>  esc_html__( 'Hide', 'event_conference' ),
                ),
            ),

        )
    );
    /* End meta box page event post */

    return $event_conference_meta_boxes;

}