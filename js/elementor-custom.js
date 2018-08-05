(function ($) {

    /* Start element slides */
    let ElementCarouselSlider   =   function( $scope, $ ) {

        let element_slides = $scope.find('.element-slides');

        $( document ).general_owlCarousel_item( element_slides );

    };
    /* End element slides */

    /* Start element slides category  */
    let ElementCategoryCarouselSlider   =   function( $scope, $ ) {

        let element_slides_cat = $scope.find('.element-slides-cat');

        $( document ).general_multi_owlCarouse( element_slides_cat );

    };
    /* End element slides category  */

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/event_conference_slides.default', ElementCarouselSlider  );

        /* Element slides category  */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/event_conference_slides_category.default', ElementCategoryCarouselSlider  );

    } );

})( jQuery );