<?php 
/**
 * Flexible content template for Two Column Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'twoColumnPages';
$default_id = 'twoColumnPages';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
$showSprayDecoration = get_sub_field('show_section_spray_color_decoration');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_classes($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_classes($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_classes($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_classes($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> font-plus relative">
    <div class="container mx-auto w-full h-full">
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
        <div class="twoColumnPages my-auto relative col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
            <div class="pagesEditor twoColumnPages_wrapper relative">
                <!-- Content -->
                <?php echo $editorContent; ?>
                <!-- Button -->
                <?php get_template_part('partials/form', 'links-button'); ?>
            </div>
        </div>
        <!-- Flexible fields -->
            <div class="my-24">
            <?php if( have_rows('two_column_layout') ): ?>
                <?php while( have_rows('two_column_layout') ): the_row(); 
                    $layout = get_row_layout();
                ?>

                <!-- Image Content Layout -->
                <?php if( $layout == 'image_content' ): ?>         
                    <div class="grid lg:grid-cols-6 gap-4 my-10 lg:my-20 relative z-10">
                        <!-- Image -->
                        <div class="lg:col-span-2">
                            <?php
                                $imageContentFeatured = get_sub_field('featured_image');
                                if( $imageContentFeatured ):

                                // Image variables.
                                $url = $imageContentFeatured['url'];
                                $alt = $imageContentFeatured['alt'];
                                $size = 'guide-featured';
                                $thumb = $imageContentFeatured['sizes'][ $size ]; ?>

                                    <div class="twoColumnsPages_image__wrapper h-full w-full relative my-auto">
                                        <div class="imageContentWrapper h-full w-full flex justify-center items-center">
                                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                        </div>
                                    </div>

                                <?php endif; 
                            ?>
                        </div>
                        <!-- Content -->
                        <div class="twoColumnPages_flexibleContent__wrapper lg:col-span-4 px-14 py-8 rounded-3xl">
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
                                <div class="twoColumnsContent my-auto relative" style="text-align: <?php echo $alignment_style; ?>;">
                                    <div class="twoColumnsContent_wrapper relative my-7">
                                        <!-- Content -->
                                        <?php echo $editorContent; ?>
                                        <!-- Button -->
                                        <div class="classPageFlexibleButton_wrapper my-3">
                                            <?php get_template_part('partials/form', 'links-button'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Content Image Layout -->
                    <?php elseif( $layout == 'content_image' ): ?>
                        <div class="grid lg:grid-cols-6 gap-4 lg:my-20 relative z-10">
                            <!-- Content -->
                            <div class="twoColumnPages_flexibleContent__wrapper lg:col-span-4 px-14 py-8 rounded-3xl order-last lg:order-first">
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
                                    <div class="twoColumnsContent my-auto relative" style="text-align: <?php echo $alignment_style; ?>;">
                                        <div class="twoColumnsContent_wrapper relative my-7">
                                            <!-- Content -->
                                            <?php echo $editorContent; ?>
                                            <!-- Button -->
                                            <div class="classPageFlexibleButton_wrapper my-3">
                                                <?php get_template_part('partials/form', 'links-button'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Image -->
                                <div class="lg:col-span-2">
                                    <?php
                                        $imageContentFeatured = get_sub_field('featured_image');
                                        if( $imageContentFeatured ):

                                        // Image variables.
                                        $url = $imageContentFeatured['url'];
                                        $alt = $imageContentFeatured['alt'];
                                        $size = 'guide-featured';
                                        $thumb = $imageContentFeatured['sizes'][ $size ]; ?>

                                            <div class="twoColumnsPages_image__wrapper h-full w-full relative my-auto">
                                                <div class="contentImageWrapper h-full w-full flex justify-center items-center">
                                                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                                </div>
                                                <svg class="twoColumnImageDeco" width="604" height="595" viewBox="0 0 604 595" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.7" filter="url(#filter0_f_97_4206)">
                                                    <ellipse cx="302" cy="297.5" rx="100" ry="95.5" fill="#A2D3BA"/>
                                                    </g>
                                                    <defs>
                                                    <filter id="filter0_f_97_4206" x="0" y="0" width="604" height="595" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                                                    <feGaussianBlur stdDeviation="101" result="effect1_foregroundBlur_97_4206"/>
                                                    </filter>
                                                    </defs>
                                                </svg>
                                            </div>

                                        <?php endif; 
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if($showSprayDecoration) { ?>
        <svg class="twoColumnSectionDeco" width="401" height="513" viewBox="0 0 401 513" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_f_97_4205)">
            <ellipse cx="-21.5" cy="96.5" rx="130.5" ry="124.5" fill="#CCCAE8"/>
            </g>
            <defs>
            <filter id="filter0_f_97_4205" x="-444" y="-320" width="845" height="833" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
            <feGaussianBlur stdDeviation="146" result="effect1_foregroundBlur_97_4205"/>
            </filter>
            </defs>
        </svg>
    <?php } ?>
</section>

<?php } ?>

<style>
    #<?php echo $default_id; ?> {
        padding: <?php echo $desktopSpacing; ?>;
    }

    @media (max-width: 1024px) {
        #<?php echo $default_id; ?> {
            padding: <?php echo $tabletSpacing; ?>;
        }
    }

    @media (max-width: 768px) {
        #<?php echo $default_id; ?> {
            padding: <?php echo $mobileSpacing; ?>;
        }
    }
</style>