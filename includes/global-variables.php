<?php 
/**
 * Setting up global variables for Advanced Custom Fields so they can be used globally.
 */

//Colors
function theme_colors() {
    //Theme Main Colors
    if( have_rows('theme_colors', 'option') ):
        while( have_rows('theme_colors', 'option') ): the_row();

            $primary_color = get_sub_field('primary_color', 'option');
            $secondary_color = get_sub_field('secondary_color', 'option');
            $tertiary_color = get_sub_field('tertiary_color', 'option');
            $quaternary_color = get_sub_field('quaternary_color', 'option');

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
            $hero_preheading_color = get_sub_field('hero_preheading_color', 'option');

        endwhile;
    endif;
    
    // Output the custom styles with the ACF color values
    echo "<style>
        :root {
            --primary-color: $primary_color;
            --secondary-color: $secondary_color;
            --tertiary-color: $tertiary_color;
            --quaternary-color: $quaternary_color;
            --primary-section-color: $primary_section_color;
            --secondary-section-color: $secondary_section_color;
            --primary-text-color: $primary_text_color;
            --primary-light-text-color: $primary_light_text_color;
            --secondary-text-color: $secondary_text_color;
            --hero-preheading-color: $hero_preheading_color;
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
                    $primary_button_hover_dark = get_sub_field('hover_primary', 'option');
                    $primary_button_hover_darker = get_sub_field('hover_secondary', 'option');

                endwhile;
            endif;

            //Secondary Button
            if( have_rows('secondary_button', 'option') ):
                while( have_rows('secondary_button', 'option') ): the_row();

                    $secondary_button_text_color = get_sub_field('text_color', 'option');
                    $secondary_button_background_color = get_sub_field('background_color', 'option');
                    $secondary_button_hover_dark = get_sub_field('hover_primary', 'option');
                    $secondary_button_hover_darker = get_sub_field('hover_secondary', 'option');

                endwhile;
            endif;

            //Banner Button
            if( have_rows('banner_button', 'option') ):
                while( have_rows('banner_button', 'option') ): the_row();

                    $banner_button_text_color = get_sub_field('text_color', 'option');
                    $banner_button_background_color = get_sub_field('background_color', 'option');
                    $banner_button_hover_dark = get_sub_field('hover_primary', 'option');
                    $banner_button_hover_darker = get_sub_field('hover_secondary', 'option');

                endwhile;
            endif;

            //Header Button
            if( have_rows('header_button', 'option') ):
                while( have_rows('header_button', 'option') ): the_row();

                    $header_button_text_color = get_sub_field('text_color', 'option');
                    $header_button_background_color = get_sub_field('background_color', 'option');
                    $header_button_hover_dark = get_sub_field('hover_primary', 'option');
                    $header_button_hover_darker = get_sub_field('hover_secondary', 'option');

                endwhile;
            endif;
        endwhile;
    endif;

    // Output the custom styles with the ACF color values
    echo "<style>
    :root {
        --primary-button-text-color: $primary_button_text_color;
        --primary-button-background-color: $primary_button_background_color;
        --primary-button-hover-dark: $primary_button_hover_dark;
        --primary-button-hover-darker: $primary_button_hover_darker;

        --secondary-button-text-color: $secondary_button_text_color;
        --secondary-button-background-color: $secondary_button_background_color;
        --secondary-button-hover-dark: $secondary_button_hover_dark;
        --secondary-button-hover-darker: $secondary_button_hover_darker;

        --banner-button-text-color: $banner_button_text_color;
        --banner-button-background-color: $banner_button_background_color;
        --banner-button-hover-dark: $banner_button_hover_dark;
        --banner-button-hover-darker: $banner_button_hover_darker;

        --header-button-text-color: $header_button_text_color;
        --header-button-background-color: $header_button_background_color;
        --header-button-hover-dark: $header_button_hover_dark;
        --header-button-hover-darker: $header_button_hover_darker;
    }
    </style>";

    //Link Colors
    if( have_rows('link_colors', 'option') ):
        while( have_rows('link_colors', 'option') ): the_row();

            $link_color = get_sub_field('link_color', 'option');
            $link_hover_color = get_sub_field('link_hover_color', 'option');
            $link_active_color = get_sub_field('link_active_color', 'option');

        endwhile;
    endif;

    // Output the custom styles with the ACF link color values
    echo "<style>
    :root {
        --link-color: $link_color;
        --link-hover-color: $link_hover_color;
        --link-active-color: $link_active_color;
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

    // Gradients
    //Function that converts HEx value to RGBA
    function hexToRgba($hex, $opacity) {
        // Remove the '#' if present
        $hex = ltrim($hex, '#');

        // Handle shorthand hex (e.g., '#abc' becomes '#aabbcc')
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) .
                str_repeat(substr($hex, 1, 1), 2) .
                str_repeat(substr($hex, 2, 1), 2);
        }

        // Convert hex to decimal (RGB values)
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        // Convert opacity to 0-1 scale
        $opacity = $opacity / 100;

        // Return the rgba color string
        return "rgba($r, $g, $b, $opacity)";
    }

    //Extracting the values from ACF fields
    if (have_rows('gradient_backgrounds', 'option')) :
        while (have_rows('gradient_backgrounds', 'option')) : the_row();
            
            // First Gradient
            if (have_rows('background_first_gradients', 'option')) :
                while (have_rows('background_first_gradients', 'option')) : the_row();

                    $firstGradientStartColor = get_sub_field('background_first_gradients_start_color', 'option');
                    $firstGradientStartColorOpacity = get_sub_field('background_first_gradients_start_color_opacity', 'option'); // Value 0-100
                    $firstGradientEndColor = get_sub_field('background_first_gradients_end_color', 'option');
                    $firstGradientEndColorOpacity = get_sub_field('background_first_gradients_end_color_opacity', 'option'); // Value 0-100

                    // Convert hex to rgba with opacity conversion
                    $firstGradientStartRgba = hexToRgba($firstGradientStartColor, $firstGradientStartColorOpacity);
                    $firstGradientEndRgba = hexToRgba($firstGradientEndColor, $firstGradientEndColorOpacity);

                    // Store as SCSS variables
                    echo "
                    <style>
                    :root { --first-gradient: linear-gradient(133.89deg, $firstGradientStartRgba -12.62%, $firstGradientEndRgba 61.05%); }
                    </style>
                    ";

                endwhile;
            endif;

            // Second Gradient
            if (have_rows('background_second_gradient', 'option')) :
                while (have_rows('background_second_gradient', 'option')) : the_row();

                    $secondGradientStartColor = get_sub_field('background_second_gradient_start_color', 'option');
                    $secondGradientStartColorOpacity = get_sub_field('background_second_gradient_start_color_opacity', 'option'); // Value 0-100
                    $secondGradientEndColor = get_sub_field('background_second_gradient_end_color', 'option');
                    $secondGradientEndColorOpacity = get_sub_field('background_second_gradient_end_color_opacity', 'option'); // Value 0-100

                    // Convert hex to rgba with opacity conversion
                    $secondGradientStartRgba = hexToRgba($secondGradientStartColor, $secondGradientStartColorOpacity);
                    $secondGradientEndRgba = hexToRgba($secondGradientEndColor, $secondGradientEndColorOpacity);

                    // Store as SCSS variables
                    echo "
                    <style>
                    :root { --second-gradient: linear-gradient(102.85deg, $secondGradientStartRgba -11.43%, $secondGradientEndRgba 101.61%); }
                    </style>
                    ";

                endwhile;
            endif;

            // Third Gradient
            if (have_rows('background_third_gradient', 'option')) :
                while (have_rows('background_third_gradient', 'option')) : the_row();

                    $thirdGradientStartColor = get_sub_field('background_third_gradient_start_color', 'option');
                    $thirdGradientStartColorOpacity = get_sub_field('background_third_gradient_start_color_opacity', 'option'); // Value 0-100
                    $thirdGradientEndColor = get_sub_field('background_third_gradient_end_color', 'option');
                    $thirdGradientEndColorOpacity = get_sub_field('background_third_gradient_end_color_opacity', 'option'); // Value 0-100

                    // Convert hex to rgba with opacity conversion
                    $thirdGradientStartRgba = hexToRgba($thirdGradientStartColor, $thirdGradientStartColorOpacity);
                    $thirdGradientEndRgba = hexToRgba($thirdGradientEndColor, $thirdGradientEndColorOpacity);

                    // Store as SCSS variables
                    echo "
                    <style>
                    :root { --third-gradient: linear-gradient(133.89deg, $thirdGradientStartRgba -12.62%, $thirdGradientEndRgba 61.05%); }
                    </style>
                    ";

                endwhile;
            endif;

        endwhile;
    endif;

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