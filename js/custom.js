/**
 * Custom js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let timer_clear;

    $( document ).ready( function () {

        /* Start back top */
        $('#back-top').on( 'click', function (e) {

            e.preventDefault();
            $( 'html, body' ).animate( {
                scrollTop: 0
            }, 700 );

        } );
        /* End back top */

        /* btn mobile Start*/
        let $menu_item_has_children =   $( '.site-menu .menu-item-has-children' );

        if ( $menu_item_has_children.length ) {

            $('.site-menu .menu-item-has-children > a').after( "<span class='icon_menu_item_mobile'></span>" );

            let $icon_menu_item_mobile  =   $('.icon_menu_item_mobile');

            $icon_menu_item_mobile.each(function () {

                $(this).on( 'click', function () {

                    $(this).addClass( 'icon_menu_item_mobile_active' );
                    $(this).parents( '.menu-item-has-children' ).siblings().find( '.icon_menu_item_mobile' ).removeClass( 'icon_menu_item_mobile_active' );
                    $(this).parents( '.menu-item-has-children' ).children( '.sub-menu' ).slideDown();
                    $(this).parents( '.menu-item-has-children' ).siblings().find( '.sub-menu' ).slideUp();

                } )

            })

        }
        /* btn mobile End */

        /* Start Gallery Single */
        $( document ).general_owlCarousel_item( '.site-post-slides' );
        /* End Gallery Single */

        /* Start Gallery Single Event */
        $( document ).general_owlCarousel_item( '.site-single-event__slides' );
        /* End Gallery Single Event */

        $('.site-single-event__gallery').mCustomScrollbar({
            axis:'x'
        });

    });

    $( window ).on( "load", function() {

        $( '#site-loadding' ).remove();

    });

    $( window ).scroll( function() {

        if ( timer_clear ) clearTimeout(timer_clear);

        timer_clear = setTimeout( function() {

            /* Start scroll back top */
            let $scrollTop = $(this).scrollTop();

            if ( $scrollTop > 200 ) {
                $('#back-top').addClass('active_top');
            }else {
                $('#back-top').removeClass('active_top');
            }
            /* End scroll back top */

        }, 100 );

    });

    /* Start function owlCarouse item */
    $.fn.general_owlCarousel_item = function ( class_item_one ) {

        let class_element_owlCarousel   =   $( class_item_one );

        if ( class_element_owlCarousel.length ) {

            class_element_owlCarousel.each(function(){

                let $settings_slider    =   $(this).data( 'settings' ),
                    $loop_slider        =   false,
                    $autoplay           =   false,
                    $rtl_slider         =   false,
                    $active_dots        =   false,
                    $active_nav         =   false;

                if ( $settings_slider !== undefined ) {

                    $loop_slider    =   typeof ( $settings_slider['loop'] ) !== "undefined" ? $settings_slider['loop'] : false;
                    $autoplay       =   typeof ( $settings_slider['autoplay'] ) !== "undefined" ? $settings_slider['autoplay']: false;
                    $active_dots    =   typeof ( $settings_slider['dots'] ) !== "undefined" ? $settings_slider['dots'] : false;
                    $active_nav     =   typeof ( $settings_slider['nav'] ) !== "undefined" ?  $settings_slider['nav'] : false;

                }

                $( this ).owlCarousel({

                    items:1,
                    loop: $loop_slider,
                    autoplay: $autoplay,
                    rtl: $rtl_slider,
                    autoplaySpeed: 800,
                    navSpeed: 800,
                    dotsSpeed: 800,
                    nav: $active_nav,
                    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                    dots: $active_dots,
                    autoHeight:true

                });

            });

        }

    };
    /* End function owlCarouse item */

    /* Start function multi owlCarouse */
    $.fn.general_multi_owlCarouse = function ( class_item ) {

        let class_item_owlCarousel   =   $( class_item );

        if ( class_item_owlCarousel.length ) {

            class_item_owlCarousel.each(function(){

                let $settings_slider    =   $(this).data( 'settings' ),
                    $item_number        =   4,
                    $margin_item        =   15,
                    $loop_slider        =   false,
                    $autoplay           =   false,
                    $active_dots        =   false,
                    $active_nav         =   false,
                    $item_mobile        =   1,
                    $margin_item_mobile =   0,
                    $item_tablet        =   3;

                if ( $settings_slider !== undefined ) {

                    $item_number        =   typeof ( $settings_slider['number_item'] ) !== "undefined" ? parseInt( $settings_slider['number_item'] ) : 4;
                    $margin_item        =   typeof ( $settings_slider['margin_item'] ) !== "undefined" ? parseInt( $settings_slider['margin_item'] ) : 15;
                    $loop_slider        =   typeof ( $settings_slider['loop'] ) !== "undefined" ? $settings_slider['loop'] : false;
                    $autoplay           =   typeof ( $settings_slider['autoplay'] ) !== "undefined" ? $settings_slider['autoplay']: false;
                    $active_dots        =   typeof ( $settings_slider['dots'] ) !== "undefined" ? $settings_slider['dots'] : false;
                    $active_nav         =   typeof ( $settings_slider['nav'] ) !== "undefined" ?  $settings_slider['nav'] : false;
                    $item_mobile        =   typeof ( $settings_slider['item_mobile'] ) !== "undefined" ? parseInt( $settings_slider['item_mobile'] ) : 1;
                    $margin_item_mobile =   typeof ( $settings_slider['margin_item_mobile'] ) !== "undefined" ? parseInt( $settings_slider['margin_item_mobile'] ) : 0;
                    $item_tablet        =   typeof ( $settings_slider['item_tablet'] ) !== "undefined" ? parseInt( $settings_slider['item_tablet'] ) : 3;

                }

                $( this ).owlCarousel({

                    loop: $loop_slider,
                    autoplay: $autoplay,
                    margin: $margin_item,
                    nav: $active_nav,
                    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                    dots: $active_dots,
                    rtl: false,
                    autoplaySpeed: 800,
                    navSpeed: 800,
                    dotsSpeed: 800,
                    autoHeight:true,
                    responsive:{
                        0:{
                            items: $item_mobile,
                            margin: $margin_item_mobile
                        },
                        576:{
                            items:2
                        },
                        768:{
                            items: $item_tablet
                        },
                        1200:{
                            items:$item_number
                        }
                    }

                });

            });

        }

    };
    /* End function multi owlCarouse */

} )( jQuery );
