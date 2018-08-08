<?php
global $event_conference_options;

$event_conference_event_support         =   $event_conference_options['event_conference_event_support'];
$event_conference_event_short_code_form =   $event_conference_options['event_conference_event_short_code_form'];

if ( have_posts() ) :
    while (have_posts() ) :
    the_post();

    event_conference_post_view_set( get_the_ID() );
?>

    <div class="site-single-event-standard__warp">
        <h1 class="title">
            <?php the_title(); ?>
        </h1>

        <div class="site-single-event-standard__content">
            <?php
            the_content();

            wp_link_pages( array(
                'before'      => '<div class="page-links">' . __( 'Pages:', 'event_conference' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ) );

            ?>
        </div>

        <div class="site-single-event__support text-center">
            <?php if ( !empty( $event_conference_event_support ) ) : ?>
                <a class="phone-support tel" href="tel:<?php echo esc_attr( $event_conference_event_support ) ?>">
                    <i class="fa fa-phone"></i>
                    <?php esc_html_e( 'Tư vấn miễn phí:', 'event_conference' ); echo '&nbsp;'. esc_html( $event_conference_event_support ); ?>
                </a>
            <?php endif; ?>

            <?php if ( !empty( $event_conference_event_short_code_form ) ) : ?>

                <!-- Button trigger modal -->
                <span class="phone-support get-phone" data-toggle="modal" data-target="#form-modal">
                    <i class="fa fa-fax" aria-hidden="true"></i>
                    <?php esc_html_e( ' Click Để Được Gọi Lại Tư Vấn', 'event_conference' ); ?>
                </span>

                <!-- Modal -->
                <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="modal-title text-center">
                                    <?php esc_html_e( 'Nhập số điện thoại của bạn chúng tôi sẽ gọi lại ngay khi có thể', 'event_conference' ); ?>
                                </h5>

                                <div class="modal-content__form">
                                    <?php echo do_shortcode( $event_conference_event_short_code_form ); ?>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <?php esc_html_e( 'Đóng cửa sổ', 'event_conference' ); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>

<?php
    endwhile;
endif;
