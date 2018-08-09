<?php
/**
 * Widget Recent Posts Thumbs
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class event_conference_recent_posts_widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */

    public function __construct() {

        $event_conference_recent_posts_widget_ops = array(
            'classname'     =>  'recent_posts_thumbs_widget',
            'description'   =>  'Recent Posts Thumbs Widget',
        );

        parent::__construct( 'event_conference_recent_posts_thumbs_widget', 'Basic Theme: Recent Posts Thumbs Widget', $event_conference_recent_posts_widget_ops );

    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) :

            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

        endif;

        $event_conference_recent_posts_limit       =   isset( $instance['number'] ) ? $instance['number'] : 5;
        $event_conference_recent_posts_type_post   =   !empty( $instance['type_post'] ) ? $instance['type_post'] : 'list';
        $event_conference_recent_posts_select_cat  =   !empty( $instance['select_cat'] ) ? $instance['select_cat'] : array( '0' );
        $event_conference_recent_posts_hide_date   =   isset( $instance['hide_date'] ) ? $instance['hide_date'] : false;

        $event_conference_recent_posts_paged = 1;

        if ( in_array( 0, $event_conference_recent_posts_select_cat ) ) :

            $event_conference_recent_posts_args    =   array(
                'post_type'             =>  'post',
                'post_status'           =>  'publish',
                'posts_per_page'        =>  $event_conference_recent_posts_limit,
                'order'                 =>  $instance['order'],
                'orderby'               =>  $instance['order_by'],
                'ignore_sticky_posts'   =>  1,
                'paged'                 =>  $event_conference_recent_posts_paged,
            );

        else:

            $event_conference_recent_posts_args    =   array(
                'post_type'             =>  'post',
                'post_status'           =>  'publish',
                'cat'                   =>  $event_conference_recent_posts_select_cat,
                'posts_per_page'        =>  $event_conference_recent_posts_limit,
                'order'                 =>  $instance['order'],
                'orderby'               =>  $instance['order_by'],
                'ignore_sticky_posts'   =>  1,
                'paged'                 =>  $event_conference_recent_posts_paged,
            );

        endif;

        $event_conference_recent_posts_query   =   new WP_Query( $event_conference_recent_posts_args );

        if ( $event_conference_recent_posts_type_post == 'list' ) :
            $event_conference_recent_post_type = ' recent_posts_thumbs_widget_list';
        elseif ( $event_conference_recent_posts_type_post == 'fist_large_post' ) :
            $event_conference_recent_post_type = ' recent_posts_thumbs_widget_fist_large';
        else:
            $event_conference_recent_post_type = ' recent_posts_thumbs_widget_grid';
        endif;

        if ( $event_conference_recent_posts_query->have_posts() ) :

        ?>

            <div class="recent_posts_thumbs_widget_warp">
                <div class="recent_posts_thumbs_widget<?php echo esc_attr( $event_conference_recent_post_type ) ?>">

                    <?php
                    while ( $event_conference_recent_posts_query->have_posts() ) :
                        $event_conference_recent_posts_query->the_post();
                    ?>

                        <div class="recent_posts_thumbs_widget_item">
                            <div class="recent_posts_thumbs_widget_item--image">
                                <?php
                                if ( has_post_thumbnail() ) :
                                    the_post_thumbnail( 'medium' );
                                else:
                                ?>

                                    <img src="<?php echo esc_url( get_theme_file_uri( '/images/no-image.png' ) ); ?>" alt="<?php the_title(); ?>">

                                <?php endif; ?>
                            </div>

                            <div class="recent_posts_thumbs_widget_item--content">
                                <h3 class="recent_posts_thumbs_widget_item--title">
                                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>

                                <?php if ( $event_conference_recent_posts_hide_date == false ) : ?>

                                    <span class="recent_posts_thumbs_widget_item--meta">
                                        <?php echo get_the_date(); ?>
                                    </span>

                                <?php endif; ?>

                                <?php if ( $event_conference_recent_post_type == 'fist_large_post' && $event_conference_recent_posts_query->current_post == 0 ) : ?>

                                    <div class="recent_posts_thumbs_widget_item--describe">
                                        <?php
                                        if ( has_excerpt() ) :
                                            the_excerpt();
                                        else:
                                        ?>

                                            <p>
                                                <?php echo wp_trim_words( get_the_content(), 20, '...' ); ?>
                                            </p>

                                        <?php endif; ?>
                                    </div>

                                <?php endif; ?>
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
    public function form( $instance ) {

        $defaults = array(
            'title' => 'Recent Post',
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        $number     =   isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $type_post  =   isset( $instance['type_post'] ) ? $instance['type_post'] : 'list';
        $select_cat =   isset( $instance['select_cat'] ) ? $instance['select_cat'] : array( '0' );
        $order      =   isset( $instance['order'] ) ? $instance['order'] : 'ASC';
        $order_by   =   isset( $instance['order_by'] ) ? $instance['order_by'] : 'ID';
        $hide_date  =   isset( $instance['hide_date'] ) ? (bool) $instance['hide_date'] : false;

        $terms = get_terms( array(
            'taxonomy'  =>  'category',
            'orderby'   =>  'id'
        ) );

        ?>

        <!-- Start Title -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'event_conference' ); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        <!-- End Title -->

        <!-- Start Type Post -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'type_post' ) ); ?>">
                <?php esc_attr_e( 'Type post:', 'event_conference' ); ?>
            </label>


            <select id="<?php echo esc_attr( $this->get_field_id( 'type_post' ) ); ?>" name="<?php echo $this->get_field_name('type_post') ?>" class="widefat">
                <option value="list" <?php echo ( $type_post == 'list' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'List', 'event_conference' ); ?>
                </option>

                <option value="fist_large_post" <?php echo ( $type_post == 'fist_large_post' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( '1ST large post', 'event_conference' ); ?>
                </option>

                <option value="grid_post" <?php echo ( $type_post == 'grid_post' ) ? 'selected' : ''; ?>>
                    <?php esc_html_e( 'Grid post', 'event_conference' ); ?>
                </option>
            </select>
        </p>
        <!-- End Type Post -->

        <!-- Start Select Category -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'select_cat' ) ); ?>">
                <?php esc_attr_e( 'Select Category:', 'event_conference' ); ?>
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
        <!-- End Select Category -->

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
        <!-- End Type Get Post -->

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
        <!-- End Type Get Post -->

        <!-- Start Number Post Show -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
                <?php esc_attr_e( 'Number of posts to show:', 'event_conference' ); ?>
            </label>

            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" class="tiny-text" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>
        <!-- End Number Post Show -->

        <!-- Start check hide date -->
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $hide_date ); ?> id="<?php echo $this->get_field_id( 'hide_date' ); ?>" name="<?php echo $this->get_field_name( 'hide_date' ); ?>" />

            <label for="<?php echo $this->get_field_id( 'hide_date' ); ?>">
                <?php esc_html_e( 'Hide post date?', 'event_conference' ); ?>
            </label>
        </p>
        <!-- End check hide date -->

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
        $instance['title']      =   ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['type_post']  =   $new_instance['type_post'];
        $instance['select_cat'] =   $new_instance['select_cat'];
        $instance['order']      =   $new_instance['order'];
        $instance['order_by']   =   $new_instance['order_by'];
        $instance['number']     =   (int) $new_instance['number'];
        $instance['hide_date']  =   isset( $new_instance['hide_date'] ) ? (bool) $new_instance['hide_date'] : false;

        return $instance;

    }
}

// Register widget
function event_conference_recent_posts_register_widget() {
    register_widget( 'event_conference_recent_posts_widget' );
}
add_action( 'widgets_init', 'event_conference_recent_posts_register_widget' );