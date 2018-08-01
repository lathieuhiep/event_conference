<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class event_conference_post_type_events extends Widget_Base {

    public function get_categories() {
        return array( 'event_conference_widgets' );
    }

    public function get_name() {
        return 'event_conference_post_type_events';
    }

    public function get_title() {
        return esc_html__( 'Post Type Event Theme', 'event_conference' );
    }

    public function get_icon() {
        return ' eicon-post';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_post_type_events',
            [
                'label' =>  esc_html__( 'Post Type', 'event_conference' )
            ]
        );

        $this->add_control(
            'post_type_events_title',
            [
                'label'         =>  esc_html__( 'Title', 'event_conference' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Events', 'event_conference' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'post_type_events_column_number',
            [
                'label'     =>  esc_html__( 'Column', 'event_conference' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  3,
                'options'   =>  [
                    3   =>  esc_html__( '3 Column', 'event_conference' ),
                    4   =>  esc_html__( '4 Column', 'event_conference' ),
                ],
            ]
        );

        $this->add_control(
            'post_type_events_select_cat',
            [
                'label'         =>  esc_html__( 'Select Category Event', 'event_conference' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  event_conference_check_get_cat( 'event_cat' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'post_type_events_limit',
            [
                'label'     =>  esc_html__( 'Number of Events', 'event_conference' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  6,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'post_type_events_order_by',
            [
                'label'     =>  esc_html__( 'Order By', 'event_conference' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'            =>  esc_html__( 'Post ID', 'event_conference' ),
                    'title'         =>  esc_html__( 'Title', 'event_conference' ),
                    'date'          =>  esc_html__( 'Date', 'event_conference' ),
                    'rand'          =>  esc_html__( 'Random', 'event_conference' ),
                ],
            ]
        );

        $this->add_control(
            'post_type_events_order',
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
        $column_number  =   $settings['post_type_events_column_number'];
        $cat_post_event =   $settings['post_type_events_select_cat'];
        $limit_post     =   $settings['post_type_events_limit'];
        $order_by_post  =   $settings['post_type_events_order_by'];
        $order_post     =   $settings['post_type_events_order'];

        if ( $column_number == 4 ) :
            $class_column_number = 'col-lg-3';
        else:
            $class_column_number = 'col-lg-4';
        endif;

        if ( !empty( $cat_post_event ) ) :

            $event_conference_post_type_events_arg = array(
                'post_type'         =>  'event',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post,
                'tax_query'         =>  array(
                    array(
                        'taxonomy'  =>  'event_cat',
                        'field'     =>  'id',
                        'terms'     =>   $cat_post_event
                    )
                )
            );

        else:

            $event_conference_post_type_events_arg = array(
                'post_type'         =>  'event',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post
            );

        endif;

        $event_conference_post_type_events_query = new \ WP_Query( $event_conference_post_type_events_arg );

        if ( $event_conference_post_type_events_query->have_posts() ) :

        ?>

            <div class="element-events">
                <div class="row">
                    <?php while ( $event_conference_post_type_events_query->have_posts() ): $event_conference_post_type_events_query->the_post(); ?>

                       <div class="col-12 col-sm-6 col-md-4 <?php echo esc_attr( $class_column_number ); ?> element-events__item">
                           <figure class="element-events__item--img">
                               <a href="<?php the_permalink(); ?>">
                                   <?php the_post_thumbnail( 'large' ); ?>
                               </a>
                           </figure>

                           <div class="element-events__item--content">
                               <h3 class="element-events__item--title text-center">
                                   <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
                                       <?php the_title(); ?>
                                   </a>
                               </h3>
                           </div>
                       </div>

                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>

        <?php

        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new event_conference_post_type_events );