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
            $formContent = get_field('form_content', $form_id);
            $formURL = get_field('form_url', $form_id);
            $formID = get_field('form_id', $form_id); 
            
            // Output the HTML with the retrieved fields
            if ($formContent) {
                echo '<div class="formContentWrapper">' . $formContent . '</div>';
            }
  
            // Iframe for form
            if ($formURL) {
                echo '<iframe src="' . esc_url($formURL) . '" style="width:100%;height:100%;border:none;border-radius:7px" scrolling="no" id="' . esc_attr($formID) . '"   data-layout="{&quot;id&quot;:&quot;INLINE&quot;}"
                    data-trigger-type="alwaysShow"
                    data-trigger-value=""
                    data-activation-type="alwaysActivated"
                    data-activation-value=""
                    data-deactivation-type="neverDeactivate"
                    data-deactivation-value=""
                    data-form-name="Website Form - Vega"
                    data-height="400"
                    data-layout-iframe-id="inline-0xh9BnmCwVC2xGbiBUuH"
                    data-form-id="0xh9BnmCwVC2xGbiBUuH"
                    title="Website Form - Vega"></iframe>';
                echo '<div class="formTerms">By providing your phone number, you agree to receive text messages from Kilo Gym</div>';
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