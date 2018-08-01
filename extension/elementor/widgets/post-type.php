<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class event_conference_post_type extends Widget_Base {

    public function get_categories() {
        return array( 'event_conference_widgets' );
    }

    public function get_name() {
        return 'event_conference_post_type';
    }

    public function get_title() {
        return esc_html__( 'Post Type Theme', 'event_conference' );
    }

    public function get_icon() {
        return ' eicon-post';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_post_type',
            [
                'label' =>  esc_html__( 'Post Type', 'event_conference' )
            ]
        );

        $this->add_control(
            'post_type_title',
            [
                'label'         =>  esc_html__( 'Title', 'event_conference' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Post', 'event_conference' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'post_type__column_number',
            [
                'label'     =>  esc_html__( 'Column', 'event_conference' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  3,
                'options'   =>  [
                    4   =>  esc_html__( '4 Column', 'event_conference' ),
                    3   =>  esc_html__( '3 Column', 'event_conference' ),
                    2   =>  esc_html__( '2 Column', 'event_conference' ),
                    1   =>  esc_html__( '1 Column', 'event_conference' ),
                ],
            ]
        );

        $this->add_control(
            'post_type_select_cat',
            [
                'label'         =>  esc_html__( 'Select Category Post', 'event_conference' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  event_conference_check_get_cat( 'category' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'post_type_limit',
            [
                'label'     =>  esc_html__( 'Number of Posts', 'event_conference' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  6,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'post_type_order_by',
            [
                'label'     =>  esc_html__( 'Order By', 'event_conference' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'            =>  esc_html__( 'Post ID', 'event_conference' ),
                    'author'        =>  esc_html__( 'Post Author', 'event_conference' ),
                    'title'         =>  esc_html__( 'Title', 'event_conference' ),
                    'date'          =>  esc_html__( 'Date', 'event_conference' ),
                    'rand'          =>  esc_html__( 'Random', 'event_conference' ),
                    'comment_count' =>  esc_html__( 'Comment count', 'event_conference' ),
                ],
            ]
        );

        $this->add_control(
            'post_type_order',
            [
                'label'     =>  esc_html__( 'Order', 'event_conference' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'ASC',
                'options'   =>  [
                    'ASC'   =>  esc_html__( 'Ascending', 'event_conference' ),
                    'DESC'  =>  esc_html__( 'Descending', 'event_conference' ),
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $cat_post       =   $settings['post_type_select_cat'];
        $limit_post     =   $settings['post_type_limit'];
        $order_by_post  =   $settings['post_type_order_by'];
        $order_post     =   $settings['post_type_order'];

        if ( !empty( $cat_post ) ) :

            $event_conference_post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post,
                'cat'               =>  $cat_post
            );

        else:

            $event_conference_post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post
            );

        endif;

        $event_conference_post_type_query = new \ WP_Query( $event_conference_post_type_arg );

        if ( $event_conference_post_type_query->have_posts() ) :

    ?>

        <div class="elementor-post-type">

            <?php while ( $event_conference_post_type_query->have_posts() ): $event_conference_post_type_query->the_post(); ?>

                <h3>
                    <?php the_title(); ?>
                </h3>

            <?php endwhile; wp_reset_postdata(); ?>

        </div>

    <?php

        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new event_conference_post_type );