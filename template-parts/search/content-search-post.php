<?php

$event_conference_post_type = get_post_type( get_the_ID() );

if ( $event_conference_post_type != 'page' ) :

    get_template_part( 'template-parts/archive/content', 'archive-post' );

else:

?>

    <div class="site-archive-item col-12 col-sm-6 col-md-6 col-lg-6">
        <figure class="site-archive-item__img">
            <a class="link-post" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>

            <img src="<?php echo esc_url( get_theme_file_uri( '/images/image_page_search.png' ) ) ?>" alt="page">

            <figcaption class="site-archive-item__content text-center">
                <h3 class="title text-uppercase">
                    <?php the_title() ?>
                </h3>
            </figcaption>
        </figure>
    </div>

<?php endif; ?>







