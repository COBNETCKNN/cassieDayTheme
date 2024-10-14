<?php 
/**
 * Flexible content template for Homepage Hero Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'heroHome';
$default_id = 'heroHome';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
$showSprayDecoration = get_sub_field('show_section_spray_color_decoration');
if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> lg:h-[90vh] w-full bg-first-gradient relative py-20 lg:py-0">
    <div class="container mx-auto w-full h-full flex justify-center items-center">
        <div class="w-full mx-5 lg:mx-16">
            <div class="grid lg:grid-cols-2 gap-14 font-plus">
                <?php
                    $editorContent = get_sub_field('content_editor');
                    $alignment = get_sub_field('align_content');
                ?>
                <!-- Text Content -->
                <?php 
                    // Determine the alignment value for inline CSS
                    $alignment_style = '';
                    if ($alignment == 'left') {
                        $alignment_style = 'left';
                    } elseif ($alignment == 'center') {
                        $alignment_style = 'center';
                    } elseif ($alignment == 'right') {
                        $alignment_style = 'right';
                    }
                ?>
                <div class="homeEditorContent my-auto relative" style="text-align: <?php echo $alignment_style; ?>;">
                    <div class="homeEditorContent_wrapper relative">
                        <!-- Content -->
                        <?php echo $editorContent; ?>
                        <!-- Button -->
                        <?php get_template_part('partials/form', 'links-button'); ?>
                    </div>
                    <?php if($showSprayDecoration) { ?>
                    <svg class="homeDecoPurple" width="951" height="586" viewBox="0 0 951 586" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_f_78_2312)">
                        <ellipse cx="475.5" cy="293" rx="410.5" ry="228"/>
                        </g>
                        <defs>
                        <filter id="filter0_f_78_2312" x="0" y="0" width="951" height="586" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                        <feGaussianBlur stdDeviation="32.5" result="effect1_foregroundBlur_78_2312"/>
                        </filter>
                        </defs>
                    </svg>
                    <?php } ?>
                </div>
                <!-- Featured Image --> 
                <div class="flex justify-center lg:justify-end">
                    <?php
                        $featuredImage = get_sub_field('featured_image');
                        if( $featuredImage ):

                        // Image variables.
                        $url = $featuredImage['url'];
                        $alt = $featuredImage['alt'];
                        $size = 'hero-featured';
                        $thumb = $featuredImage['sizes'][ $size ]; ?>

                            <div class="homeHero_imageWrapper relative">
                                <div class="imageBorderWrapper p-2">
                                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                </div>
                            </div>

                        <?php endif; ?>
                 </div>
            </div>
        </div>
    </div>
    <?php if($showSprayDecoration) { ?>
        <!-- Deco svgs -->
        <svg class="heroDecoGreen" width="280" height="505" viewBox="0 0 280 505" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g opacity="1" filter="url(#filter0_f_78_2311)">
            <ellipse cx="11.5" cy="239" rx="111.5" ry="109" fill="#000"/>
            </g>
            <defs>
            <filter id="filter0_f_78_2311" x="-257" y="-27" width="537" height="532" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
            <feGaussianBlur stdDeviation="78.5" result="effect1_foregroundBlur_78_2311"/>
            </filter>
            </defs>
        </svg>
        <svg class="heroDecoPeach" width="278" height="463" viewBox="0 0 278 463" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_f_78_2313)">
            <ellipse cx="238.5" cy="231.5" rx="154.5" ry="147.5" fill="#000"/>
            </g>
            <defs>
            <filter id="filter0_f_78_2313" x="0" y="0" width="477" height="463" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
            <feGaussianBlur stdDeviation="42" result="effect1_foregroundBlur_78_2313"/>
            </filter>
            </defs>
        </svg>
    <?php } ?>
</section>

<?php } ?>