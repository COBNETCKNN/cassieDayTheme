<?php
/**
 * Overwritting default WordPress features so they are pulled from custom field
 */

 //Site favicon
 function custom_favicon() { 
    if( have_rows('header_settings', 'option') ):
        while( have_rows('header_settings', 'option') ): the_row();
            $siteFavicon = get_sub_field('header_favicon', 'option');
    
            $favicon_url = wp_get_attachment_image_url($siteFavicon, 'favicon-size');
    
            if ($favicon_url) {
                echo '<link rel="icon" href="' . esc_url($favicon_url) . '" type="image/x-icon">';
            }
        endwhile; 
     endif;
}
add_action('wp_head', 'custom_favicon');

//Removing p tags from wysiwyg editor custom field
function my_acf_add_local_field_groups() {
    remove_filter('acf_the_content', 'wpautop' );
}
add_action('acf/init', 'my_acf_add_local_field_groups');

/**
 * Disable editor on certain pages.
 */
function remove_pages_editor() {
    $disabled_pages = array(91);

    $current_page_id = get_the_ID();

    if (in_array($current_page_id, $disabled_pages)) {
        remove_post_type_support('page', 'editor');
    }

    remove_post_type_support( 'post', 'editor' );
}
add_action('add_meta_boxes', 'remove_pages_editor');