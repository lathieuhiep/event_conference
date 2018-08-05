<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'event_conference_create_events', 10);

function event_conference_create_events() {

    /* Start post type template */
    $labels = array(
        'name'                  =>  _x( 'Events', 'post type general name', 'event_conference' ),
        'singular_name'         =>  _x( 'Events', 'post type singular name', 'event_conference' ),
        'menu_name'             =>  _x( 'Events', 'admin menu', 'event_conference' ),
        'name_admin_bar'        =>  _x( 'All Events', 'add new on admin bar', 'event_conference' ),
        'add_new'               =>  _x( 'Add New', 'Events', 'event_conference' ),
        'add_new_item'          =>  esc_html__( 'Add New Events', 'event_conference' ),
        'edit_item'             =>  esc_html__( 'Edit Events', 'event_conference' ),
        'new_item'              =>  esc_html__( 'New Events', 'event_conference' ),
        'view_item'             =>  esc_html__( 'View Events', 'event_conference' ),
        'all_items'             =>  esc_html__( 'All Events', 'event_conference' ),
        'search_items'          =>  esc_html__( 'Search Events', 'event_conference' ),
        'not_found'             =>  esc_html__( 'No template found', 'event_conference' ),
        'not_found_in_trash'    =>  esc_html__( 'No template found in trash', 'event_conference' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-calendar-alt',
        'rewrite'            => array('slug' => 'event' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'thumbnail' ),
    );

    register_post_type('event', $args );
    /* End post type template */

    /* Start taxonomy template */
    $taxonomy_labels = array(

        'name'              => _x( 'Events categories', 'taxonomy general name', 'event_conference' ),
        'singular_name'     => _x( 'Events category', 'taxonomy singular name', 'event_conference' ),
        'search_items'      => __( 'Search template category', 'event_conference' ),
        'all_items'         => __( 'All Category', 'event_conference' ),
        'parent_item'       => __( 'Parent category', 'event_conference' ),
        'parent_item_colon' => __( 'Parent category:', 'event_conference' ),
        'edit_item'         => __( 'Edit category', 'event_conference' ),
        'update_item'       => __( 'Update category', 'event_conference' ),
        'add_new_item'      => __( 'Add New category', 'event_conference' ),
        'new_item_name'     => __( 'New category Name', 'event_conference' ),
        'menu_name'         => __( 'Categories', 'event_conference' ),

    );

    $taxonomy_args = array(

        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'event-category' ),

    );

    register_taxonomy( 'event_cat', array( 'event' ), $taxonomy_args );
    /* End taxonomy template */

    /* Start tag template */
    $taxonomy_tag_labels = array(
        'name'            =>  _x( 'Events tag', 'taxonomy general name', 'event_conference' ),
        'singular_name'   =>  _x( 'Tag', 'taxonomy singular name', 'event_conference' ),
        'search_items'    =>  esc_html__( 'Search template tag', 'event_conference' ),
        'edit_item'       =>  esc_html__( 'Edit Tag', 'event_conference' ),
        'update_item'     =>  esc_html__( 'Update Tag', 'event_conference' ),
        'add_new_item'    =>  esc_html__( 'Add New Tag', 'event_conference' ),
        'new_item_name'   =>  esc_html__( 'New Tag Name', 'event_conference' ),
        'menu_name'       =>  esc_html__( 'Tag', 'event_conference' ),
    );

    $taxonomy_tag_args = array(
        'hierarchical'      =>  '',
        'labels'            =>  $taxonomy_tag_labels,
        'show_ui'           =>  true,
        'show_admin_column' =>  true,
        "singular_label"    =>  "Events Tag",
        'rewrite'           =>  array( 'slug' => 'event-tag' ),
    );
    register_taxonomy( 'event_tag', array( 'event' ), $taxonomy_tag_args );
    /* End tag template */

}