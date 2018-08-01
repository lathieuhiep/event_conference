<?php
/**
 * Displays content for front page elementor
 *
 */

while ( have_posts() ) : the_post() ;
?>

    <div <?php post_class('site-page-content') ?>>

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

<?php endwhile; ?>