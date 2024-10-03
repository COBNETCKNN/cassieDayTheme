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
            $primary_light_color = get_sub_field('primary_light_color', 'option');
            $secondary_color = get_sub_field('secondary_color', 'option');
            $tertiary_color = get_sub_field('tertiary_color', 'option');
            $quaternary_color = get_sub_field('quaternary_color', 'option');
            $quinary_color = get_sub_field('quinary_color', 'option');
            $senary_color = get_sub_field('senary_color', 'option');

        endwhile;
    endif;

    //Text Colors
    if( have_rows('text_colors', 'option') ):
        while( have_rows('text_colors', 'option') ): the_row();

            $primary_text_color = get_sub_field('primary_text_color', 'option');
            $primary_light_text_color = get_sub_field('primary_light_text_color', 'option');
            $secondary_text_color = get_sub_field('secondary_text_color', 'option');
            $tertiary_text_color = get_sub_field('tertiary_text_color', 'option');
            $quaternary_text_color = get_sub_field('quaternary_text_color', 'option');
            $quinary_text_color = get_sub_field('quinary_text_color', 'option');
            $senary_text_color = get_sub_field('senary_text_color', 'option');

        endwhile;
    endif;
    
    // Output the custom styles with the ACF color values
    echo "<style>
        :root {
            --primary-color: $primary_color;
            --primary-light-color: $primary_light_color;
            --secondary-color: $secondary_color;
            --tertiary-color: $tertiary_color;
            --quaternary-color: $quaternary_color;
            --quinary-color: $quinary_color;
            --senary-color: $senary_color;
            --primary-text-color: $primary_text_color;
            --primary-light-text-color: $primary_light_text_color;
            --secondary-text-color: $secondary_text_color;
            --tertiary-text-color: $tertiary_text_color;
            --quaternary-text-color: $quaternary_text_color;
            --quinary-text-color: $quinary_text_color;
            --senary-text-color: $senary_text_color;
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