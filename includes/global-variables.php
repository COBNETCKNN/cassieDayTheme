<?php 
/**
 * Setting up global variables for Advanced Custom Fields so they can be used globally.
 */

// Convert hex to RGB function
function hexToRgb($hex) {
$hex = str_replace('#', '', $hex);

    if (strlen($hex) === 3) {
        $r = hexdec(str_repeat($hex[0], 2));
        $g = hexdec(str_repeat($hex[1], 2));
        $b = hexdec(str_repeat($hex[2], 2));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }

    return "$r, $g, $b"; // Return as 'R, G, B'
}

//Colors
function theme_colors() {
    //Theme Main Colors
    if( have_rows('theme_colors', 'option') ):
        while( have_rows('theme_colors', 'option') ): the_row();
    
            $primary_color = get_sub_field('primary_color', 'option');
            $secondary_color = get_sub_field('secondary_color', 'option');
            $tertiary_color = get_sub_field('tertiary_color', 'option');
    
            // Convert each color to RGB
            $primary_rgb = hexToRgb($primary_color);
            $secondary_rgb = hexToRgb($secondary_color);
            $tertiary_rgb = hexToRgb($tertiary_color);
        endwhile;
    endif;

    //Section Background
    if( have_rows('section_background', 'option') ):
        while( have_rows('section_background', 'option') ): the_row();

            $primary_section_color = get_sub_field('primary_color', 'option');
            $secondary_section_color = get_sub_field('secondary_color', 'option');

        endwhile;
    endif;

    //Text Colors
    if( have_rows('text_colors', 'option') ):
        while( have_rows('text_colors', 'option') ): the_row();

            $primary_text_color = get_sub_field('primary_text_color', 'option');
            $primary_light_text_color = get_sub_field('primary_light_text_color', 'option');
            $secondary_text_color = get_sub_field('secondary_text_color', 'option');

        endwhile;
    endif;
    
    // Output the custom styles with the ACF color values
    echo "<style>
        :root {
            --primary-color: $primary_color;
            --secondary-color: $secondary_color;
            --tertiary-color: $tertiary_color;
            --primary-color-rgb: $primary_rgb;
            --secondary-color-rgb: $secondary_rgb;
            --tertiary-color-rgb: $tertiary_rgb;

            --primary-section-color: $primary_section_color;
            --secondary-section-color: $secondary_section_color;
            --primary-text-color: $primary_text_color;
            --primary-light-text-color: $primary_light_text_color;
            --secondary-text-color: $secondary_text_color;
        }
    </style>";

    //Button colors
    if( have_rows('button_colors', 'option') ):
        while( have_rows('button_colors', 'option') ): the_row();
            //Primary Button
            if( have_rows('primary_button', 'option') ):
                while( have_rows('primary_button', 'option') ): the_row();

                    $primary_button_text_color = get_sub_field('text_color', 'option');
                    $primary_button_background_color = get_sub_field('background_color', 'option');

                endwhile;
            endif;

            //Secondary Button
            if( have_rows('secondary_button', 'option') ):
                while( have_rows('secondary_button', 'option') ): the_row();

                    $secondary_button_text_color = get_sub_field('text_color', 'option');
                    $secondary_button_background_color = get_sub_field('background_color', 'option');

                endwhile;
            endif;

            //Banner Button
            if( have_rows('banner_button', 'option') ):
                while( have_rows('banner_button', 'option') ): the_row();

                    $banner_button_text_color = get_sub_field('text_color', 'option');
                    $banner_button_background_color = get_sub_field('background_color', 'option');

                endwhile;
            endif;

            //Header Button
            if( have_rows('header_button', 'option') ):
                while( have_rows('header_button', 'option') ): the_row();

                    $header_button_text_color = get_sub_field('text_color', 'option');
                    $header_button_background_color = get_sub_field('background_color', 'option');

                endwhile;
            endif;
        endwhile;
    endif;

    // Output the custom styles with the ACF color values
    echo "<style>
    :root {
        --primary-button-text-color: $primary_button_text_color;
        --primary-button-background-color: $primary_button_background_color;

        --secondary-button-text-color: $secondary_button_text_color;
        --secondary-button-background-color: $secondary_button_background_color;

        --banner-button-text-color: $banner_button_text_color;
        --banner-button-background-color: $banner_button_background_color;

        --header-button-text-color: $header_button_text_color;
        --header-button-background-color: $header_button_background_color;
    }
    </style>";

    //Link Colors
    if( have_rows('link_colors', 'option') ):
        while( have_rows('link_colors', 'option') ): the_row();

            $link_color = get_sub_field('link_color', 'option');
    
            // Convert each color to RGB
            $link_color_rgb = hexToRgb($link_color);

        endwhile;
    endif;

    // Output the custom styles with the ACF link color values
    echo "<style>
    :root {
        --link-color: $link_color;
        --link-color-rgb: $link_color_rgb;
    }
    </style>";

    //Footer Link Colors
    if( have_rows('footer_links', 'option') ):
        while( have_rows('footer_links', 'option') ): the_row();

            $footer_link_color = get_sub_field('link_color', 'option');
            $footer_link_hover_color = get_sub_field('link_hover_color', 'option');
            $footer_link_active_color = get_sub_field('link_active_color', 'option');

        endwhile;
    endif;

    // Output the custom styles with the ACF link color values
    echo "<style>
    :root {
        --footer-link-color: $footer_link_color;
        --footer-link-hover-color: $footer_link_hover_color;
        --footer-link-active-color: $footer_link_active_color;
    }
    </style>";

    //Heading Underline Colors
    if( have_rows('heading_underline_decoration_colors', 'option') ):
        while( have_rows('heading_underline_decoration_colors', 'option') ): the_row();

            $primary_heading_decoration = get_sub_field('primary_underline_color', 'option');
            $secondary_heading_decoration = get_sub_field('secondary_underline_color', 'option');
            $tertiary_heading_decoration = get_sub_field('tertiary_underline_color', 'option');

        endwhile;
    endif;

    // Output the custom styles with the ACF link color values
    echo "<style>
    :root {
        --primary-heading-decoration: $primary_heading_decoration;
        --secondary-heading-decoration: $secondary_heading_decoration;
        --tertiary-heading-decoration: $tertiary_heading_decoration;
    }
    </style>";
}
add_action('wp_head', 'theme_colors');

 //Site name
 function get_header_website_name() {
    // Replace 'header_settings' with your ACF field group name
    $header_website_name = get_field('header_website_name', 'option');
    return $header_website_name;
}

 function set_global_header_name() {
    global $site_name;
    $site_name = get_header_website_name();
}
add_action('wp', 'set_global_header_name');

//Header Logo Width
function set_global_header_logo_width() {
    global $headerWidthDesktop, $headerWidthMobile;

    if( have_rows('header_logo', 'option') ):
        while( have_rows('header_logo', 'option') ): the_row();
            if( have_rows('header_logo_width', 'option') ):
                while( have_rows('header_logo_width', 'option') ): the_row(); 
                    // Store the values in global variables and add 'px'
                    $headerWidthDesktop = get_sub_field('header_logo_desktop_width') . 'px';
                    $headerWidthMobile = get_sub_field('header_logo_mobile_width') . 'px';
                endwhile;
            endif;
        endwhile;
    endif;
}
add_action('wp', 'set_global_header_logo_width');

//Footer Logo Width
function set_global_footer_logo_width() {
    global $footerLogoWidth;

    if( have_rows('footer_logo_group', 'option') ):
        while( have_rows('footer_logo_group', 'option') ): the_row();
            // Store the values in global variables and add 'px'
            $footerLogoWidth = get_sub_field('footer_logo_width') . 'px';
        endwhile;
    endif;
}
add_action('wp', 'set_global_footer_logo_width');