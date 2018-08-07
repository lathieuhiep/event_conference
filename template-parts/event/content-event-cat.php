<?php
$event_conference_cat_event_object = get_queried_object();

$event_conference_post_event_arg = array(
    'post_type'         =>  'event',
    'tax_query'         =>  array(
        'relation' => 'AND',

        array(
            'taxonomy'  =>  'event_cat',
            'field'     =>  'id',
            'terms'     =>  $event_conference_cat_event_object->term_id
        ),

        array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => array( 'post-format-gallery' ),
            'operator' => 'NOT IN',
        ),
    )
);

$event_conference_post_event_query = new WP_Query( $event_conference_post_event_arg );

?>

<div class="site-container site-event-cat">
    <?php get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' ); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php get_template_part( 'template-parts/event/inc', 'slides-event-cat' ); ?>

                <div class="site-event-cat-content">
                    <h1 class="title-cat text-uppercase">
                        <?php echo esc_html( $event_conference_cat_event_object->name ); ?>
                    </h1>

                    <div class="row site-event-cat-post">
                        <?php
                        while ( $event_conference_post_event_query->have_posts() ) :
                            $event_conference_post_event_query->the_post();
                        ?>

                            <div class="site-archive-item col-md-6">
                                <figure class="site-archive-item__img">
                                    <a class="link-post" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
                                    <?php the_post_thumbnail( 'large' ); ?>

                                    <figcaption class="site-archive-item__content text-center">
                                        <h3 class="title text-uppercase">
                                            <?php the_title() ?>
                                        </h3>

                                        <?php
                                        if( has_excerpt() ) :
                                            the_excerpt();
                                        else:
                                            ?>
                                            <p>
                                                <?php echo wp_trim_words( get_the_content(), 35, '...' ); ?>
                                            </p>
                                        <?php
                                        endif; ?>
                                    </figcaption>
                                </figure>
                            </div>

                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>