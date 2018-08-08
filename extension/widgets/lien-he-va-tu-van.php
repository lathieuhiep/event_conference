<?php
/**
 * Widget liên hệ và tư vấn
 */
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'event_tcsk_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget
class event_tcsk_widget extends WP_Widget {

    function __construct() {
        parent::__construct(

// Base ID of your widget
            'event_tcsk_widget',

// Widget name will appear in UI
            __('Liên hệ & tư vấn', 'event_conference'),

// Widget description
            array( 'description' => __( 'Widget Liên hệ & tư vấn', 'event_conference' ), )
        );
    }

// Creating widget front-end

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $hn_phone  =   isset( $instance['hn_phone'] ) ? $instance['hn_phone'] : '';
        $sk_phone  =   isset( $instance['sk_phone'] ) ? $instance['sk_phone'] : '';
        $tb_phone  =   isset( $instance['tb_phone'] ) ? $instance['tb_phone'] : '';
        $hl_phone  =   isset( $instance['hl_phone'] ) ? $instance['hl_phone'] : '';
        $event_form  =   isset( $instance['event_form'] ) ? $instance['event_form'] : '';

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
        ?>
            <div class="event-widget-tcvsk">
                <div id="main">
                    <div class="group-tabs">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a class="active" href="#lh" aria-controls="home" role="tab" data-toggle="tab"><?php echo esc_html__('Liên hệ trực tiếp','event_conference'); ?></a></li>
                            <li role="presentation"><a href="#tv" aria-controls="profile" role="tab" data-toggle="tab"><?php echo esc_html__('Yêu cầu tư vấn','event_conference'); ?></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active content-lienhe" id="lh">
                                <h3>Tư vấn dịch vụ 24/7</h3>
                                <?php if($hn_phone != ''): ?>
                                <p>Hội nghị: <?php echo esc_html($hn_phone); ?></p>
                                <?php endif; if($sk_phone != ''): ?>
                                <p>Sự kiện: <?php echo esc_html($sk_phone); ?></p>
                                <?php endif; if($tb_phone != ''): ?>
                                <p>Thiết bị: <?php echo esc_html($tb_phone); ?></p>
                                <?php endif; if($hl_phone != ''): ?>
                                <h3>Khiếu nại dịch vụ</h3>
                                <p>Hotline: <?php echo esc_html($hl_phone); ?></p>
                                <?php endif; ?>
                            </div>
                            <div role="tabpanel" class="tab-pane content-tuvan" id="tv">
                            <?php echo do_shortcode( ''.$event_form.'' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
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
            $title = __( 'Không có tiêu đề', 'event_conference');
        }
        $hn_phone  =   isset( $instance['hn_phone'] ) ? $instance['hn_phone'] : '';
        $sk_phone  =   isset( $instance['sk_phone'] ) ? $instance['sk_phone'] : '';
        $tb_phone  =   isset( $instance['tb_phone'] ) ? $instance['tb_phone'] : '';
        $hl_phone  =   isset( $instance['hl_phone'] ) ? $instance['hl_phone'] : '';
        $event_form  =   isset( $instance['event_form'] ) ? $instance['event_form'] : '';


// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <h3>Liên hệ trực tiếp</h3>
        <p>
            <label for="<?php echo $this->get_field_id( 'hn_phone' ); ?>"><?php _e( 'số điện thoại hội nghị:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'hn_phone' ); ?>" name="<?php echo $this->get_field_name( 'hn_phone' ); ?>" type="text" value="<?php echo esc_attr( $hn_phone ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'sk_phone' ); ?>"><?php _e( 'số điện thoại sự kiện:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'sk_phone' ); ?>" name="<?php echo $this->get_field_name( 'sk_phone' ); ?>" type="text" value="<?php echo esc_attr( $sk_phone ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'tb_phone' ); ?>"><?php _e( 'số điện thoại thiết bị:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'tb_phone' ); ?>" name="<?php echo $this->get_field_name( 'tb_phone' ); ?>" type="text" value="<?php echo esc_attr( $tb_phone ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'hl_phone' ); ?>"><?php _e( 'số điện thoại hotline:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'hl_phone' ); ?>" name="<?php echo $this->get_field_name( 'hl_phone' ); ?>" type="text" value="<?php echo esc_attr( $hl_phone ); ?>" />
        </p>
        <h3>Liên hệ trực tiếp</h3>
        <p>
            <label for="<?php echo $this->get_field_id( 'event_form' ); ?>"><?php _e( 'Nhập form contact:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'event_form' ); ?>" name="<?php echo $this->get_field_name( 'event_form' ); ?>" type="text" value="<?php echo esc_attr( $event_form ); ?>" />
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['hn_phone'] = ( ! empty( $new_instance['hn_phone'] ) ) ? strip_tags( $new_instance['hn_phone'] ) : '';
        $instance['sk_phone'] = ( ! empty( $new_instance['sk_phone'] ) ) ? strip_tags( $new_instance['sk_phone'] ) : '';
        $instance['tb_phone'] = ( ! empty( $new_instance['tb_phone'] ) ) ? strip_tags( $new_instance['tb_phone'] ) : '';
        $instance['hl_phone'] = ( ! empty( $new_instance['hl_phone'] ) ) ? strip_tags( $new_instance['hl_phone'] ) : '';
        $instance['event_form'] = ( ! empty( $new_instance['event_form'] ) ) ? strip_tags( $new_instance['event_form'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here