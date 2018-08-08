<?php

$event_conference_slides_event_cat = get_post_meta( get_the_ID(),'event_conference_slides_event_cat', false );

if ( !empty( $event_conference_slides_event_cat ) ) :

$event_conference_slides_cat_event_settings = [
    'loop'  =>  true,
    'nav'   =>  true,
    'dots'  =>  true
];

?>

<div class="site-slides-event-warp">
    <div class="site-slides-event-cat owl-nav-absolute owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $event_conference_slides_cat_event_settings ) ); ?>'>
        <?php foreach( $event_conference_slides_event_cat as $item ) : ?>

            <div class="site-slides-event-cat__item">
                <?php echo wp_get_attachment_image( $item, 'full' ); ?>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<?php
endif;