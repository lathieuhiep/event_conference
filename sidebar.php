
<?php if( is_active_sidebar( 'event_conference-sidebar' ) ): ?>

    <aside class="<?php echo esc_attr( event_conference_col_sidebar() ); ?> site-sidebar">
        <?php dynamic_sidebar( 'event_conference-sidebar' ); ?>
    </aside>

<?php endif; ?>