<?php 

//Enqueing theme's files
function cassieDay_files() {

    //Enqueue CSS files
    wp_enqueue_style('mainCSS', get_template_directory_uri() . '/css/main.css', array(), '1.2');
    wp_enqueue_style('owlCarousel', get_template_directory_uri() . '/assets/owlCarousel/owl.carousel.min.css', array(), '1.2');

    //Enqueue JS files
    wp_enqueue_script('jquery');
    wp_enqueue_script('mainJS', get_stylesheet_directory_uri() . '/js/main.js', array(), 1.2, true);
    wp_enqueue_script('owlCarouselJS', get_stylesheet_directory_uri(). '/assets/owlCarousel/owl.carousel.min.js', array(), 1.2, true);
    wp_enqueue_script('popup-form-handler', get_template_directory_uri() . '/js/popup-form-handler.js', array('jquery'), null, true);
    wp_enqueue_script('form-resizes', get_template_directory_uri() . '/js/resizever2.js', array(), null, true);

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

// Exclude node_modules from exporting All In One Migration Plugin
add_filter( 'ai1wm_exclude_themes_from_export',
function ( $exclude_filters ) {
  $exclude_filters[] = 'cassieDay/node_modules'; // insert your theme name
  return $exclude_filters;
} );


// AJAX FOR FORMS
function load_popup_form_content() {
  if (isset($_POST['form_id']) && !empty($_POST['form_id'])) {
      $form_id = intval($_POST['form_id']);
      $form_post = get_post($form_id);

      if ($form_post) {
          // Start output buffering
          ob_start();

          // Get custom fields
          $formTitle = get_field('form_title', $form_id);
          $formDescription = get_field('form_description', $form_id);
          $formURL = get_field('form_url', $form_id);
          $formID = get_field('form_id', $form_id); 
          
          // Output the HTML with the retrieved fields
          if ($formTitle) {
              echo '<h3>' . esc_html($formTitle) . '</h3>';
          }

          if ($formDescription) {
              echo '<div>' . esc_html($formDescription) . '</div>';
          }

          // Iframe for form
          if ($formURL) {
              echo '<iframe src="' . esc_url($formURL) . '" style="border:none;width:100%;" scrolling="no" id="' . esc_attr($formID) . '"></iframe>';
          }

          // Get the buffered content as a string
          $html_output = ob_get_clean();

          // Return the content to the AJAX request
          echo $html_output;
      } else {
          echo 'Form not found.';
      }
  }

  wp_die(); // Properly terminate the AJAX call
}
add_action('wp_ajax_load_popup_form', 'load_popup_form_content');
add_action('wp_ajax_nopriv_load_popup_form', 'load_popup_form_content');
