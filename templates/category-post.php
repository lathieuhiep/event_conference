<?php
/*
 Template Name: Category Post
 */

get_header();

$event_conference_cat_post_use_slides       =   rwmb_meta( 'event_conference_cat_post_use_slides' );
$event_conference_cat_post_select_category  =   get_post_meta( get_the_ID(), 'event_conference_cat_post_select_category', true );
$event_conference_cat_post_limit            =   rwmb_meta( 'event_conference_cat_post_limit' );
$event_conference_cat_post_order_by         =   rwmb_meta( 'event_conference_cat_post_order_by' );
$event_conference_cat_post_order            =   rwmb_meta( 'event_conference_cat_post_order' );
$event_conference_cat_post_sidebar_template =   rwmb_meta( 'event_conference_cat_post_sidebar_template' );

$event_conference_col_sidebar = event_conference_col_use_sidebar( $event_conference_cat_post_sidebar_template, 'event_conference-sidebar' );

$event_conference_paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

if ( !empty( $event_conference_cat_post_select_category ) ) :

    $event_conference_cat_post_arg = array(
        'post_type'         =>  'post',
        'cat'               =>  $event_conference_cat_post_select_category,
        'posts_per_page'    =>  $event_conference_cat_post_limit,
        'paged'             =>  $event_conference_paged,
        'orderby'           =>  $event_conference_cat_post_order_by,
        'order'             =>  $event_conference_cat_post_order,
    );

else:

    $event_conference_cat_post_arg = array(
        'post_type'         =>  'post',
        'posts_per_page'    =>  $event_conference_cat_post_limit,
        'paged'             =>  $event_conference_paged,
        'orderby'           =>  $event_conference_cat_post_order_by,
        'order'             =>  $event_conference_cat_post_order,
    );

endif;

$event_conference_cat_post_query = new WP_Query( $event_conference_cat_post_arg );

?>

<div class="site-container site-cat-post-template">
    <?php get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' ); ?>

    <div class="container">
        <div class="row">
            <?php
            if ( $event_conference_cat_post_sidebar_template == 'left' ) :
                get_sidebar();
            endif;
            ?>

            <div class="<?php echo esc_attr( $event_conference_col_sidebar ) ?>">

                <?php
                if ( $event_conference_cat_post_use_slides == 1 ) :
                    get_template_part( 'template-parts/archive/inc', 'slides-cat-post-template' );
                endif;
                ?>

                <div class="site-cat-post-content">
                    <h1 class="title-cat-global">
                        <?php the_title(); ?>
                    </h1>

                    <div class="row site-event-cat-post">
                        <?php
                        if ( $event_conference_cat_post_query->have_posts() ) :
                            while ( $event_conference_cat_post_query->have_posts() ) :
                                $event_conference_cat_post_query->the_post();

                                get_template_part( 'template-parts/archive/content', 'post-item' );

                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>

                    <?php event_conference_paging_nav_query( $event_conference_cat_post_query ); ?>
                </div>
            </div>

            <?php if ( $event_conference_cat_post_sidebar_template == 'right' ) :
                get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>

<?php

get_footer();