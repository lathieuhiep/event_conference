<?php
/**
 * Widget Name: Post Video Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class event_conference_post_video_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */

    public function __construct() {

        $event_conference_post_video_widget_ops = array(
            'classname'     =>  'event_conference_post_video_widget',
            'description'   =>  esc_html__( 'A widget only show post video', 'event_conference' ),
        );

        parent::__construct( 'event_conference_post_video_widget', 'Event Conference: Post Video', $event_conference_post_video_widget_ops );

    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
	function widget( $args, $instance ) {

        wp_enqueue_script( 'lity' );

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $limit  =   isset( $instance['number'] ) ? $instance['number'] : 4;

        if ( !empty( $instance['cat_post'] ) ) :

            $post_video_arg = array(
                'post_type'         =>  'post',
                'cat'               =>  $instance['cat_post'],
                'posts_per_page'    =>  $limit,
                'orderby'           =>  $instance['order_by'],
                'order'             =>  $instance['order'],
                'tax_query'         =>  array(
                    array(
                        'taxonomy' => 'post_format',
                        'field'    => 'slug',
                        'terms'    => array( 'post-format-video' ),
                    ),
                )
            );

        else:

            $post_video_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit,
                'orderby'           =>  $instance['order_by'],
                'order'             =>  $instance['order'],
                'tax_query'         =>  array(
                    array(
                        'taxonomy' => 'post_format',
                        'field'    => 'slug',
                        'terms'    => array( 'post-format-video' ),
                    ),
                )
            );

        endif;

        $post_video_query = new \ WP_Query( $post_video_arg );

        if ( $post_video_query->have_posts() ) :
    ?>
		
        <div class="video_widget-widget element-post-video">
            <div class="row">
                <?php
                while ( $post_video_query->have_posts() ):
                    $post_video_query->the_post();

                    $event_conference_video_post = get_post_meta(  get_the_ID() , 'event_conference_post_video', true );
                ?>

                    <div class="col-12 col-sm-6 col-md-6 item">
                        <div class="element-post-video__item">
                            <div class="element-post-video__bk">
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
            'title' => 'Video Review',
        );

		$instance = wp_parse_args( (array) $instance, $defaults );

        $number     =   isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
        $order      =   isset( $instance['order'] ) ? $instance['order'] : 'ASC';
        $order_by   =   isset( $instance['order_by'] ) ? $instance['order_by'] : 'ID';

		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_html_e( 'Title:', 'event_conference' ); ?>
            </label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('cat_post') ); ?>">
                <?php esc_html_e('Category','event_conference'); ?>
            </label>

            <?php wp_dropdown_categories( array( 'name' => $this->get_field_name( 'cat_post' ),'show_count' => 1, 'selected' => $instance['cat_post'] ) ); ?>
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

        <!-- Note -->
        <p>
            <?php esc_html_e( 'Note: Only show post video', 'event_conference' ); ?>
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
        $instance['cat_post']   =   $new_instance['cat_post'];
        $instance['order']      =   $new_instance['order'];
        $instance['order_by']   =   $new_instance['order_by'];
        $instance['number']     =   (int) $new_instance['number'];

        return $instance;
    }

}

// Register video_widget widget
function event_conference_video_widget_register_widget() {
    register_widget( 'event_conference_post_video_widget' );
}

add_action( 'widgets_init', 'event_conference_video_widget_register_widget' );