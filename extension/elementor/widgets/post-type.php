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
        return 'eicon-post';
    }

    public function get_script_depends() {
        return ['lity'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_post_heading',
            [
                'label' =>  esc_html__( 'Title', 'event_conference' )
            ]
        );

        $this->add_control(
            'post_type_title',
            [
                'label'         =>  esc_html__( 'Title', 'event_conference' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Title', 'event_conference' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'post_type_sub_title',
            [
                'label'         =>  esc_html__( 'Sub Title', 'event_conference' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Sub title', 'event_conference' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'post_type_description',
            [
                'label'         =>  esc_html__( 'Description', 'event_conference' ),
                'type'          =>  Controls_Manager::TEXTAREA,
                'default'       =>  esc_html__( 'Item content. Click the edit button to change this text.', 'event_conference' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_post_popup_video',
            [
                'label' =>  esc_html__( 'Popup Video', 'event_conference' )
            ]
        );

        $this->add_control(
            'background_popup_video',
            [
                'label'     =>  esc_html__( 'Background Video', 'event_conference' ),
                'type'      =>  Controls_Manager::MEDIA,
                'default'   =>  [
                    'url'   =>  Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'post_type_link_video',
            [
                'label'         =>  esc_html__( 'Link Video', 'event_conference' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  '//www.youtube.com/watch?v=XSGBVzeBUbk',
                'label_block'   =>  true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_get_post',
            [
                'label' =>  esc_html__( 'Post', 'event_conference' )
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

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__( 'Style Title', 'event_conference' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-post-type__top .heading' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .element-post-type__top .heading:after' => 'background-color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-post-type__top .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_popup_video',
            [
                'label' => esc_html__( 'Style Popup Video', 'event_conference' ),
                'tab' => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .element-post-type__video .element-post-type__video--image' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_post',
            [
                'label' => esc_html__( 'Style Post', 'event_conference' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'height_image_post',
            [
                'label' => esc_html__( 'Height Image Post', 'event_conference' ),
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
                    '{{WRAPPER}} .element-post-type .element-post-type__item--image a' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color_post',
            [
                'label' => esc_html__( 'Title Color Post', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-post-type .element-post-type__item--title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $column_number  =   $settings['post_type__column_number'];
        $cat_post       =   $settings['post_type_select_cat'];
        $limit_post     =   $settings['post_type_limit'];
        $order_by_post  =   $settings['post_type_order_by'];
        $order_post     =   $settings['post_type_order'];

        if ( $column_number == 4 ) :
            $class_column_number = 'col-lg-3';
        elseif ( $column_number == 3 ) :
            $class_column_number = 'col-lg-4';
        elseif ( $column_number == 2 ) :
            $class_column_number = 'col-lg-6';
        else:
            $class_column_number = 'col-lg-12';
        endif;

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

        <div class="element-post-type">
            <div class="row">
                <div class="col-lg-8">
                    <div class="element-post-type__top">
                        <h2 class="heading">
                            <?php echo esc_html( $settings['post_type_title'] ); ?>

                            <span><?php echo esc_html( $settings['post_type_sub_title'] ); ?></span>
                        </h2>

                        <?php if ( $settings['post_type_description'] ) : ?>
                            <p class="description">
                                <?php echo esc_html( $settings['post_type_description'] ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="element-post-type__video">
                        <figure class="element-post-type__video--image">
                            <?php echo wp_get_attachment_image( $settings['background_popup_video']['id'], 'large' ); ?>
                        </figure>

                        <a class="btn-popup-video d-flex  align-items-center justify-content-center" href="<?php echo esc_url( $settings['post_type_link_video'] ) ?>" data-lity>
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php while ( $event_conference_post_type_query->have_posts() ): $event_conference_post_type_query->the_post(); ?>

                    <div class="col-12 col-sm-6 col-md-4 <?php echo esc_attr( $class_column_number ); ?> element-post-type__item">
                        <figure class="element-post-type__item--image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </a>
                        </figure>

                        <h3 class="element-post-type__item--title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                    </div>

                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

    <?php

        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new event_conference_post_type );