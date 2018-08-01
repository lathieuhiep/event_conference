<?php
while (have_posts()) :
    the_post();
?>

    <div id='post-<?php the_ID(); ?>' <?php post_class(); ?>>
        <?php
        get_template_part( 'template-parts/post/content','info' );

        event_conference_post_formats();
        ?>
    </div>

<?php
    endwhile;

wp_reset_postdata();
?>