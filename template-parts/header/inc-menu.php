<?php
    global $event_conference_options;

    $event_conference_logo_image_id    =   $event_conference_options['event_conference_logo_image']['id'];
    $event_conference_information_show_hide = $event_conference_options['event_conference_information_show_hide'] == '' ? 1 : $event_conference_options['event_conference_information_show_hide'];
?>

<header id="home" class="header">
    <nav id="navigation" class="navbar-expand-lg">

        <?php
        if ( $event_conference_information_show_hide == 1 ) :
            get_template_part( 'template-parts/header/inc', 'information' );
        endif;
        ?>

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
                                'container'      => false,
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