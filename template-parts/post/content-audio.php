<?php

    $event_conference_audio = get_post_meta(  get_the_ID() , '_format_audio_embed', true );
    if( $event_conference_audio != '' ):

?>
        <div class="site-post-audio">

            <?php if( wp_oembed_get( $event_conference_audio ) ) : ?>

                <?php echo wp_oembed_get( $event_conference_audio ); ?>

            <?php else : ?>

                <?php echo balanceTags( $event_conference_audio ); ?>

            <?php endif; ?>

        </div>

<?php endif;?>