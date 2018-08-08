<?php
global $event_conference_options;
$event_conference_event_related_limit = $event_conference_options['event_conference_event_related_limit'];

$event_conference_term_event_tag = get_the_terms( get_the_ID(), 'event_tag' );

if ( !empty( $event_conference_term_event_tag ) ) :

    $event_conference_term_event_tag_ids = array();

    foreach( $event_conference_term_event_tag as $item_tag ) $event_conference_term_event_tag_ids[] = $item_tag->term_id;

    $event_conference_post_event_related_arg = array(
        'post_type'         =>  'event',
        'post__not_in'      => array( get_the_ID() ),
        'posts_per_page'    =>  $event_conference_event_related_limit,
        'tax_query'         =>  array(
            'relation' => 'AND',

            array(
                'taxonomy'  =>  'event_tag',
                'field'     =>  'id',
                'terms'     =>  $event_conference_term_event_tag_ids
            ),

            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => array( 'post-format-gallery' ),
            ),
        )
    );

    $event_conference_post_event_related_query = new WP_Query( $event_conference_post_event_related_arg );

?>

    <div class="site-single-event-standard__other">
        <div class="event-standard-box">
            <?php
            while ( $event_conference_post_event_related_query->have_posts() ) :
                $event_conference_post_event_related_query->the_post();

                get_template_part( 'template-parts/event/content', 'event-other-related-item' );

            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>

<?php

endif;