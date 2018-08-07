<?php
get_header();

?>

<div class="site-single-event <?php echo ( has_post_format( 'gallery' ) ? 'site-single-event-bk' : 'site-container' ); ?>">
    <?php
    if ( !has_post_format( 'gallery' ) ) :

        get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' );

    ?>

        <div class="site-single-event-standard">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <?php
                        get_template_part( 'template-parts/event/content', 'event' );

                        get_template_part( 'template-parts/event/inc', 'related-event' );

                        get_template_part( 'template-parts/event/inc', 'other-event' );
                        ?>
                    </div>

                    <?php get_sidebar(); ?>
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