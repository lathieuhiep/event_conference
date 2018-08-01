<?php
/**
 * Displays content for front page elementor
 *
 */
?>

<div class="container">

    <?php while ( have_posts() ) : the_post(); ?>

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

    <?php if ( comments_open() || get_comments_number() ) : ?>

        <div class="site-comments">
            <?php comments_template(); ?>
        </div>

    <?php
        endif;

    endwhile;
    ?>

</div>