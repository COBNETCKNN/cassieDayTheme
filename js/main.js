jQuery(document).ready((function(e){e("#menu-header-menu li").hover((function(){e(this).find(".sub-menu").stop(!0,!0).slideDown(200)}),(function(){e(this).find(".sub-menu").stop(!0,!0).slideUp(200)}))})),jQuery(document).ready((function(e){e(".owl-carousel").owlCarousel({loop:!1,margin:10,items:1,autoplay:!1,autoplayTimeout:4e3,autoplayHoverPause:!0})})),document.addEventListener("DOMContentLoaded",(function(){var e=document.querySelector(".heroHome .cta-button"),t=e?e.getAttribute("data-form-id"):null;t&&document.querySelectorAll(".footer-popup").forEach((function(e){e.setAttribute("data-form-id",t)}))})),jQuery(document).ready((function(e){e("#nav-icon3").on("click",(function(){e(this).toggleClass("open"),e("#mobileMenu").hasClass("active")?(e("#mobileMenu").fadeOut(500,(function(){e(this).removeClass("active")})),e("body").removeClass("no-scroll")):(e("#mobileMenu").fadeIn(500,(function(){e(this).addClass("active")})),e("body").addClass("no-scroll"))})),e(".mobile-menu-list li:has(.sub-menu) > a .down-arrow").on("click",(function(t){t.preventDefault(),t.stopPropagation();var o=e(this).closest("a").siblings(".sub-menu"),n=e(this);o.slideToggle(500),n.toggleClass("open")}))})),jQuery(document).ready((function(e){e(".coachBioContent").each((function(){var t=e(this),o=t.text().trim(),n=o.split(" ").slice(0,50).join(" ")+"...";t.data("full-text",o).data("excerpt",n),t.text(n)})),e(".toggleBioBtn").on("click",(function(){var t=e(this).closest(".coachBioWrapper").find(".coachBioContent"),o=t.hasClass("expanded");t.stop().slideUp(0,(function(){var e=o?t.data("excerpt"):t.data("full-text");t.text(e).slideDown(0)})),e(this).text(o?"Show More":"Show Less"),t.toggleClass("expanded")}))})),jQuery(document).ready((function(e){function t(){e(".embededCodeWrapper iframe").each((function(){e(this).iFrameResize({checkOrigin:!1,log:!0,sizeHeight:!0,sizeWidth:!0})}))}e(".embededCodeWrapper iframe").on("load",(function(){t()})),e(window).on("resize",(function(){t()}))})),jQuery(document).ready((function(e){function t(){var t=e(".header"),o=e(".heroSection"),n="0";e("#wpadminbar").length?n="60px":t.hasClass("header-fixed")&&(n=t.outerHeight()+"px"),o.css("margin-top")!==n&&o.css("margin-top",n)}var o,n,a,i;e(window).on("load resize",t),e(window).on("scroll",(o=t,n=100,function(){var e=this,t=arguments;i?(clearTimeout(a),a=setTimeout((function(){Date.now()-i>=n&&(o.apply(e,t),i=Date.now())}),n-(Date.now()-i))):(o.apply(e,t),i=Date.now())})),t()})),document.addEventListener("DOMContentLoaded",(function(){document.querySelectorAll("[data-toggle]").forEach((function(e){e.addEventListener("click",(function(e){var t=e.currentTarget.dataset.toggle,o=document.querySelector("".concat(t));e.currentTarget.classList.contains("active")?o.style.maxHeight="":o.style.maxHeight=o.scrollHeight+"px",e.currentTarget.classList.toggle("active")}))}))}));
