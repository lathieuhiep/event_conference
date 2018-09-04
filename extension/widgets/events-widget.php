<?php
/**
 * Widget Name: Events Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class event_conference_events_widget extends WP_Widget {

    /**
     * Widget setup.
     */

    public function __construct() {

        $widget_ops = array(
            'classname'     =>  'event_conference_events_widget',
            'description'   =>  esc_html__( 'A widget show post events', 'event_conference' ),
        );

        parent::__construct( 'event_conference_events_widget', 'Event Conference: Events', $widget_ops );

    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    function widget( $args, $instance ) {

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $limit          =   isset( $instance['number'] ) ? $instance['number'] : 5;
        $cat_event_ids  =   !empty( $instance['select_cat'] ) ? $instance['select_cat'] : array( '0' );

        if ( in_array( 0, $cat_event_ids ) ) :

            $events_arg = array(
                'post_type'         =>  'event',
                'posts_per_page'    =>  $limit,
                'orderby'           =>  $instance['order_by'],
                'order'             =>  $instance['order'],
            );

        else:

            $events_arg = array(
                'post_type'         =>  'event',
                'posts_per_page'    =>  $limit,
                'orderby'           =>  $instance['order_by'],
                'order'             =>  $instance['order'],
                'tax_query'         =>  array(
                    array(
                        'taxonomy'  =>  'event_cat',
                        'field'     =>  'id',
                        'terms'     =>  $cat_event_ids
                    ),
                )
            );

        endif;

        $events_query   =   new WP_Query( $events_arg );

        if ( $events_query->have_posts() ) :
        ?>

            <div class="events_widget_warp">
                <?php
                while ( $events_query->have_posts() ) :
                    $events_query->the_post();
                ?>

                    <div class="events_widget__item d-flex">
                        <div class="item-image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"></a>

                            <?php
                            if( has_post_thumbnail() ):
                                the_post_thumbnail( 'medium' );
                            else:
                            ?>
                                <img src="<?php echo esc_url( get_theme_file_uri( '/images/no-image.png' ) ); ?>" alt="events">
                            <?php endif; ?>
                        </div>

                        <div class="item-content">
                            <h4 class="item-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>

                            <p class="item-meta">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?php echo get_the_date(); ?>
                            </p>
                        </div>
                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

        <?php
        endif;

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    function form( $instance ) {

        $defaults = array(
            'title' => 'Events',
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        $number     =   isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $select_cat =   isset( $instance['select_cat'] ) ? $instance['select_cat'] : array( '0' );
        $order      =   isset( $instance['order'] ) ? $instance['order'] : 'ASC';
        $order_by   =   isset( $instance['order_by'] ) ? $instance['order_by'] : 'ID';

        $terms = get_terms( array(
            'taxonomy'  =>  'event_cat',
            'orderby'   =>  'id'
        ) );

        ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_html_e( 'Title:', 'event_conference' ); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <!-- Start Select Event Cat -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'select_cat' ) ); ?>">
                <?php esc_attr_e( 'Select Events Categories:', 'event_conference' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'select_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'select_cat' ) ) . '[]'; ?>" class="widefat" size="10" multiple>

                <option value="0" <?php echo ( in_array( 0, $select_cat ) ? 'selected="selected"' : '' ); ?>>
                    <?php esc_html_e( 'All Category', 'event_conference' ); ?>
                </option>

                <?php
                if ( !empty( $terms ) ) :

                    foreach( $terms as $term_item ) :
                ?>
                    <option value="<?php echo $term_item->term_id; ?>" <?php echo ( in_array( $term_item->term_id, $select_cat ) ? 'selected="selected"' : '' ); ?>>
                        <?php echo esc_html( $term_item->name ) . ' (' . esc_html( $term_item->count ) . ')'; ?>
                    </option>
                <?php
                    endforeach;

                endif;
                ?>

            </select>
        </p>

        <!-- Start Order -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
                <?php esc_attr_e( 'Order:', 'event_conference' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo $this->get_field_name('order') ?>" class="widefat">
                <option value="ASC" <?php echo ( $order == 'ASC' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'ASC', 'event_conference' ); ?>
                </option>

                <option value="DESC" <?php echo ( $order == 'DESC' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'DESC', 'event_conference' ); ?>
                </option>
            </select>
        </p>

        <!-- Start OrderBy -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>">
                <?php esc_attr_e( 'Order:', 'event_conference' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>" name="<?php echo $this->get_field_name('order_by') ?>" class="widefat">
                <option value="ID" <?php echo ( $order_by == 'ID' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'ID', 'event_conference' ); ?>
                </option>

                <option value="date" <?php echo ( $order_by == 'date' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Date', 'event_conference' ); ?>
                </option>

                <option value="title" <?php echo ( $order_by == 'title' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Title', 'event_conference' ); ?>
                </option>

                <option value="rand" <?php echo ( $order_by == 'rand' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Rand', 'event_conference' ); ?>
                </option>
            </select>
        </p>

        <!-- Start Number Post Show -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
                <?php esc_attr_e( 'Number of posts to show:', 'event_conference' ); ?>
            </label>

            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" class="tiny-text" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>

        <?php

    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title']      =   strip_tags( $new_instance['title'] );
        $instance['select_cat'] =   $new_instance['select_cat'];
        $instance['order']      =   $new_instance['order'];
        $instance['order_by']   =   $new_instance['order_by'];
        $instance['number']     =   (int) $new_instance['number'];

        return $instance;
    }

}

// Register widget
function event_conference_events_widget_register_widget() {
    register_widget( 'event_conference_events_widget' );
}

add_action( 'widgets_init', 'event_conference_events_widget_register_widget' );