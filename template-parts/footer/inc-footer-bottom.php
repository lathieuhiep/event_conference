<?php
//Global variable redux
global $event_conference_options;

$event_conference_copyright = $event_conference_options['event_conference_footer_copyright_editor'] == '' ? 'Copyright &amp; Templaza' : $event_conference_options['event_conference_footer_copyright_editor'];

$event_conference_logo_partner_image = $event_conference_options['event_conference_logo_partner_image'];

?>

<div class="site-footer__bottom">
    <div class="container">
        <div class="site-copyright-menu d-md-flex align-items-md-center justify-content-md-between">
            <div class="site-copyright">
                <?php echo wp_kses_post( $event_conference_copyright ); ?>
            </div>

            <?php if ( !empty( $event_conference_logo_partner_image )) : ?>
                <div class="site-logo-partner">
                    <?php echo wp_get_attachment_image( $event_conference_logo_partner_image['id'], 'full' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>