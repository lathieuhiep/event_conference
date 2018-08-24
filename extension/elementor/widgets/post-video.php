<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class event_conference_post_video extends Widget_Base {

    public function get_categories() {
        return array( 'event_conference_widgets' );
    }

    public function get_name() {
        return 'event_conference_post_video';
    }

    public function get_title() {
        return esc_html__( 'Post Video Theme', 'event_conference' );
    }

    public function get_icon() {
        return 'eicon-post';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_post_heading',
            [
                'label' =>  esc_html__( 'Title', 'event_conference' )
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         =>  esc_html__( 'Title', 'event_conference' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'VIDEO REVIEWS', 'event_conference' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label'         =>  esc_html__( 'Select Category Post', 'event_conference' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  event_conference_check_get_cat( 'category' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'number_column',
            [
                'label'     =>  esc_html__( 'Column', 'event_conference' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  4,
                'options'   =>  [
                    4   =>  esc_html__( '4 Column', 'event_conference' ),
                    3   =>  esc_html__( '3 Column', 'event_conference' ),
                    2   =>  esc_html__( '2 Column', 'event_conference' ),
                    1   =>  esc_html__( '1 Column', 'event_conference' ),
                ],
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'     =>  esc_html__( 'Number of Posts', 'event_conference' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  4,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'order_by',
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
            'order',
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

        $this->start_controls_section(
            'section_post_pagination',
            [
                'label' =>  esc_html__( 'Pagination', 'event_conference' )
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'         => esc_html__('Pagination', 'event_conference'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'event_conference'),
                'label_off'     => esc_html__('No', 'event_conference'),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_post',
            [
                'label' => esc_html__( 'Style', 'event_conference' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-post-video .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_post_color',
            [
                'label' => esc_html__( 'Title Post Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-post-video__item .title-post' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_play_color',
            [
                'label' => esc_html__( 'Button Play Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-post-video__item .btn-popup-video' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'height_box_video',
            [
                'label' => esc_html__( 'Height Box', 'event_conference' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .element-post-video__item .element-post-video__custom' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $column_number  =   $settings['number_column'];
        $cat_post       =   $settings['select_cat'];
        $limit_post     =   $settings['limit'];
        $order_by_post  =   $settings['order_by'];
        $order_post     =   $settings['order'];

        if ( $column_number == 4 ) :
            $class_column_number = 'col-lg-3';
        elseif ( $column_number == 3 ) :
            $class_column_number = 'col-lg-4';
        elseif ( $column_number == 2 ) :
            $class_column_number = 'col-lg-6';
        else:
            $class_column_number = 'col-lg-12';
        endif;

        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

        if ( !empty( $cat_post ) ) :

            $event_conference_post_video_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post,
                'cat'               =>  $cat_post,
                'paged'             =>  $paged,
                'tax_query'         =>  array(
                    array(
                        'taxonomy' => 'post_format',
                        'field'    => 'slug',
                        'terms'    => array( 'post-format-video' ),
                    ),
                )
            );

        else:

            $event_conference_post_video_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post,
                'paged'             =>  $paged,
                'tax_query'         =>  array(
                    array(
                        'taxonomy' => 'post_format',
                        'field'    => 'slug',
                        'terms'    => array( 'post-format-video' ),
                    ),
                )
            );

        endif;

        $event_conference_post_video_query = new \ WP_Query( $event_conference_post_video_arg );

        if ( $event_conference_post_video_query->have_posts() ) :

        ?>

           <div class="element-post-video">
               <h3 class="title">
                   <?php echo esc_html( $settings['title'] ); ?>
               </h3>

               <div class="row">
                   <?php
                   while ( $event_conference_post_video_query->have_posts() ):
                       $event_conference_post_video_query->the_post();

                       $event_conference_video_post = get_post_meta(  get_the_ID() , 'event_conference_post_video', true );
                   ?>

                        <div class="col-12 col-sm-6 col-md-4 <?php echo esc_attr( $class_column_number ) ?> item">
                            <div class="element-post-video__item">
                                <div class="element-post-video__bk element-post-video__custom">
                                    <?php
                                    if( has_post_thumbnail() ):
                                        the_post_thumbnail( 'large' );
                                    else:
                                    ?>
                                        <img src="<?php echo esc_url( get_theme_file_uri( '/images/no-image.png' ) ); ?>" alt="video">
                                    <?php endif; ?>

                                    <a class="btn-popup-video d-flex align-items-center justify-content-center" href="<?php echo esc_url( $event_conference_video_post ); ?>" data-lity>
                                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <h3 class="title-post">
                                    <?php the_title(); ?>
                                </h3>
                            </div>
                        </div>

                    <?php
                   endwhile;
                   wp_reset_postdata();
                    ?>
               </div>

               <?php
               if ( $settings['pagination'] == 'yes' ) :
                   event_conference_paging_nav_query( $event_conference_post_video_query );
               endif;
               ?>
           </div>

        <?php

        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new event_conference_post_video );