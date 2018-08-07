<?php

$event_conference_post_other_event_arg = array(
    'post_type'         =>  'event',
    'posts_per_page'    =>  5,
    'tax_query'         =>  array(
        array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => array( 'post-format-gallery' ),
        ),
    )
);

$event_conference_post_other_event_query = new WP_Query( $event_conference_post_other_event_arg );

if ( $event_conference_post_other_event_query->have_posts() ) :

?>

    <div class="site-single-event-standard__other">
        <h3 class="title-other text-uppercase">
            <?php esc_html_e( 'Dự Án Khác', 'event_conference' ); ?>
        </h3>

        <div class="event-standard-box">
            <?php
            while ( $event_conference_post_other_event_query->have_posts() ) :
                $event_conference_post_other_event_query->the_post();

                $event_conference_post_event_address = rwmb_meta( 'event_conference_post_event_address' );
                $event_conference_post_event_scale = rwmb_meta( 'event_conference_post_event_scale' );
                $event_conference_post_event_time = rwmb_meta( 'event_conference_post_event_time' );

            ?>

                <div class="event-standard-box__item">
                    <div class="row">
                        <div class="col-md-5">
                            <figure class="item-image">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </figure>
                        </div>

                        <div class="col-md-7">
                            <div class="item-info">
                                <h3 class="item-title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>

                                <div class="item-info__meta">
                                    <span>
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>

                                    <span>
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <div class="item-info__meta-event">
                                     <span class="meta-address">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>

                                        <strong>
                                            <?php esc_html_e( 'Địa Điểm:', 'event_conference' ); ?>
                                        </strong>

                                         <?php echo esc_html( $event_conference_post_event_address ); ?>
                                    </span>

                                    <span class="meta-scale">
                                        <i class="fa fa-users" aria-hidden="true"></i>

                                         <strong>
                                            <?php esc_html_e( 'Quy mô:', 'event_conference' ); ?>
                                        </strong>

                                        <?php echo esc_html( $event_conference_post_event_scale ); ?>
                                    </span>

                                    <span class="meta-time">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>

                                         <strong>
                                            <?php esc_html_e( 'Thời gian:', 'event_conference' ); ?>
                                        </strong>

                                        <?php echo esc_html( $event_conference_post_event_time ); ?>
                                    </span>
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
    </div>

<?php

endif;