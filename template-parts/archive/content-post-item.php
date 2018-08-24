<div class="site-archive-item col-12 col-sm-6 col-md-12 col-lg-6">
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

            <?php endif; ?>

        </figcaption>
    </figure>
</div>