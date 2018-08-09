<?php
/*
 Template Name: Event Category
 */

get_header();

$event_conference_use_slides_event_cat      =   rwmb_meta( 'event_conference_use_slides_event_cat' );

$event_conference_select_event_cat          =   get_post_meta( get_the_ID(), 'event_conference_select_event_cat', true );
$event_conference_post_format_event         =   rwmb_meta( 'event_conference_post_format_event' );
$event_conference_get_number_event          =   rwmb_meta( 'event_conference_get_number_event' );
$event_conference_order_by_event            =   rwmb_meta( 'event_conference_order_by_event' );
$event_conference_order_event               =   rwmb_meta( 'event_conference_order_event' );
$event_conference_sidebar_event_template    =   rwmb_meta( 'event_conference_sidebar_event_template' );

$event_conference_col_sidebar = event_conference_col_use_sidebar( $event_conference_sidebar_event_template, 'event_conference-sidebar' );

if ( $event_conference_post_format_event == 1 ) :

    $event_conference_tax_query_event = array(
        'relation' => 'AND',

        array(
            'taxonomy'  =>  'event_cat',
            'field'     =>  'id',
            'terms'     =>  $event_conference_select_event_cat
        ),

        array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => array( 'post-format-gallery' ),
            'operator' => 'NOT IN',
        ),

    );

elseif ( $event_conference_post_format_event == 2 ) :

    $event_conference_tax_query_event = array(
        'relation' => 'AND',

        array(
            'taxonomy'  =>  'event_cat',
            'field'     =>  'id',
            'terms'     =>  $event_conference_select_event_cat
        ),

        array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => array( 'post-format-gallery' ),
        ),

    );

else:

    $event_conference_tax_query_event = array(

        array(
            'taxonomy'  =>  'event_cat',
            'field'     =>  'id',
            'terms'     =>  $event_conference_select_event_cat
        ),

    );

endif;

$event_conference_paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$event_conference_post_event_arg = array(
    'post_type'         =>  'event',
    'posts_per_page'    =>  $event_conference_get_number_event,
    'paged'             =>  $event_conference_paged,
    'orderby'           =>  $event_conference_order_by_event,
    'order'             =>  $event_conference_order_event,
    'tax_query'         =>  array( $event_conference_tax_query_event )
);

$event_conference_post_event_query = new WP_Query( $event_conference_post_event_arg );
?>

    <div class="site-container site-event-cat">
        <?php get_template_part( 'template-parts/breadcrumb/inc','breadcrumb' ); ?>

        <div class="container">
            <div class="row">
                <?php
                if ( $event_conference_sidebar_event_template == 'left' ) :
                    get_sidebar();
                endif;
                ?>

                <div class="<?php echo esc_attr( $event_conference_col_sidebar ); ?>">
                    <?php
                    if ( $event_conference_use_slides_event_cat != 3 ) :
                        if ( $event_conference_use_slides_event_cat == 1 ) :
                            get_template_part( 'template-parts/event/inc', 'slides-event-cat' );
                        else :
                            get_template_part( 'template-parts/event/inc', 'slides-event-cat-template' );
                        endif;
                    endif;
                    ?>

                    <div class="site-event-cat-content">
                        <h1 class="title-cat-global">
                            <?php the_title(); ?>
                        </h1>

                        <div class="row site-event-cat-post">
                            <?php
                            if ( $event_conference_post_event_query->have_posts() ) :
                                while ( $event_conference_post_event_query->have_posts() ) :
                                    $event_conference_post_event_query->the_post();

                                    get_template_part( 'template-parts/event/content', 'event-item' );

                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>

                        <?php event_conference_paging_nav_query( $event_conference_post_event_query ); ?>
                    </div>
                </div>

                <?php if ( $event_conference_sidebar_event_template == 'right' ) :
                    get_sidebar();
                endif;
                ?>
            </div>
        </div>
    </div>

<?php
get_footer();