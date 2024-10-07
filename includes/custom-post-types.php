<?php 
/**
 * Registration of Custom Post Types
 */

 function cassieDayPostTypes() {

    // Programs Post Type
    register_post_type('forms', array(
        'public' => true,
        'labels' => array(
            'name' => 'Forms',
            'add_new' => 'Add New Form',
            'add_new_item' => 'Add New Form',
            'edit_item' => 'Edit Form',
            'all_items' => 'All Forms',
            'singular_name' => 'Form',
        ),
        'menu_icon' => 'dashicons-feedback',
        'rewrite' => array('slug' => 'forms'),
        'has_arcive' => true,
        'supports' => array('title'),
        'show_in_rest' => true,
    ));

}
add_action('init', 'cassieDayPostTypes');