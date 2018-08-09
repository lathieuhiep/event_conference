<?php
while (have_posts()) :
    the_post();

        get_template_part( 'template-parts/archive/content', 'post-item' );

    endwhile;

wp_reset_postdata();