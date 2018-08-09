<?php
/**
 * Widget liên hệ và tư vấn
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class event_tcsk_widget extends WP_Widget {

    public function __construct() {

        $widget_ops = array(
            'classname'     =>  'event_tcsk_widget',
            'description'   =>  'Liên hệ & tư vấn',
        );

        parent::__construct( 'event_tcsk_widget', 'Event Conference: Liên hệ & tư vấn', $widget_ops );

    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        $title          =   apply_filters( 'widget_title', $instance['title'] );
        $hn_phone       =   isset( $instance['hn_phone'] ) ? $instance['hn_phone'] : '';
        $sk_phone       =   isset( $instance['sk_phone'] ) ? $instance['sk_phone'] : '';
        $tb_phone       =   isset( $instance['tb_phone'] ) ? $instance['tb_phone'] : '';
        $hl_phone       =   isset( $instance['hl_phone'] ) ? $instance['hl_phone'] : '';
        $event_form     =   isset( $instance['event_form'] ) ? $instance['event_form'] : '';

        echo $args['before_widget'];

        if ( ! empty( $title ) ) :
            echo $args['before_title'] . $title . $args['after_title'];
        endif;

        ?>

            <div class="event-widget-tcvsk">
                <div id="main">
                    <div class="group-tabs">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a class="active" href="#lh" aria-controls="home" role="tab" data-toggle="tab">
                                    <?php esc_html_e( 'Liên hệ trực tiếp','event_conference' ); ?>
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#tv" aria-controls="profile" role="tab" data-toggle="tab">
                                    <?php esc_html_e( 'Yêu cầu tư vấn','event_conference' ); ?>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active content-lienhe" id="lh">
                                <div class="tab-content__item">
                                    <h3>
                                        <?php esc_html_e( 'Tư vấn dịch vụ 24/7', 'event_conference' ); ?>
                                    </h3>

                                    <div class="item-list">
                                        <?php if( $hn_phone != '' ): ?>

                                            <p>
                                                <?php esc_html_e( 'Hội nghị: ', 'event_conference' ); echo esc_html( $hn_phone ); ?>
                                            </p>

                                        <?php
                                        endif;

                                        if( $sk_phone != '' ):
                                        ?>

                                            <p>
                                                <?php esc_html_e( 'Sự kiện:  ', 'event_conference' ); echo esc_html($sk_phone); ?>
                                            </p>

                                        <?php
                                        endif;

                                        if( $tb_phone != '' ):
                                        ?>

                                            <p>
                                                <?php esc_html_e( 'Thiết bị: ' ); echo esc_html( $tb_phone ); ?>
                                            </p>

                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="tab-content__item">
                                    <?php if( $hl_phone != '' ): ?>

                                        <h3>
                                            <?php esc_html_e( 'Khiếu nại dịch vụ', 'event_conference' ); ?>
                                        </h3>

                                        <div class="item-list">
                                            <p>
                                                <?php esc_html_e( 'Hotline: ', 'event_conference' ); echo esc_html($hl_phone); ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane content-tuvan" id="tv">
                                <?php echo do_shortcode( $event_form ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {

        $defaults = array(
            'title' => esc_html__( 'Liên hệ và tư vấn', 'event_conference' ),
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        $hn_phone       =   isset( $instance['hn_phone'] ) ? $instance['hn_phone'] : '';
        $sk_phone       =   isset( $instance['sk_phone'] ) ? $instance['sk_phone'] : '';
        $tb_phone       =   isset( $instance['tb_phone'] ) ? $instance['tb_phone'] : '';
        $hl_phone       =   isset( $instance['hl_phone'] ) ? $instance['hl_phone'] : '';
        $event_form     =   isset( $instance['event_form'] ) ? $instance['event_form'] : '';

    ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php esc_html_e( 'Title:', 'event_conference' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <h3>
            <?php esc_html_e( 'Liên hệ trực tiếp', 'event_conference' ); ?>
        </h3>

        <p>
            <label for="<?php echo $this->get_field_id( 'hn_phone' ); ?>">
                <?php esc_html_e( 'số điện thoại hội nghị:', 'event_conference' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'hn_phone' ); ?>" name="<?php echo $this->get_field_name( 'hn_phone' ); ?>" type="text" value="<?php echo esc_attr( $hn_phone ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'sk_phone' ); ?>">
                <?php esc_html_e( 'số điện thoại sự kiện:', 'event_conference' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'sk_phone' ); ?>" name="<?php echo $this->get_field_name( 'sk_phone' ); ?>" type="text" value="<?php echo esc_attr( $sk_phone ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'tb_phone' ); ?>">
                <?php esc_html_e( 'số điện thoại thiết bị:', 'event_conference' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'tb_phone' ); ?>" name="<?php echo $this->get_field_name( 'tb_phone' ); ?>" type="text" value="<?php echo esc_attr( $tb_phone ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'hl_phone' ); ?>">
                <?php esc_html_e( 'số điện thoại hotline:', 'event_conference' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'hl_phone' ); ?>" name="<?php echo $this->get_field_name( 'hl_phone' ); ?>" type="text" value="<?php echo esc_attr( $hl_phone ); ?>" />
        </p>

        <h3>
            <?php esc_html_e( 'Yêu Cầu tư vấn', 'event_conference' ); ?>
        </h3>

        <p>
            <label for="<?php echo $this->get_field_id( 'event_form' ); ?>">
                <?php _e( 'ShortCode Contact form 7:', 'event_conference' ); ?>
            </label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'event_form' ); ?>" name="<?php echo $this->get_field_name( 'event_form' ); ?>" type="text" value="<?php echo esc_attr( $event_form ); ?>" />
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
}

function event_conference_event_tcsk_register_widget() {
    register_widget( 'event_tcsk_widget' );
}
add_action( 'widgets_init', 'event_conference_event_tcsk_register_widget' );