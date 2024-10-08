<?php 

/**
 * AJAX handler for pop up forms
 */

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