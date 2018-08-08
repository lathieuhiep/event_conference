<?php

global $event_conference_options;

$event_conference_post_type      =    get_post_type( get_the_ID() );
$event_conference_comment_count  =    wp_count_comments( get_the_ID() );

$event_conference_on_off_share_single = $event_conference_options['event_conference_on_off_share_single'];

?>

<div class="site-post-content">
    <h2 class="site-post-title">
        <?php
        if( is_single() ) :
            the_title();
        else :
            ?>
            <a href="<?php the_permalink();?>">
                <?php if ( is_sticky() && is_home() ) : ?>
                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                <?php
                endif;

                the_title();
                ?>
            </a>

        <?php endif; ?>
    </h2>

    <div class="site-post-meta">

        <?php if ( $event_conference_on_off_share_single == 1 || $event_conference_on_off_share_single == null ) : ?>
            <div class="site-post-share">

                <!-- Facebook Button -->
                <a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                    <i class="fa fa-facebook"></i>
                </a>

                <a class="twitter" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php print event_conference_social_title( get_the_title() ); ?>%20-%20<?php the_permalink(); ?>">
                    <i class="fa fa-twitter"></i>
                </a>

                <a class="google" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
                    <i class="fa fa-google-plus"></i>
                </a>
            </div>
        <?php endif; ?>
        <div class="info-post">
                    <span class="site-post-date">
            <i class="fa fa-calendar"></i> <?php the_date(); ?>
        </span>

            <span class="site-post-view">
            <i class="fa fa-eye"></i><?php echo esc_html__('Lượt xem: ','event_conference'); ?>52742
        </span>
        </div>

    </div>

    <?php if( is_single() ) : ?>

        <div class="site-post-excerpt">
            <?php
            the_content();

            wp_link_pages( array(
                'before'      => '<div class="page-links">' . __( 'Pages:', 'event_conference' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ) );

            ?>
        </div>
        <?php if ( $event_conference_on_off_share_single == 1 || $event_conference_on_off_share_single == null ) : ?>
            <div class="site-post-share">

                <!-- Facebook Button -->
                <a class="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                    <i class="fa fa-facebook"></i>
                </a>

                <a class="twitter" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php print event_conference_social_title( get_the_title() ); ?>%20-%20<?php the_permalink(); ?>">
                    <i class="fa fa-twitter"></i>
                </a>

                <a class="google" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
                    <i class="fa fa-google-plus"></i>
                </a>
            </div>
        <?php endif; ?>

    <?php

    else :

        if ( $event_conference_post_type != 'page' ) :
            ?>

            <div class="site-post-excerpt">

                <?php

                if( ! has_excerpt()):

                    the_content();

                else:

                    the_excerpt();
                    ?>
                    <a href="<?php the_permalink();?>" class="tzreadmore">
                        <?php echo esc_html__('Read more','event_conference');?>
                    </a>

                <?php

                endif;

                wp_link_pages( array(
                    'before'      => '<div class="page-links">' . __( 'Pages:', 'event_conference' ),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ) );

                ?>

            </div>

        <?php

        endif;
    endif;

    ?>

</div>