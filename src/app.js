jQuery(document).ready(function($) {
    $('#menu-header-menu li').hover(
        function() {
            $(this).find('.sub-menu').stop(true, true).slideDown(200); // Show sub-menu on hover
        }, 
        function() {
            $(this).find('.sub-menu').stop(true, true).slideUp(200); // Hide sub-menu on mouse leave
        }
    );
});

jQuery(document).ready(function(jQuery){
    var autoplayTimeout = 3000;

    //Initialize OwlCarousel
    var owl = jQuery('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        items: 1,
        autoplay: true,
        autoplayTimeout: autoplayTimeout,
        autoplayHoverPause: true,
    });
});