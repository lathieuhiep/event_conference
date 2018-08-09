<?php

$event_conference_cat_post_slides = get_post_meta( get_the_ID(),'event_conference_cat_post_slides', false );

if ( !empty( $event_conference_cat_post_slides ) ) :

    $event_conference_slides_cat_post_settings = [
        'loop'  =>  true,
        'nav'   =>  true,
        'dots'  =>  true
    ];

?>

    <div class="site-slides-event-warp">
        <div class="site-slides-event-cat owl-nav-absolute owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $event_conference_slides_cat_post_settings ) ); ?>'>
            <?php foreach( $event_conference_cat_post_slides as $item ) : ?>

                <div class="site-slides-event-cat__item">
                    <?php echo wp_get_attachment_image( $item, 'full' ); ?>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

<?php
endif;