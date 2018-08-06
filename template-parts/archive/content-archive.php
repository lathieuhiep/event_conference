<?php

global $event_conference_options;

$event_conference_blog_sidebar_archive = !empty( $event_conference_options['event_conference_blog_sidebar_archive'] ) ? $event_conference_options['event_conference_blog_sidebar_archive'] : 'right';

if ( ( $event_conference_blog_sidebar_archive == 'left' || $event_conference_blog_sidebar_archive == 'right' ) && is_active_sidebar( 'event_conference-sidebar' ) ):

    $event_conference_col_class_blog = 'col-md-9';

else:

    $event_conference_col_class_blog = 'col-md-12';

endif;

?>

<div class="site-container site-blog">
    <?php get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' ); ?>

    <div class="container">
        <div class="row">
            <?php
            if ( $event_conference_blog_sidebar_archive == 'left' ) :
                get_sidebar();
            endif;
            ?>

            <div class="<?php echo esc_attr( $event_conference_col_class_blog ); ?>">
                <div class="row">
                    <?php
                    if ( have_posts() ) :

                        if ( ! is_search() ):
                            get_template_part( 'template-parts/archive/content', 'archive-post' );
                        else:
                            get_template_part( 'template-parts/search/content', 'search-post' );
                        endif;

                        event_conference_pagination();

                    else:

                        if ( is_search() ) :
                            get_template_part( 'template-parts/search/content', 'search-no-data' );
                        endif;

                    endif; // end if ( have_posts )
                    ?>
                </div>
            </div>

            <?php if ( $event_conference_blog_sidebar_archive == 'right' ) :
                get_sidebar();
            endif;
            ?>

        </div>
    </div>
</div>