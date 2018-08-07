<?php
global $event_conference_options;

$event_conference_event_cat_slides_on_off = $event_conference_options['event_conference_event_cat_slides_on_off'];
$event_conference_event_cat_gallery = $event_conference_options['event_conference_event_cat_gallery'];

if ( $event_conference_event_cat_slides_on_off == 2 && !empty( $event_conference_event_cat_gallery ) ) :

    $event_conference_event_cat_gallery_arr = explode( ",",$event_conference_event_cat_gallery );

    $event_conference_slides_cat_event_settings = [
            'loop'  =>  true,
            'nav'   =>  true,
            'dots'  =>  true
    ];

?>

<div class="site-slides-event-warp">
    <div class="site-slides-event-cat owl-nav-absolute owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $event_conference_slides_cat_event_settings ) ); ?>'>
        <?php foreach( $event_conference_event_cat_gallery_arr as $item ) : ?>

            <div class="site-slides-event-cat__item">
                <?php echo wp_get_attachment_image( $item, 'full' ); ?>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<?php

endif;
