<?php
//Global variable redux
global $event_conference_options;

$event_conference_copyright = $event_conference_options ['event_conference_footer_copyright_editor'] == '' ? 'Copyright &amp; Templaza' : $event_conference_options ['event_conference_footer_copyright_editor'];

?>

<div class="site-footer__bottom">
    <div class="container">
        <div class="site-copyright-menu d-flex align-items-center">
            <div class="site-copyright">
                <?php echo wp_kses_post( $event_conference_copyright ); ?>
            </div>
        </div>
    </div>
</div>