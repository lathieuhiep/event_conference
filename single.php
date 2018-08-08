<?php
get_header();

global $event_conference_options;

$event_conference_blog_sidebar_single = !empty( $event_conference_options['event_conference_blog_sidebar_single'] ) ? $event_conference_options['event_conference_blog_sidebar_single'] : 'right';

$event_conference_col_sidebar = event_conference_col_use_sidebar( $event_conference_blog_sidebar_single, 'event_conference-sidebar' );

?>

<div class="site-container site-single">
    <?php get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' ); ?>

    <div class="container">
        <div class="row">
            <?php
            if( $event_conference_blog_sidebar_single == 'left' ):
                get_sidebar();
            endif;
            ?>

            <div class="<?php echo esc_attr( $event_conference_col_sidebar ); ?>">
                <?php

                if ( have_posts() ) : while (have_posts()) : the_post();

                    $event_conference_comment_count  = wp_count_comments( get_the_ID() );

                ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php

                        event_conference_post_formats();

                        get_template_part( 'template-parts/post/content','info' );

                        ?>
                    </div>

                <?php if ( get_the_author_meta( 'description' ) != '' ) : ?>

                    <div class="site-author d-flex">
                            <div class="author-avata">
                                <?php echo get_avatar( get_the_author_meta('ID'),80); ?>
                            </div>
                            <div class="author-info">
                                <h3><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'))?>"><?php the_author();?></a></h3>
                                <p>
                                    <?php the_author_meta('description'); ?>
                                </p>
                            </div>
                        </div>

                <?php
                    endif;

                        if ( comments_open() || get_comments_number() ) :

                ?>

                        <div class="site-comments">
                            <?php comments_template( '', true ); ?>
                        </div>

                <?php
                        endif;

                    endwhile;
                endif;

                ?>

            </div>

            <?php
            if( $event_conference_blog_sidebar_single == 'right' ):
                get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

