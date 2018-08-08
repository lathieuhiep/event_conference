<?php
global $event_conference_options;

$event_conference_cat_event_object = get_queried_object();

$event_conference_event_cat_sidebar = !empty( $event_conference_options['event_conference_event_cat_sidebar'] ) ? $event_conference_options['event_conference_event_cat_sidebar'] : 'right';

$event_conference_col_sidebar = event_conference_col_use_sidebar( $event_conference_event_cat_sidebar, 'event_conference-sidebar' );

?>

<div class="site-container site-event-cat">
    <?php get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' ); ?>

    <div class="container">
        <div class="row">
            <?php
            if ( $event_conference_event_cat_sidebar == 'left' ) :
                get_sidebar();
            endif;
            ?>

            <div class="<?php echo esc_attr( $event_conference_col_sidebar ); ?>">
                <?php get_template_part( 'template-parts/event/inc', 'slides-event-cat' ); ?>

                <div class="site-event-cat-content">
                    <h1 class="title-cat text-uppercase">
                        <?php echo esc_html( $event_conference_cat_event_object->name ); ?>
                    </h1>

                    <div class="row site-event-cat-post">
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/event/content', 'event-item' );

                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>

                    <?php event_conference_pagination(); ?>
                </div>
            </div>

            <?php if ( $event_conference_event_cat_sidebar == 'right' ) :
                get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>