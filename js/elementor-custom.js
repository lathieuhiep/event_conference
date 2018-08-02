(function ($) {

    /* Start element slider */
    let ElementCarouselSlider   =   function( $scope, $ ) {

        let element_slides = $scope.find('.element-slides');

        $( document ).general_owlCarousel_item( element_slides );

    };
    /* End element slider */

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/event_conference_slides.default', ElementCarouselSlider  );

    } );

})( jQuery );