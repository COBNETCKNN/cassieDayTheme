<?php 
/**
 * Registration of the navigation menus for Header and Footer
 */

if( function_exists('acf_add_options_page') ) {
     
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => true
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'General Theme Settings',
        'menu_title'    => 'Theme Settings',
        'parent_slug'   => 'theme-settings',
    ));
     
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Settings: Header',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-settings',
        'menu_slug'     => 'theme-settings-header',
    ));
     
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Settings: Footer',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-settings',
        'menu_slug'     => 'theme-settings-footer',
    ));
 }