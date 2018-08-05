<?php
global $event_conference_options;

$event_conference_footer_col     =   $event_conference_options['event_conference_footer_column_col'];
$event_conference_footer_widthl  =   $event_conference_options['event_conference_footer_column_w1'];
$event_conference_footer_width2  =   $event_conference_options['event_conference_footer_column_w2'];
$event_conference_footer_width3  =   $event_conference_options['event_conference_footer_column_w3'];
$event_conference_footer_width4  =   $event_conference_options['event_conference_footer_column_w4'];

for( $event_conference_i = 0; $event_conference_i < $event_conference_footer_col; $event_conference_i++ ):

    $event_conference_j = $event_conference_i +1;

    if ( $event_conference_i == 0 ) :
        $event_conference_col = $event_conference_footer_widthl;
    elseif ( $event_conference_i == 1 ) :
        $event_conference_col = $event_conference_footer_width2;
    elseif ( $event_conference_i == 2 ) :
        $event_conference_col = $event_conference_footer_width3;
    else :
        $event_conference_col = $event_conference_footer_width4;
    endif;

    if( is_active_sidebar( 'event_conference-footer-'.$event_conference_j ) ):
?>

        <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( $event_conference_col ); ?>">
            <?php dynamic_sidebar( 'event_conference-footer-'.$event_conference_j ); ?>
        </div>

<?php
    endif;

endfor;