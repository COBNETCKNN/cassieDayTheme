<?php
/**
 * Template part for CTA or Custom Link Buttons
 */

 // Get the true/false values
 $add_button = get_sub_field('add_button');
 $add_custom_link = get_sub_field('add_custom_link');
 
 // Get the Popup Form content and Custom Link
 $popup_form_content = get_sub_field('popup_form_group');
 $custom_link = get_sub_field('custom_link');
 
 // Check if popup form ID is available
 $form_id = isset($popup_form_content['cta_select_form']) && is_object($popup_form_content['cta_select_form']) 
             ? $popup_form_content['cta_select_form']->ID 
             : null;
 
 // Prioritize the custom link over the CTA button
 if ($add_custom_link && $custom_link) {
     $custom_link_url = $custom_link['url'];
     $custom_link_title = $custom_link['title'];
     $custom_link_target = $custom_link['target'] ? $custom_link['target'] : '_self'; // Default to '_self' if not set
     ?>
        <button class="button-primary font-plus rounded-xl text-base font-bold uppercase mt-10">
            <a class="block px-10 py-4" href="<?php echo esc_url($custom_link_url); ?>" target="<?php echo esc_attr($custom_link_target); ?>"><?php echo esc_html($custom_link_title); ?></a>
        </button>

        
     <?php
 } elseif ($add_button && $popup_form_content && $form_id) {
     ?>
        <button class="button-primary font-plus text-white rounded-xl text-base font-bold uppercase mt-10">
            <a href="" class="cta-button block px-10 py-4" data-form-id="<?php echo esc_attr($form_id); ?>">
                <?php echo esc_html($popup_form_content['cta_button_name']); ?>
            </a>
        </button>
     <?php
 }
 ?>