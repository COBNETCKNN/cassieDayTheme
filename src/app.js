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

    // Toggle submenu visibility on .down-arrow click
    $('.mobile-menu-list li:has(.sub-menu) > a .down-arrow').on('click', function (e) {
        e.preventDefault(); // Prevent default behavior of <a> tag
        e.stopPropagation(); // Stop event from bubbling up to <a>

        const submenu = $(this).closest('a').siblings('.sub-menu'); // Target sibling submenu
        const arrow = $(this); // Arrow is the clicked element

        submenu.slideToggle(500); // Toggle submenu visibility
        arrow.toggleClass('open'); // Rotate arrow
    });
});

//Show more function that expands biography paragraphs on Coaches section
jQuery(document).ready(function ($) {
    $('.coachBioContent').each(function () {
        const $bioContent = $(this);
        const fullText = $bioContent.text().trim();
        const excerpt = fullText.split(' ').slice(0, 50).join(' ') + '...';

        // Store full text and excerpt in data attributes
        $bioContent.data('full-text', fullText).data('excerpt', excerpt);

        // Display the excerpt by default
        $bioContent.text(excerpt);
    });

    $('.toggleBioBtn').on('click', function () {
        const $bioWrapper = $(this).closest('.coachBioWrapper');
        const $bioContent = $bioWrapper.find('.coachBioContent');
        const isExpanded = $bioContent.hasClass('expanded');

        // Toggle between full text and excerpt with animation
        $bioContent.stop().slideUp(0, function () {
            const newText = isExpanded 
                ? $bioContent.data('excerpt') 
                : $bioContent.data('full-text');
            $bioContent.text(newText).slideDown(0); // Animate the new text
        });

        // Toggle button text and expanded class
        $(this).text(isExpanded ? 'Show More' : 'Show Less');
        $bioContent.toggleClass('expanded');
    });
});

//Adjust width and height of wrapper div inside code embed sections
jQuery(document).ready(function ($) {
    function resizeEmbeddedContent() {
        $('.embededCodeWrapper iframe').each(function () {
            var iframe = $(this);

            // Apply iFrame Resizer with options
            iframe.iFrameResize({
                checkOrigin: false,  // Skip origin checking if cross-origin iframes are embedded
                log: true,           // Enable logging for debugging purposes
                sizeHeight: true,    // Automatically adjust height
                sizeWidth: true      // Automatically adjust width
            });
        });
    }

    // Call the function initially and whenever an iframe loads
    $('.embededCodeWrapper iframe').on('load', function () {
        resizeEmbeddedContent();
    });

    // Optional: Recheck and resize on window resize
    $(window).on('resize', function () {
        resizeEmbeddedContent();
    });
});

//Function that adds margin to the hero section if Header is selected to be in fixed position through Theme Settings
jQuery(document).ready(function ($) {
    function adjustHeroPosition() {
        const header = $('.header');
        const hero = $('.heroSection');
        const adminBar = $('#wpadminbar');
        let newMarginTop = '0'; // Default margin

        if (adminBar.length) {
            newMarginTop = '60px'; // Admin bar is present
        } else if (header.hasClass('header-fixed')) {
            newMarginTop = header.outerHeight() + 'px'; // Header is fixed
        }

        // Only update margin if it has changed to avoid unnecessary repaints
        if (hero.css('margin-top') !== newMarginTop) {
            hero.css('margin-top', newMarginTop);
        }
    }

    // Throttle function to prevent excessive calls on scroll
    function throttle(func, limit) {
        let lastFunc;
        let lastRan;
        return function () {
            const context = this;
            const args = arguments;
            if (!lastRan) {
                func.apply(context, args);
                lastRan = Date.now();
            } else {
                clearTimeout(lastFunc);
                lastFunc = setTimeout(function () {
                    if (Date.now() - lastRan >= limit) {
                        func.apply(context, args);
                        lastRan = Date.now();
                    }
                }, limit - (Date.now() - lastRan));
            }
        };
    }

    // Run adjustHeroPosition on load and resize events
    $(window).on('load resize', adjustHeroPosition);

    // Throttle scroll event to reduce jittering
    $(window).on('scroll', throttle(adjustHeroPosition, 100));

    // Initial adjustment
    adjustHeroPosition();
});

document.addEventListener('DOMContentLoaded', () => {
    const togglers = document.querySelectorAll('[data-toggle]');
    
      togglers.forEach((btn) => {
        btn.addEventListener('click', (e) => {
           const selector = e.currentTarget.dataset.toggle
           const block = document.querySelector(`${selector}`);
          if (e.currentTarget.classList.contains('active')) {
            block.style.maxHeight = '';
          } else {
            block.style.maxHeight = block.scrollHeight + 'px';
          }
            
           e.currentTarget.classList.toggle('active')
        })
      })
      })