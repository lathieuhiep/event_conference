<?php

global $event_conference_options;

if ( has_nav_menu( 'footer-menu' ) ) :

    $event_conference_logo_text_footer = $event_conference_options['event_conference_logo_text_footer'];
?>

<div class="row row-item">
    <div class="col-lg-12">
        <div class="site-footer__menu d-flex align-items-center">
            <div class="site-footer__logo-text">
                <a href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php echo esc_html( $event_conference_logo_text_footer ); ?>
                </a>
            </div>

            <nav>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer-menu',
                    'menu_class' => 'menu-footer',
                ));
                ?>
            </nav>
        </div>
    </div>
</div>

<?php endif;?>
