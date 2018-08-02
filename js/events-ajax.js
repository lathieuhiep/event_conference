/**
 * Element events js v1.0.0
 * Copyright 2018-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    $( document ).ready( function () {

        button_filter_events();

    });

    function button_filter_events() {

        let element_events_filter_btn   =   $( '.element-events__filter--btn' ),
            element_events_content      =   $( '.element-events__content' );

        element_events_filter_btn.on( 'click', function () {

            let has_active = $(this).hasClass( 'active' );

            if ( has_active === false ) {

                $(this).parent().find('.element-events__filter--btn').removeClass( 'active' );
                $(this).addClass( 'active' );

                let $data_settings      =   $(this).parents('.element-events').data( 'settings' ),
                    $data_event_cat_id  =   $(this).data( 'event-cat' ),
                    $data_column        =   parseInt( $data_settings['column'] ),
                    $data_limit         =   parseInt( $data_settings['limit'] ),
                    $data_orderby       =   $data_settings['orderby'],
                    $data_order         =   $data_settings['order'];

                $.ajax({

                    url: event_conference_load_events.url,
                    type: 'POST',
                    data: ({

                        action: 'event_conference_get_ajax_events_item',
                        event_column: $data_column,
                        event_cat_id: $data_event_cat_id,
                        event_limit: $data_limit,
                        event_orderby: $data_orderby,
                        event_order: $data_order

                    }),

                    beforeSend: function () {

                        element_events_content.addClass( 'events-opacity' );

                    },

                    success: function( data ){
                        element_events_content.removeClass( 'events-opacity' );

                        if ( data ){

                            element_events_content.empty().append( data ).find( '.col-item' ).addClass( 'popIn' );

                        }

                    }

                });

            }

        } )

    }

} )( jQuery );

