<?php
/**
 * Template part for CTA or Custom Link Buttons
 */

// Get the true/false values
$add_button = get_sub_field('add_button');
$add_custom_link = get_sub_field('add_custom_link');

// Get the Popup Form content and Custom Link
$popup_form_content = get_sub_field('popup_form_group');
$custom_link = get_sub_field('custom_link_group');

$form_id = isset($popup_form_content['cta_select_form']) && is_object($popup_form_content['cta_select_form']) 
            ? $popup_form_content['cta_select_form']->ID 
            : null;

if ($add_custom_link && $custom_link) { ?>
    <button class="font-plus text-white bg-primary rounded-xl text-base font-bold uppercase px-10 py-4 mt-10">
        <a href="<?php echo esc_url($custom_link['custom_link_button_link']) ?>">
            <?php echo esc_html($custom_link['custom_link_button_name']); ?>
        </a>
    </button>
    <?php
} elseif ($add_button && $popup_form_content && $form_id) {
    ?>
    <button class="cta-button font-plus text-white bg-primary rounded-xl text-base font-bold uppercase px-10 py-4 mt-10"
        data-form-id="<?php echo esc_attr($form_id); ?>" class="cta-button-hero">
        <?php echo esc_html($popup_form_content['cta_button_name']); ?>
    </button>
    <?php
}
?>