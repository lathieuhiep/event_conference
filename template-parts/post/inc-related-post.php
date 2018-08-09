<?php

$event_conference_term_cat_post = get_the_terms( get_the_ID(), 'category' );

if ( !empty( $event_conference_term_cat_post ) ):

    $event_conference_term_cat_post_ids = array();

    foreach( $event_conference_term_cat_post as $item_cat_post_id ) $event_conference_term_cat_post_ids[] = $item_cat_post_id->term_id;

    $event_conference_post_related_arg = array(
        'post_type'         =>  'post',
        'cat'               =>  $event_conference_term_cat_post_ids,
        'post__not_in'      =>  array( get_the_ID() ),
        'posts_per_page'    =>  4,
    );

    $event_conference_post_related_query = new WP_Query( $event_conference_post_related_arg );

    if ( $event_conference_post_related_query->have_posts() ) :
?>

    <div class="site-single-post-related">
        <h3 class="title text-center">
            <?php esc_html_e( 'Tin tức có thể bạn quan tâm', 'event_conference' ); ?>
        </h3>

        <div class="row">
            <?php
            while ( $event_conference_post_related_query->have_posts() ) :
                $event_conference_post_related_query->the_post();
            ?>

                <div class="col-12 col-sm-6 col-md-4">
                    <figure class="post-image">
                        <?php the_post_thumbnail( 'medium' ); ?>

                        <figcaption>
                            <h4 class="title-post">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                        </figcaption>
                    </figure>
                </div>

            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>

<?php
    endif;
endif;