<?php

$event_conference_video_post = get_post_meta(  get_the_ID() , 'event_conference_post_video', true );

if ( !empty( $event_conference_video_post ) ):

?>

    <div class="site-post-video">
        <?php echo wp_oembed_get( $event_conference_video_post ); ?>
    </div>

<?php
endif;