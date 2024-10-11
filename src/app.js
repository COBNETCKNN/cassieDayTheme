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
    var autoplayTimeout = 4000;

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

//Custom function that takes data-form-id attribute from hero button and inserts it in the free intro footer link so the popup form can query it's post
document.addEventListener('DOMContentLoaded', function () {
    // Get the hero button's data-form-id
    const heroButton = document.querySelector('.heroHome .cta-button');
    const formId = heroButton ? heroButton.getAttribute('data-form-id') : null;

    // Get all footer-popup links and assign the data-form-id
    if (formId) {
        const footerPopupLinks = document.querySelectorAll('.footer-popup');
        footerPopupLinks.forEach(function (link) {
            link.setAttribute('data-form-id', formId);
        });
    }
});