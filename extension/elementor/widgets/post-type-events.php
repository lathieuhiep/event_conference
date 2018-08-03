<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class event_conference_post_type_events extends Widget_Base {

    public function __construct(array $data = [], array $args = null)
    {
        parent::__construct($data, $args);

        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'admin_enqueue_scripts'] );
    }

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
        return 'fa fa-calendar';
    }

    public function admin_enqueue_scripts() {

        /* Start Element Template js */

        /* End Element Template js */

        $event_conference_events_admin_url  =   admin_url('admin-ajax.php');
        $event_conference_get_events        =   array( 'url' => $event_conference_events_admin_url );
        wp_localize_script( 'event_conference_events_ajax', 'event_conference_load_events', $event_conference_get_events );

        wp_enqueue_script( 'event_conference_events_ajax', get_theme_file_uri( '/js/events-ajax.js' ), array(), '', true );

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
                        'terms'     =>   $cat_post_event[0]
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

            $events_item_count = $event_conference_post_type_events_query->found_posts;

            $total_post_events = wp_count_posts( 'event' )->publish;

            $event_conference_settings =   [
                'column' =>  $column_number,
                'limit' =>  $limit_post,
                'orderby' =>  $order_by_post,
                'order' =>  $order_post
            ];

        ?>

            <div class="element-events" <?php echo ( !empty( $cat_post_event ) ? 'data-settings="'. esc_attr( wp_json_encode( $event_conference_settings ) ) .'"' : '' ); ?>>
                <?php if ( $settings['post_type_events_title'] ) : ?>

                    <h2 class="element-events__title text-center">
                        <?php echo esc_html( $settings['post_type_events_title'] ); ?>
                    </h2>

                <?php endif; ?>

                <?php if ( !empty( $cat_post_event ) ) : ?>

                    <div class="element-events__filter text-center">
                        <?php

                        foreach ( $cat_post_event as $item ) :
                            $term = get_term( $item, 'event_cat' );
                        ?>

                            <span class="element-events__filter--btn<?php echo ( $cat_post_event[0] == $term->term_id ? ' active' : '' ); ?>" data-event-cat="<?php echo esc_attr( $term->term_id ); ?>" data-total-res="<?php echo esc_attr( $term->count ); ?>" data-total-item="<?php echo esc_attr( $term->count ) ?>">
                                <?php echo esc_attr( $term->name ); ?>
                            </span>

                        <?php endforeach; ?>

                        <span class="element-events__filter--btn" data-event-cat="0" data-total-res="<?php echo esc_attr( $total_post_events ); ?>" data-total-item="<?php echo esc_attr( $total_post_events ); ?>">
                            <?php esc_html_e('Tất cả', 'event_conference' ); ?>
                        </span>

                    </div>

                <?php endif; ?>

                <?php if ( !empty( $cat_post_event ) ) : ?>

                    <div class="element-events__pagination top-pagination text-center hide">
                        <span class="element-events__prev" data-prev-page="0">
                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                        </span>
                    </div>

                <?php endif; ?>

                <div class="row element-events__content">
                    <?php
                    while ( $event_conference_post_type_events_query->have_posts() ):
                        $event_conference_post_type_events_query->the_post();

                        $event_conference_post_event_address = rwmb_meta( 'event_conference_post_event_address' );
                        $event_conference_post_event_scale = rwmb_meta( 'event_conference_post_event_scale' );
                        $event_conference_post_event_time = rwmb_meta( 'event_conference_post_event_time' );
                    ?>

                       <div class="col-12 col-sm-6 col-md-4 <?php echo esc_attr( $class_column_number ); ?> col-item">
                           <div class="element-events__item">
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

                                   <div class="element-events__item--box">
                                       <h4 class="title-box text-center">
                                           <span>
                                               <?php esc_html_e( 'Tổ chức sự kiện' ) ?>
                                           </span>
                                       </h4>

                                       <p class="meta-address">
                                           <i class="fa fa-map-marker" aria-hidden="true"></i>
                                           <strong>
                                               <?php esc_html_e( 'Địa Điểm:', 'event_conference' ); ?>
                                           </strong>
                                           <?php echo esc_html( $event_conference_post_event_address ); ?>
                                       </p>

                                       <div class="meta-bottom d-flex justify-content-between align-items-end">
                                           <p class="meta-scale">
                                               <i class="fa fa-users" aria-hidden="true"></i>
                                               <strong>
                                                   <?php esc_html_e( 'Quy mô:', 'event_conference' ); ?>
                                               </strong>
                                               <?php echo esc_html( $event_conference_post_event_scale ); ?>
                                           </p>

                                           <p class="meta-time">
                                               <i class="fa fa-clock-o" aria-hidden="true"></i>
                                               <strong>
                                                   <?php esc_html_e( 'Thời gian:', 'event_conference' ); ?>
                                               </strong>
                                               <?php echo esc_html( $event_conference_post_event_time ); ?>
                                           </p>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

                <?php if ( !empty( $cat_post_event ) ) : ?>

                    <div class="element-events__pagination bottom-pagination text-center<?php echo ( $events_item_count <= $limit_post ? esc_attr( ' hide' ) : '' ); ?>">
                        <p>
                            <?php esc_html_e( 'Xem thêm tin khác', 'event_conference' ); ?>
                        </p>

                        <span class="element-events__next" data-next-page="2">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </div>

                <?php endif; ?>
            </div>

        <?php

        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new event_conference_post_type_events );