<?php 
/**
 * Registration of the navigation menus for Header and Footer
 */

 function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

// Adding arrow if the nav item has subitems
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        // Add an arrow if the menu item has sub-items
        $arrow = '';
        if (in_array('menu-item-has-children', $item->classes)) {
            $arrow = ' 
            <span class="down-arrow">
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.0981 6.54499C15.9821 6.42883 15.8442 6.33668 15.6925 6.27382C15.5408 6.21095 15.3782 6.17859 15.214 6.17859C15.0498 6.17859 14.8871 6.21095 14.7354 6.27382C14.5837 6.33668 14.4459 6.42883 14.3298 6.54499L10.5081 10.3658C10.43 10.4439 10.324 10.4878 10.2136 10.4878C10.1031 10.4878 9.99711 10.4439 9.91897 10.3658L6.09814 6.54499C5.86375 6.31049 5.54582 6.17871 5.21427 6.17863C4.88272 6.17855 4.56472 6.31019 4.33022 6.54457C4.09573 6.77896 3.96395 7.0969 3.96387 7.42844C3.96379 7.75999 4.09542 8.07799 4.32981 8.31249L8.15147 12.1342C8.42231 12.405 8.74386 12.6199 9.09774 12.7665C9.45163 12.9131 9.83093 12.9885 10.214 12.9885C10.597 12.9885 10.9763 12.9131 11.3302 12.7665C11.6841 12.6199 12.0056 12.405 12.2765 12.1342L16.0981 8.31249C16.3325 8.07808 16.4641 7.76019 16.4641 7.42874C16.4641 7.09728 16.3325 6.7794 16.0981 6.54499Z" fill="#FF63CB"/>
                </svg>
            </span>';
        }

        $output .= $indent . '<li class="' . implode(' ', $item->classes) . '">';
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . $arrow . '</a>';
    }
}