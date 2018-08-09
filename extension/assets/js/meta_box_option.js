( function($) {

    "use strict";

    $( document ).ready( function() {

        /* Start option page */
        let check_template_page     =   $( '#page_template' ),
            check_template_page_val =   check_template_page.val(),
            page_option_cat_post    =   $( '#page_option_cat_post' ),
            page_option_event_cat   =   $( '#page_option_event_cat' );

        if ( check_template_page_val === 'templates/event-cat.php' ) {

            page_option_cat_post.slideUp();
            page_option_event_cat.slideDown();


        } else if ( check_template_page_val === 'templates/category-post.php' ) {

            page_option_cat_post.slideDown();
            page_option_event_cat.slideUp();

        } else {

            page_option_cat_post.slideUp();
            page_option_event_cat.slideUp();

        }

        check_template_page.change( function() {
            let check_template_page_change = $(this).val();

            if ( check_template_page_change === 'templates/event-cat.php' ) {

                page_option_cat_post.slideUp();
                page_option_event_cat.slideDown();

            }else if ( check_template_page_change === 'templates/category-post.php' ) {

                page_option_cat_post.slideDown();
                page_option_event_cat.slideUp();

            } else {

                page_option_cat_post.slideUp();
                page_option_event_cat.slideUp();

            }

        });
        /* End option page */


    });

} )( jQuery );