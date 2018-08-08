<?php
/*
* Start ajax template
*/

add_action( 'wp_ajax_event_conference_get_ajax_events_item', 'event_conference_get_ajax_events_item' );
add_action( 'wp_ajax_nopriv_event_conference_get_ajax_events_item', 'event_conference_get_ajax_events_item' );

function event_conference_get_ajax_events_item() {

    $event_conference_event_next_prev   =   empty( $_POST['event_next_prev'] ) ? 1 : $_POST['event_next_prev'];
    $event_conference_event_column      =   $_POST['event_column'];
    $event_conference_event_cat_id      =   $_POST['event_cat_id'] == 'NaN' ? 0 : $_POST['event_cat_id'];
    $event_conference_event_format      =   $_POST['event_format'];
    $event_conference_limit             =   $_POST['event_limit'];
    $event_conference_orderby           =   $_POST['event_orderby'];
    $event_conference_order             =   $_POST['event_order'];

    if ( $event_conference_event_column == 4 ) :
        $class_column_number = 'col-lg-3';
    else:
        $class_column_number = 'col-lg-4';
    endif;

    if ( $event_conference_event_cat_id != 0 ) :

        if ( $event_conference_event_format == 'gallery' ) :

            $event_conference_tax_query_event = array(
                'relation' => 'AND',

                array(
                    'taxonomy'  =>  'event_cat',
                    'field'     =>  'id',
                    'terms'     =>  $event_conference_event_cat_id
                ),

                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-gallery' ),
                ),

            );

        elseif ( $event_conference_event_format == 'standard' ) :

            $event_conference_tax_query_event = array(
                'relation' => 'AND',

                array(
                    'taxonomy'  =>  'event_cat',
                    'field'     =>  'id',
                    'terms'     =>  $event_conference_event_cat_id
                ),

                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-gallery' ),
                    'operator' => 'NOT IN',
                ),

            );

        else:

            $event_conference_tax_query_event = array(

                array(
                    'taxonomy'  =>  'event_cat',
                    'field'     =>  'id',
                    'terms'     =>   $event_conference_event_cat_id
                )

            );

        endif;

        $event_conference_ajax_events_arg = array(
            'post_type'         =>  'event',
            'posts_per_page'    =>  $event_conference_limit,
            'orderby'           =>  $event_conference_orderby,
            'order'             =>  $event_conference_order,
            'paged'             =>  $event_conference_event_next_prev,
            'tax_query'         =>  array( $event_conference_tax_query_event )
        );

    else:

        if ( $event_conference_event_format == 'gallery' ) :

            $event_conference_tax_query_event = array(
                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-gallery' ),
                ),
            );

        elseif ( $event_conference_event_format == 'standard' ) :

            $event_conference_tax_query_event = array(
                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-gallery' ),
                    'operator' => 'NOT IN',
                ),
            );

        else:

            $event_conference_tax_query_event = '';

        endif;

        $event_conference_ajax_events_arg = array(
            'post_type'         =>  'event',
            'posts_per_page'    =>  $event_conference_limit,
            'orderby'           =>  $event_conference_orderby,
            'order'             =>  $event_conference_order,
            'paged'             =>  $event_conference_event_next_prev,
            'tax_query'         =>  array( $event_conference_tax_query_event )
        );

    endif;

    $event_conference_ajax_events_query = new WP_Query( $event_conference_ajax_events_arg );


    while ( $event_conference_ajax_events_query->have_posts() ):
        $event_conference_ajax_events_query->the_post();

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
                               <?php esc_html_e( 'Tổ chức sự kiện', 'event_conference' ); ?>
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

    exit();
}