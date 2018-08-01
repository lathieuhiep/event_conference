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

    return $event_conference_meta_boxes;

}