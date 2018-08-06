<?php
global $event_conference_options;

$event_conference_footer_column_col_2 = $event_conference_options['event_conference_footer_column_col_2'];
$event_conference_footer_widthl_2 = $event_conference_options['event_conference_footer_column_w1_2'];
$event_conference_footer_width2_2 = $event_conference_options['event_conference_footer_column_w2_2'];
$event_conference_footer_width3_2 = $event_conference_options['event_conference_footer_column_w3_2'];
$event_conference_footer_width4_2 = $event_conference_options['event_conference_footer_column_w4_2'];

?>
<div class="row row-item">
    <?php
    for( $event_conference_i = 0; $event_conference_i < $event_conference_footer_column_col_2; $event_conference_i++ ):

        $event_conference_j = $event_conference_i +1;

        if ( $event_conference_i == 0 ) :
            $event_conference_col = $event_conference_footer_widthl_2;
        elseif ( $event_conference_i == 1 ) :
            $event_conference_col = $event_conference_footer_width2_2;
        elseif ( $event_conference_i == 2 ) :
            $event_conference_col = $event_conference_footer_width3_2;
        else :
            $event_conference_col = $event_conference_footer_width4_2;
        endif;

        if( is_active_sidebar( 'event_conference-footer-'.$event_conference_j.'-2' ) ):
    ?>

            <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( $event_conference_col ); ?>">
                <?php dynamic_sidebar( 'event_conference-footer-'.$event_conference_j.'-2' ); ?>
            </div>

    <?php
        endif;

    endfor;
    ?>
</div>
