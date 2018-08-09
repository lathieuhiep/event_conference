<?php

global $event_conference_options;

$event_conference_post_type      =    get_post_type( get_the_ID() );

$event_conference_on_off_share_single = $event_conference_options['event_conference_on_off_share_single'];

?>

<div class="site-post-content">
    <?php if( is_single() ) : ?>

        <h1 class="site-post-title">
            <?php the_title(); ?>
        </h1>

    <?php else: ?>

        <h2 class="site-post-title">
            <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                <?php if ( is_sticky() && is_home() ) : ?>
                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                <?php
                endif;

                the_title();
                ?>
            </a>
        </h2>

    <?php endif; ?>

    <div class="site-post-meta d-flex align-items-center justify-content-between">
        <?php
        if ( $event_conference_on_off_share_single == 1 || $event_conference_on_off_share_single == null ) :
            event_conference_social_network_share();
        endif;
       ?>

        <div class="info-post">
            <span class="site-post-date">
                <i class="fa fa-calendar"></i>
                <?php the_date(); ?>
            </span>

            <span class="site-post-view">
                <i class="fa fa-eye"></i>
                <?php echo esc_html__('Lượt xem: ','event_conference'); ?>
                52742
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

        <?php
        if ( $event_conference_on_off_share_single == 1 || $event_conference_on_off_share_single == null ) :
            event_conference_social_network_share();
        endif;
        ?>

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