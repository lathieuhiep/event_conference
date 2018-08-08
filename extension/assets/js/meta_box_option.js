( function($) {

    "use strict";

    $( document ).ready( function() {

        /* Start option page */
        let check_template_page     =   $( '#page_template' ),
            check_template_page_val =   check_template_page.val(),
            page_option_normal      =   $( '#page_option_normal' );

        if ( check_template_page_val === 'templates/event-cat.php' ) {
            page_option_normal.slideDown();

        }else {
            page_option_normal.slideUp();
        }

        check_template_page.change( function() {
            let check_template_page_change = $(this).val();

            if ( check_template_page_change === 'templates/event-cat.php' ) {
                page_option_normal.slideDown();
            }else {
                page_option_normal.slideUp();
            }

        });
        /* End option page */


    });

} )( jQuery );