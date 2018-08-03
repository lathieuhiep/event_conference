/**
 * Element events js v1.0.0
 * Copyright 2018-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let element_events_filter_btn   =   $( '.element-events__filter--btn' ),
        element_events_content  =   $( '.element-events__content' ),
        element_events_prev     =   $( '.element-events__prev' ),
        element_events_next     =   $( '.element-events__next' );

    $( document ).ready( function () {

        button_filter_events();

        prev_post_events();

        next_post_events();

    });

    function button_filter_events() {

        element_events_filter_btn.on( 'click', function () {

            let has_active = $(this).hasClass( 'active' );

            if ( has_active === false ) {

                let data_total_res = $(this).data( 'total-res' );

                $(this).data( 'total-item', data_total_res );
                $(this).parent().find('.element-events__filter--btn').removeClass( 'active' );
                $(this).addClass( 'active' );
                element_events_prev.data( 'prev-page', 0 );
                element_events_next.data( 'next-page', 2 );

                let data_settings      =   $(this).parents('.element-events').data( 'settings' ),
                    data_event_cat_id  =   parseInt( $(this).data( 'event-cat' ) ),
                    data_column        =   parseInt( data_settings['column'] ),
                    data_limit         =   parseInt( data_settings['limit'] ),
                    data_orderby       =   data_settings['orderby'],
                    data_order         =   data_settings['order'];

                $.ajax({

                    url: event_conference_load_events.url,
                    type: 'POST',
                    data: ({

                        action: 'event_conference_get_ajax_events_item',
                        event_column: data_column,
                        event_cat_id: data_event_cat_id,
                        event_limit: data_limit,
                        event_orderby: data_orderby,
                        event_order: data_order

                    }),

                    beforeSend: function () {

                        element_events_content.addClass( 'events-opacity' );

                    },

                    success: function( data ){

                        if ( data ){

                            element_events_content.empty().append( data );
                            element_events_content.removeClass( 'events-opacity' );

                        }

                        element_events_prev.parent().addClass('hide');

                        if ( data_total_res > data_limit ) {
                            element_events_next.parent().removeClass('hide');
                        }else {
                            element_events_next.parent().addClass('hide');
                        }

                    }

                });

            }

        } )

    }

    function prev_post_events() {

        element_events_prev.on( 'click', function () {

            let data_settings      =   $(this).parents('.element-events').data( 'settings' ),
                event_prev_item    =   parseInt( $(this).data( 'prev-page' ) ),
                event_next_item    =   parseInt( $(this).parents('.element-events').find( '.element-events__next' ).data( 'next-page' ) ),
                data_event_cat_id  =   parseInt( $(this).parents('.element-events').find( '.element-events__filter--btn.active' ).data( 'event-cat' ) ),
                data_total_item    =   parseInt( $(this).parents('.element-events').find( '.element-events__filter--btn.active' ).data( 'total-item' ) ),
                data_column        =   parseInt( data_settings['column'] ),
                data_limit         =   parseInt( data_settings['limit'] ),
                data_orderby       =   data_settings['orderby'],
                data_order         =   data_settings['order'];

            $.ajax({

                url: event_conference_load_events.url,
                type: 'POST',
                data: ({

                    action: 'event_conference_get_ajax_events_item',
                    event_next_prev: event_prev_item,
                    event_column: data_column,
                    event_cat_id: data_event_cat_id,
                    event_limit: data_limit,
                    event_orderby: data_orderby,
                    event_order: data_order

                }),

                beforeSend: function () {

                    element_events_content.addClass( 'events-opacity' );

                },

                success: function( data ){

                    if ( data ){

                        element_events_content.empty().append( data );
                        element_events_content.removeClass( 'events-opacity' );

                    }

                    let data_total_item_new =   data_total_item + data_limit,
                        event_prev_item_new =   event_prev_item - 1,
                        event_next_item_new =   event_next_item - 1;

                    element_events_prev.parents('.element-events').find( '.element-events__filter--btn.active' ).data( 'total-item', data_total_item_new );
                    element_events_prev.data( 'prev-page', event_prev_item_new );
                    element_events_next.data( 'next-page', event_next_item_new );

                    if ( event_prev_item_new === 0 ) {
                        element_events_prev.parent().addClass('hide');
                    }

                    if ( data_total_item_new > data_limit ) {
                        element_events_next.parent().removeClass('hide');
                    }

                }

            });

        } );

    }

    function next_post_events() {

        element_events_next.on( 'click', function () {

            let data_settings      =   $(this).parents('.element-events').data( 'settings' ),
                event_next_item    =   parseInt( $(this).data( 'next-page' ) ),
                event_prev_item    =   parseInt( $(this).parents('.element-events').find( '.element-events__prev' ).data( 'prev-page' ) ),
                data_event_cat_id  =   parseInt( $(this).parents('.element-events').find( '.element-events__filter--btn.active' ).data( 'event-cat' ) ),
                data_total_item    =   parseInt( $(this).parents('.element-events').find( '.element-events__filter--btn.active' ).data( 'total-item' ) ),
                data_count_item    =   parseInt( data_settings['total_item'] ),
                data_column        =   parseInt( data_settings['column'] ),
                data_limit         =   parseInt( data_settings['limit'] ),
                data_orderby       =   data_settings['orderby'],
                data_order         =   data_settings['order'];

            $.ajax({

                url: event_conference_load_events.url,
                type: 'POST',
                data: ({

                    action: 'event_conference_get_ajax_events_item',
                    event_next_prev: event_next_item,
                    event_column: data_column,
                    event_cat_id: data_event_cat_id,
                    event_limit: data_limit,
                    event_orderby: data_orderby,
                    event_order: data_order

                }),

                beforeSend: function () {

                    element_events_content.addClass( 'events-opacity' );

                },

                success: function( data ){

                    if ( data ){

                        element_events_content.empty().append( data );
                        element_events_content.removeClass( 'events-opacity' );

                    }

                    let data_total_item_new =   data_total_item - data_limit,
                        event_prev_item_new =   event_prev_item + 1,
                        event_next_item_new =   event_next_item + 1;

                    element_events_next.parents('.element-events').find( '.element-events__filter--btn.active' ).data( 'total-item', data_total_item_new );
                    element_events_prev.data( 'prev-page', event_prev_item_new );
                    element_events_next.data( 'next-page', event_next_item_new );

                    if ( event_prev_item_new === 1 ) {
                        element_events_prev.parent().removeClass( 'hide' );
                    }
                    if ( data_total_item_new <= data_limit ) {
                        element_events_next.parent().addClass( 'hide' );
                    }

                }

            });

        } );

    }

} )( jQuery );

