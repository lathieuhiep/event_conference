<?php
global $event_conference_options;

$event_conference_information_address   =   $event_conference_options['event_conference_information_address'];
$event_conference_information_mail      =   $event_conference_options['event_conference_information_mail'];
$event_conference_information_phone     =   $event_conference_options['event_conference_information_phone'];
?>

<div class="information">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <?php if ( $event_conference_information_address != '' ) : ?>

                    <span>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <?php echo esc_html( $event_conference_information_address ); ?>
                    </span>

                <?php
                endif;

                if ( $event_conference_information_mail != '' ) :
                ?>

                    <span>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <?php echo esc_html( $event_conference_information_mail ); ?>
                    </span>

                <?php
                endif;

                if ( $event_conference_information_phone != '' ) :
                ?>

                    <span>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <?php echo esc_html( $event_conference_information_phone ); ?>
                    </span>

                <?php endif; ?>
            </div>

            <div class="col-md-5">
                <div class="information__social-network social-network-toTopFromBottom d-flex justify-content-end">
                    <?php event_conference_get_social_url(); ?>
                </div>
            </div>
        </div>
    </div>
</div>