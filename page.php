<?php
get_header();

$event_conference_check_elementor =   get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

$event_conference_class_elementor =   '';

if ( $event_conference_check_elementor ) :
    $event_conference_class_elementor =   ' site-container-elementor';
endif;

?>

    <main class="site-container<?php echo esc_attr( $event_conference_class_elementor ); ?>">

        <?php
        if ( $event_conference_check_elementor ) :
            get_template_part('template-parts/page/content','page-elementor');
        else:
            get_template_part('template-parts/page/content','page');
        endif;
        ?>

    </main>

<?php 

get_footer();