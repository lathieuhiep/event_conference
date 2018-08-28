<?php
    global $event_conference_options;

    $event_conference_logo_image_id    =   $event_conference_options['event_conference_logo_image']['id'];

    $event_conference_position_header = rwmb_meta( 'event_conference_position_header' );

    if ( $event_conference_position_header == 2 || ( is_singular( 'event' ) && has_post_format('gallery') ) ) :
        $event_conference_class_position = 'header-absolute';
    else:
        $event_conference_class_position = 'header-relative';
    endif;
?>

<header id="home" class="header <?php echo esc_attr( $event_conference_class_position ); ?>">
    <nav id="navigation" class="header-nav navbar-expand-lg">
        <div class="header-bottom">
            <div class="container">
                <div class="header-bottom_warp d-lg-flex align-items-center justify-content-lg-end">
                    <div class="site-logo">
                        <a href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                            <?php
                                if ( !empty( $event_conference_logo_image_id ) ) :
                                    echo wp_get_attachment_image( $event_conference_logo_image_id, 'full' );
                                else :
                                    echo'<img src="'.esc_url( get_theme_file_uri( '/images/logo.png' ) ).'" alt="'.get_bloginfo('title').'" />';
                                endif;
                            ?>
                        </a>

                        <button class="navbar-toggler" data-toggle="collapse" data-target=".site-menu">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div class="site-menu collapse navbar-collapse d-lg-flex justify-content-lg-end">
                        <?php

                        if ( has_nav_menu('primary') ) :

                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'navbar-nav',
                            ) ) ;

                        else:
                        ?>

                            <ul class="main-menu">
                                <li>
                                    <a href="<?php echo get_admin_url().'/nav-menus.php'; ?>">
                                        <?php esc_html_e( 'ADD TO MENU','event_conference' ); ?>
                                    </a>
                                </li>
                            </ul>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>