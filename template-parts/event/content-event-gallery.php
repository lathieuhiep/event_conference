<?php
if ( have_posts() ) :
    while (have_posts() ) :
        the_post();

    event_conference_post_view_set( get_the_ID() );

    $event_conference_post_event_address = rwmb_meta( 'event_conference_post_event_address' );
    $event_conference_post_event_scale = rwmb_meta( 'event_conference_post_event_scale' );
    $event_conference_post_event_time = rwmb_meta( 'event_conference_post_event_time' );
    $event_conference_post_event_gallery = get_post_meta( get_the_ID(),'event_conference_post_event_gallery', false );

    $event_conference_slides_settings = [
        'autoplay'  => true,
        'nav'       => true,
        'loop'      => true
    ];

?>

    <div class="site-single-event__main">
        <div class="site-single-event__slides owl-nav-absolute owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $event_conference_slides_settings ) ); ?>'>
            <?php foreach( $event_conference_post_event_gallery as $item ) : ?>

                <div class="site-single-event__slides--item">
                    <?php echo wp_get_attachment_image( $item, 'full' ); ?>
                </div>

            <?php endforeach; ?>
        </div>

        <div class="g-line"></div>
    </div>

    <div class="site-single-event__container">
        <div class="container">
            <div class="info clearfix">
                <div class="info-left pull-left">
                    <h1 class="title">
                        <?php the_title(); ?>
                    </h1>

                    <div class="info-meta">
                        <span class="meta-address">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <?php esc_html_e( 'Địa Điểm:', 'event_conference' ); echo esc_html( $event_conference_post_event_address ); ?>
                        </span>

                        <span class="meta-scale">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <?php esc_html_e( 'Quy mô:', 'event_conference' ); echo esc_html( $event_conference_post_event_scale ); ?>
                        </span>

                        <span class="meta-time">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <?php esc_html_e( 'Thời gian:', 'event_conference' ); echo esc_html( $event_conference_post_event_time ); ?>
                        </span>
                    </div>
                </div>

                <div class="info-right share pull-right"></div>
            </div>

            <div class="site-single-event__gallery">
                <?php foreach( $event_conference_post_event_gallery as $item ) : ?>

                    <div class="site-single-event__gallery--item">
                        <?php echo wp_get_attachment_image( $item, 'medium' ); ?>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php
    endwhile;
endif;
