<?php
if ( have_posts() ) :
    while (have_posts() ) :
    the_post();
?>

    <div class="site-single-event-standard__warp">
        <h1 class="title">
            <?php the_title(); ?>
        </h1>

        <div class="site-single-event-standard__content">
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
    </div>

<?php
    endwhile;
endif;
