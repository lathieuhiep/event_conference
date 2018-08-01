<?php

global $event_conference_options;

$event_conference_show_loading = $event_conference_options['event_conference_general_show_loading'] == '' ? '0' : $event_conference_options['event_conference_general_show_loading'];

if(  $event_conference_show_loading == 1 ) :

    $event_conference_loading_url  = $event_conference_options['event_conference_general_image_loading']['url'];
?>

    <div id="site-loadding" class="d-flex align-items-center justify-content-center">

        <?php  if( $event_conference_loading_url !='' ): ?>

            <img class="loading_img" src="<?php echo esc_url( $event_conference_loading_url ); ?>" alt="<?php esc_attr_e('loading...','event_conference') ?>"  >

        <?php else: ?>

            <img class="loading_img" src="<?php echo esc_url(get_theme_file_uri( '/images/loading.gif' )); ?>" alt="<?php esc_attr_e('loading...','event_conference') ?>">

        <?php endif; ?>

    </div>

<?php endif; ?>