<?php 

/**
 * Flexible content template for Get Strong section. 
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homeStrong';
$default_id = 'homeStrong';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
$showSprayDecoration = get_sub_field('show_section_spray_color_decoration');
if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> py-36 bg-section-primary font-plus">
    <div class="container mx-auto">
        <div class="grid grid-cols-2 gap-14">
            <!-- Featured Image -->
            <div class="relative my-auto">
                <div class="getStrong_decobox">
                </div>
                <div class="getStrong_image__wrapper">
                    <?php
                        $featuredImage = get_sub_field('featured_image');
                        if( $featuredImage ):

                        // Image variables.
                        $url = $featuredImage['url'];
                        $alt = $featuredImage['alt'];
                        $size = 'strong-featured';
                        $thumb = $featuredImage['sizes'][ $size ]; ?>

                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />

                    <?php endif; ?>
                </div>
            </div>
            <?php
                $editorContent = get_sub_field('content_editor');
                $alignment = get_sub_field('align_content');
            ?>

            <?php 
                //Text Alignment 
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

            <div class="my-auto relative" style="text-align: <?php echo $alignment_style; ?>;">
                <div class="getStrongContent_wrapper relative z-10 text-secondary">
                    <!-- Content -->
                    <?php echo $editorContent; ?>
                    <!-- Button -->
                    <?php get_template_part('partials/form', 'links-button'); ?>
                </div>
                <?php if($showSprayDecoration) { ?>
                    <!-- Section Spray Decoration -->
                    <svg class="getStrongDeco" width="834" height="505" viewBox="0 0 834 505" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_f_78_2374)">
                        <ellipse cx="417" cy="252.5" rx="300" ry="135.5" fill="#F0EFF8"/>
                        </g>
                        <defs>
                        <filter id="filter0_f_78_2374" x="0" y="0" width="834" height="505" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                        <feGaussianBlur stdDeviation="58.5" result="effect1_foregroundBlur_78_2374"/>
                        </filter>
                        </defs>
                    </svg>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php } ?>