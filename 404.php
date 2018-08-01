<?php
get_header();

global $event_conference_options;

$event_conference_title = $event_conference_options['event_conference_404_title'];
$event_conference_content = $event_conference_options['event_conference_404_editor'];
$event_conference_background = $event_conference_options['event_conference_404_background']['id'];

?>

<div class="site-error text-center">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <figure class="site-error__image404">
                    <?php
                    if( !empty( $event_conference_background ) ):
                        echo wp_get_attachment_image( $event_conference_background, 'full' );
                    else:
                        echo'<img src="'.esc_url( get_theme_file_uri( '/images/404.jpg' ) ).'" alt="'.get_bloginfo('title').'" />';
                    endif;
                    ?>
                </figure>
            </div>

            <div class="col-md-6">
                <h1 class="site-title-404">
                    <?php
                    if ( $event_conference_title != '' ):
                        echo esc_html( $event_conference_title );
                    else:
                        esc_html_e( 'Awww...Don’t Cry', 'event_conference' );
                    endif;
                    ?>
                </h1>

                <div id="site-error-content">
                    <?php
                    if ( $event_conference_content != '' ) :
                        echo wp_kses_post( $event_conference_content );
                    else:
                    ?>
                        <p>
                            <?php esc_html_e( "It's just a 404 Error!", "event_conference" ); ?>
                            <br />
                            <?php esc_html_e( "What you’re looking for may have been misplaced", "event_conference" ); ?>
                            <br />
                            <?php esc_html_e( "in Long Term Memory.", "event_conference" ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div id="site-error-back-home">
                    <a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_html__('Go to the Home Page', 'event_conference'); ?>">
                        <?php esc_html_e('Go to the Home Page', 'event_conference'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>