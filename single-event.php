<?php
get_header();

global $event_conference_options;
$event_conference_event_single_sidebar = !empty( $event_conference_options['event_conference_event_single_sidebar'] ) ? $event_conference_options['event_conference_event_single_sidebar'] : 'right';

$event_conference_col_sidebar = event_conference_col_use_sidebar( $event_conference_event_single_sidebar, 'event_conference-sidebar' );

?>

<div class="site-single-event <?php echo ( has_post_format( 'gallery' ) ? 'site-single-event-bk' : 'site-container' ); ?>">
    <?php
    if ( !has_post_format( 'gallery' ) ) :

        get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' );

    ?>

        <div class="site-single-event-standard">
            <div class="container">
                <div class="row">
                    <?php
                    if ( $event_conference_event_single_sidebar == 'left' ) :
                        get_sidebar();
                    endif;
                    ?>

                    <div class="<?php echo esc_attr( $event_conference_col_sidebar ); ?>">
                        <?php
                        get_template_part( 'template-parts/event/content', 'event' );

                        get_template_part( 'template-parts/event/inc', 'related-event' );

                        get_template_part( 'template-parts/event/inc', 'other-event' );
                        ?>
                    </div>

                    <?php if ( $event_conference_event_single_sidebar == 'right' ) :
                        get_sidebar();
                    endif;
                    ?>
                </div>
            </div>
        </div>

    <?php
    else:
        get_template_part( 'template-parts/event/content', 'event-gallery' );
    endif;
    ?>
</div>

<?php
get_footer();