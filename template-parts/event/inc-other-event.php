<?php
global $event_conference_options;
$event_conference_event_other_limit = $event_conference_options['event_conference_event_other_limit'];

$event_conference_term_event_tag = get_the_terms( get_the_ID(), 'event_tag' );

if ( !empty( $event_conference_term_event_tag ) ) :

    $event_conference_term_event_tag_ids = array();

    foreach( $event_conference_term_event_tag as $item_tag ) $event_conference_term_event_tag_ids[] = $item_tag->term_id;

    $event_conference_tax_query = array(
        'relation' => 'AND',

        array(
            'taxonomy'  =>  'event_tag',
            'field'     =>  'id',
            'terms'     =>  $event_conference_term_event_tag_ids,
            'operator'  =>  'NOT IN',
        ),

        array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => array( 'post-format-gallery' ),
        ),
    );

else:

    $event_conference_tax_query = array(
        array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => array( 'post-format-gallery' ),
        ),
    );

endif;

$event_conference_post_other_event_arg = array(
    'post_type'         =>  'event',
    'post__not_in'      => array( get_the_ID() ),
    'posts_per_page'    =>  $event_conference_event_other_limit,
    'tax_query'         =>  array( $event_conference_tax_query )
);

$event_conference_post_other_event_query = new WP_Query( $event_conference_post_other_event_arg );

if ( $event_conference_post_other_event_query->have_posts() ) :

?>

    <div class="site-single-event-standard__other">
        <h3 class="title-other text-uppercase">
            <?php esc_html_e( 'Dự Án Khác', 'event_conference' ); ?>
        </h3>

        <div class="event-standard-box">
            <?php
            while ( $event_conference_post_other_event_query->have_posts() ) :
                $event_conference_post_other_event_query->the_post();

                get_template_part( 'template-parts/event/content', 'event-other-related-item' );

            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>

<?php

endif;