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

// Fully Disable Gutenberg editor.
//add_filter('use_block_editor_for_post_type', '__return_false', 5);
// Don't load Gutenberg-related stylesheets.
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {
    if ( !is_single() ) {
        wp_dequeue_style( 'wp-block-library' ); // Wordpress core
        wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
        wp_dequeue_style( 'wc-block-style' ); // WooCommerce
    }
}

function pistol_disable_gutenberg($is_enabled, $post_type) {
    
    if ($post_type !== 'post') return false; // enable Gutenberg only on post type
    
    return $is_enabled;
    
}
add_filter('use_block_editor_for_post_type', 'pistol_disable_gutenberg', 10, 2);
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

//Theme Supports
add_theme_support( 'title-tag' );
add_theme_support('post-thumbnails', array('post', 'page'));

//Making search functionality search only for blog posts excluding rest of the content
function restrict_search_to_posts($query) {
    if ($query->is_search && $query->is_main_query()) {
        $query->set('post_type', 'post');
    }
}
add_action('pre_get_posts', 'restrict_search_to_posts');