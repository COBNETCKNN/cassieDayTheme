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
        loop: false,
        margin: 10,
        items: 1,
        autoplay: false,
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

jQuery(document).ready(function ($) {
    // Toggle overlay and decorations using #nav-icon3
    $('#nav-icon3').on('click', function () {
        $(this).toggleClass('open'); // Animate hamburger icon to "X"

        // Check if the mobile menu is currently active
        if ($('#mobileMenu').hasClass('active')) {
            $('#mobileMenu').fadeOut(500, function() {
                $(this).removeClass('active'); // Remove the active class after fading out
            });
            $('body').removeClass('no-scroll'); // Remove no-scroll class from body
        } else {
            $('#mobileMenu').fadeIn(500, function() {
                $(this).addClass('active'); // Add the active class after fading in
            });
            $('body').addClass('no-scroll'); // Add no-scroll class to body
        }
    });

    // Toggle submenu visibility on arrow click
    // Attach click event to parent links containing an arrow
    $('.mobile-menu-list li:has(.sub-menu) > a').on('click', function (e) {
        e.preventDefault(); // Prevent default anchor behavior

        const submenu = $(this).siblings('.sub-menu'); // Target sibling sub-menu
        const arrow = $(this).find('.arrow'); // Find the arrow inside the clicked item

        submenu.slideToggle(300); // Toggle submenu visibility
        arrow.toggleClass('open'); // Rotate arrow
    });
});