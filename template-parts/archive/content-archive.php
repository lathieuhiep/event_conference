<?php
global $event_conference_options;

$event_conference_blog_sidebar_archive = !empty( $event_conference_options['event_conference_blog_sidebar_archive'] ) ? $event_conference_options['event_conference_blog_sidebar_archive'] : 'right';

$event_conference_col_sidebar = event_conference_col_use_sidebar( $event_conference_blog_sidebar_archive, 'event_conference-sidebar' );

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

            <div class="<?php echo esc_attr( $event_conference_col_sidebar ); ?>">
                <div class="site-cat-post-content">
                    <?php
                    if( is_archive() ):
                        $event_conference_cat_object = get_queried_object();
                    ?>

                        <h1 class="title-cat-global">
                            <?php echo esc_html( $event_conference_cat_object->name ); ?>
                        </h1>

                    <?php endif; ?>

                    <div class="row site-event-cat-post">
                        <?php
                        if ( have_posts() ) :

                            while (have_posts()) :
                                the_post();

                                if ( ! is_search() ):
                                    get_template_part( 'template-parts/archive/content', 'archive-post' );
                                else:
                                    get_template_part( 'template-parts/search/content', 'search-post' );
                                endif;

                            endwhile;
                            wp_reset_postdata();

                        else:

                            if ( is_search() ) :
                                get_template_part( 'template-parts/search/content', 'search-no-data' );
                            endif;

                        endif; // end if ( have_posts )
                        ?>
                    </div>
                </div>

                <?php event_conference_pagination(); ?>
            </div>

            <?php if ( $event_conference_blog_sidebar_archive == 'right' ) :
                get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>