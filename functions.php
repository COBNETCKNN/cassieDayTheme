<?php 

//Enqueing theme's files
function cassieDay_files() {

    //Enqueue CSS files
    wp_enqueue_style('mainCSS', get_template_directory_uri() . '/css/main.css', array(), '1.1');
    wp_enqueue_style('owlCarousel', get_template_directory_uri() . '/assets/owlCarousel/owl.carousel.min.css', array(), '1.1');

    //Enqueue JS files
    wp_enqueue_script('jquery');
    wp_enqueue_script('mainJS', get_stylesheet_directory_uri() . '/js/main.js', array(), 1.1, true);
    wp_enqueue_script('owlCarouselJS', get_stylesheet_directory_uri(). '/assets/owlCarousel/owl.carousel.min.js', array(), 1.1, true);

}
add_action('wp_enqueue_scripts', 'cassieDay_files');

//Registration of the navigation menus
require_once('includes/nav-menus.php');

//Extending the ACF options page so it has subpages
require_once('includes/acf-settings-subpages.php');

//Custom Image Sizes 
require_once('includes/image-sizes.php');

//Global variables
require_once('includes/global-variables.php');

//Defining responsive breakpoints
require_once('includes/responsive-breakpoints.php');

//Overwritting default WordPress features
require_once('includes/theme-settings.php');

// Exclude node_modules from exporting All In One Migration Plugin
add_filter( 'ai1wm_exclude_themes_from_export',
function ( $exclude_filters ) {
  $exclude_filters[] = 'cassieDay/node_modules'; // insert your theme name
  return $exclude_filters;
} );