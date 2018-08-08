<?php
/**
 * Widget sự kiện mới tổ chức
 */
// Creating the widget
class event_skmtc_widget extends WP_Widget {

    function __construct() {
        parent::__construct(

// Base ID of your widget
            'event_skmtc_widget',

// Widget name will appear in UI
            __('Sự kiện đã tổ chức', 'event_conference'),

// Widget description
            array( 'description' => __( 'Widget sự kiện đã tổ chức', 'event_conference' ), )
        );
    }

// Creating widget front-end

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $event_widget_limit  =   isset( $instance['event_widget_limit'] ) ? $instance['event_widget_limit'] : '5';

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
        ?>
        <div class="event_skmtc_widget">
            <?php
            $args_event_widget = array(
                'post_type'    =>    'event',
                'orderby'    => 'date',
                'order'      => 'DESC',
                'posts_per_page' => $event_widget_limit
            );
            $event_widget_query = new WP_Query( $args_event_widget );
            if($event_widget_query->have_posts() ) :
                ?>
                <ul class="latest-events">
                    <?php
                while( $event_widget_query->have_posts() ) : $event_widget_query->the_post();
            ?>
                <li class="item">
                    <?php the_post_thumbnail(array(200,80)); ?>
                    <div class="item-content">
                        <h4>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                        <span class="date-publish"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?> </span>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Sự Kiện và Hội Nghị Đã Tổ Chức', 'event_conference');
        }
        $event_widget_limit  =   isset( $instance['event_widget_limit'] ) ? $instance['event_widget_limit'] : '5';


// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'event_widget_limit' ); ?>"><?php _e( 'Số bài viết hiển thị:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'event_widget_limit' ); ?>" name="<?php echo $this->get_field_name( 'event_widget_limit' ); ?>" type="text" value="<?php echo esc_attr( $event_widget_limit ); ?>" />
        </p>

        <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['event_widget_limit'] = ( ! empty( $new_instance['event_widget_limit'] ) ) ? strip_tags( $new_instance['event_widget_limit'] ) : '5';
        return $instance;
    }
} // Class wpb_widget ends here
// Register recent posts thumbs widget
function event_skmtc_widget_register_widget() {
    register_widget( 'event_skmtc_widget' );
}
add_action( 'widgets_init', 'event_skmtc_widget_register_widget' );

