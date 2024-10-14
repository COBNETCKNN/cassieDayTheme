<?php 

//Enqueing theme's files
function cassieDay_files() {

    //Enqueue CSS files
    wp_enqueue_style('mainCSS', get_template_directory_uri() . '/css/main.css', array(), '1.8');
    wp_enqueue_style('owlCarousel', get_template_directory_uri() . '/assets/owlCarousel/owl.carousel.min.css', array(), '1.8');

    //Enqueue JS files
    wp_enqueue_script('jquery');
    wp_enqueue_script('mainJS', get_stylesheet_directory_uri() . '/js/main.js', array(), 1.8, true);
    wp_enqueue_script('owlCarouselJS', get_stylesheet_directory_uri(). '/assets/owlCarousel/owl.carousel.min.js', array(), 1.8, true);
    wp_enqueue_script('form-resizes', get_template_directory_uri() . '/js/resizever2.js', array(), null, true);
    wp_enqueue_script('ajax-popup', get_stylesheet_directory_uri() . '/js/popup-handler.js', array(), 1.8, true );

    // Localize ajaxurl and pass it to the JavaScript file
    wp_localize_script('popup-form-handler', 'ajax_object', array(
      'ajaxurl' => admin_url('admin-ajax.php')
    ));

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

//Registration of Custom Post Types
require_once('includes/custom-post-types.php');

//Ajax handler for popup forms
require_once('ajax/popup-form.php');



// Exclude node_modules from exporting All In One Migration Plugin
add_filter( 'ai1wm_exclude_themes_from_export',
function ( $exclude_filters ) {
  $exclude_filters[] = 'cassieDay/node_modules'; // insert your theme name
  return $exclude_filters;
} );


add_filter('mce_buttons_2', 'mce_editor_buttons');
function mce_editor_buttons($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

function mce_mod( $init ) {
  //$init['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4';

  $style_formats = array (
  array(  
          'title' => 'Underline Primary Decoration',  
          'inline' => 'span',  
          'classes' => 'underlinePrimaryDecoration',
          'wrapper' => true,
      ),
  array(  
          'title' => 'Underline Secondary Decoration',  
          'inline' => 'span',  
          'classes' => 'underlineSecondaryDecoration',
          'wrapper' => true,
      ),
    array(  
          'title' => 'Underline Tertiary Decoration',  
          'inline' => 'span',  
          'classes' => 'underlineTertiaryDecoration',
          'wrapper' => true,
    ),
  );

  $init['style_formats'] = json_encode( $style_formats );

  $init['style_formats_merge'] = false;
  return $init;
}
add_filter('tiny_mce_before_init', 'mce_mod');
