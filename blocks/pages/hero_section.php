<?php 
/**
 * Flexible content template for Homepage Hero Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'heroPages';
$default_id = 'heroPages';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
$showSprayDecoration = get_sub_field('show_section_spray_color_decoration');

if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> py-24 relative">
    <div class="container mx-auto w-full h-full flex justify-center items-center">
        <div class="w-full mx-5 lg:mx-16">
            <div class="grid lg:grid-cols-5 gap-14 lg:gap-5 font-plus relative z-10">
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
                <div class="heroPages my-auto relative lg:col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
                    <div class="heroPages_wrapper relative">
                        <!-- Content -->
                        <?php echo $editorContent; ?>
                        <!-- Button -->
                        <?php get_template_part('partials/form', 'links-button'); ?>
                    </div>
                </div>
                <!-- Featured Image --> 
                <div class="flex justify-center lg:justify-end lg:col-span-2">
                    <?php
                        $featuredImage = get_sub_field('featured_image');
                        if( $featuredImage ):

                        // Image variables.
                        $url = $featuredImage['url'];
                        $alt = $featuredImage['alt'];
                        $size = 'hero-featured';
                        $thumb = $featuredImage['sizes'][ $size ]; ?>

                            <div class="heroPages_imageWrapper relative">
                                <div class="heroPages_imageBorderWrapper">
                                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                </div>
                            </div>

                        <?php endif; ?>
                 </div>
            </div>
        </div>
    </div>
    <?php if($showSprayDecoration) { ?>
        <svg class="pagesHeroPinkDeco" width="576" height="516" viewBox="0 0 576 516" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g opacity="0.8" filter="url(#filter0_f_80_2918)">
            <ellipse cx="105" cy="305" rx="175" ry="157" fill="#FFCAF0"/>
            </g>
            <defs>
            <filter id="filter0_f_80_2918" x="-366" y="-148" width="942" height="906" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
            <feGaussianBlur stdDeviation="148" result="effect1_foregroundBlur_80_2918"/>
            </filter>
            </defs>
        </svg>
        <svg class="pagesHeroPurpleDeco" width="606" height="516" viewBox="0 0 606 516" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_f_80_2919)">
            <ellipse cx="494.5" cy="183.5" rx="154.5" ry="147.5" fill="#CCCAE8"/>
            </g>
            <defs>
            <filter id="filter0_f_80_2919" x="0" y="-304" width="989" height="975" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
            <feGaussianBlur stdDeviation="170" result="effect1_foregroundBlur_80_2919"/>
            </filter>
            </defs>
        </svg>
    <?php 
    } 
    ?>
</section>

<?php } ?>