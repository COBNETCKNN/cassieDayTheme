<?php 

/**
 * Flexible content template for Programs Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homePrograms';
$default_id = 'homePrograms';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_programs($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_programs($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_programs($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_programs($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>
 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> bg-section-secondary font-plus relative">
    <div class="container mx-auto">
    <!-- Content -->
     <?php 
    $homeStepsEditor = get_sub_field('content_editor');
    $alignment = get_sub_field('align_content');

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


    <div class="homePrograms_content mx-5 md:mx-0" style="text-align: <?php echo $alignment_style; ?>;">
        <?php echo $homeStepsEditor; ?>
    </div>
    <!-- Flexible Programs Content -->
    <?php if( have_rows('programs_flexible_content') ): ?>
    <?php $layout_count = 0; // Initialize counter ?>
    
    <?php while( have_rows('programs_flexible_content') ): the_row(); 
        $layout_count++; // Increment counter on each iteration
        $layout = get_row_layout();
    ?>

    <!-- Image Content Layout -->
    <?php if( $layout == 'image_content' ): ?>
        <?php
            $imageContentFeaturedImage = get_sub_field('image_content_featured_image');
            $imageContentFeaturedImageSize = 'programs-featured';
        ?>
        
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-32 my-7 lg:my-24 mx-5 md:mx-0">
            <div class="programs_imageContent__imageWrapper my-auto relative">
                <div class="programsImageContent_image relative z-10">
                    <?php 
                        if( $imageContentFeaturedImage ) {
                            echo wp_get_attachment_image( $imageContentFeaturedImage, $imageContentFeaturedImageSize );
                        }
                    ?>
                </div>
                <!-- Background Colored Div -->
                <div class="imageContent_coloredBackground layout-<?php echo $layout_count; ?>"></div>
            </div>
            <div class="programs_imageContent__contentWrapper my-auto relative z-10">
                <?php if( have_rows('image_content_group') ): ?>
                    <?php while( have_rows('image_content_group') ): the_row(); 
                        $imageContentEditor = get_sub_field('image_content_editor');
                    ?>
                        <?php echo $imageContentEditor; ?>
                        <!-- Button -->
                         <div class="programsButton_wrapper">
                            <?php 
                                    // Get the true/false values
                                $add_button = get_sub_field('add_button');
                                $add_custom_link = get_sub_field('add_custom_link');
                                
                                // Get the Popup Form content and Custom Link
                                $popup_form_content = get_sub_field('popup_form_group');
                                $custom_link = get_sub_field('custom_link');
                                
                                // Check if popup form ID is available
                                $form_id = isset($popup_form_content['cta_select_form']) && is_object($popup_form_content['cta_select_form']) 
                                            ? $popup_form_content['cta_select_form']->ID 
                                            : null;
                                
                                // Prioritize the custom link over the CTA button
                                if ($add_custom_link && $custom_link) {
                                    $custom_link_url = $custom_link['url'];
                                    $custom_link_title = $custom_link['title'];
                                    ?>
                                    <button class="button-secondary font-plus rounded-xl text-sm font-bold uppercase mt-5 lg:mt-10">
                                        <a class="px-6 py-3 block" href="<?php echo esc_url($custom_link_url); ?>"><?php echo esc_html($custom_link_title); ?></a>
                                    </button>
                                    <?php
                                } elseif ($add_button && $popup_form_content && $form_id) {
                                    ?>
                                    <button class="cta-button button-secondary font-plus rounded-xl text-sm font-bold uppercase mt-5 lg:mt-10"
                                        data-form-id="<?php echo esc_attr($form_id); ?>">
                                        <a class="px-6 py-3 block" href=""><?php echo esc_html($popup_form_content['cta_button_name']); ?></a>
                                    </button>
                                    <?php
                                }
                            ?>
                         </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Content Image Layout -->
        <?php elseif( $layout == 'content_image' ): ?>
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-32 my-24 mx-5 md:mx-0">
                <!-- Content -->
                <div class="relative order-last lg:order-none">
                    <div class="programs_imageContent__contentWrapper my-auto relative z-10">
                        <?php if( have_rows('content_image_group') ): ?>
                            <?php while( have_rows('content_image_group') ): the_row(); 
                                $contentImageEditor = get_sub_field('content_image_editor');
                            ?>
                                <?php echo $contentImageEditor; ?>
                              
                            <!-- Button -->
                            <div class="programsButton_wrapper">
                                <?php 
                                 // Get the true/false values
                                $add_button = get_sub_field('add_button');
                                $add_custom_link = get_sub_field('add_custom_link');
                                
                                // Get the Popup Form content and Custom Link
                                $popup_form_content = get_sub_field('popup_form_group');
                                $custom_link = get_sub_field('custom_link');
                                
                                // Check if popup form ID is available
                                $form_id = isset($popup_form_content['cta_select_form']) && is_object($popup_form_content['cta_select_form']) 
                                            ? $popup_form_content['cta_select_form']->ID 
                                            : null;
                                
                                // Prioritize the custom link over the CTA button
                                if ($add_custom_link && $custom_link) {
                                    $custom_link_url = $custom_link['url'];
                                    $custom_link_title = $custom_link['title'];
                                    ?>
                                    <button class="button-secondary font-plus rounded-xl text-sm font-bold uppercase mt-5 lg:mt-10">
                                        <a class="px-6 py-3 block" href="<?php echo esc_url($custom_link_url); ?>"><?php echo esc_html($custom_link_title); ?></a>
                                    </button>
                                    <?php
                                } elseif ($add_button && $popup_form_content && $form_id) {
                                    ?>
                                    <button class="cta-button button-secondary font-plus rounded-xl text-sm font-bold uppercase mt-5 lg:mt-10"
                                        data-form-id="<?php echo esc_attr($form_id); ?>">
                                        <a class="px-6 py-3 block"><?php echo esc_html($popup_form_content['cta_button_name']); ?></a>
                                    </button>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Featured Image -->
                <?php 
                    $contentImageFeaturedImage = get_sub_field('content_image_featured_image');
                    $contentImageFeaturedImageSize = 'programs-featured';
                ?>
                <div class="programs_contentImage__imageWrapper my-auto relative">
                    <div class="programsContentImage_image relative z-10">
                        <?php 
                            if( $contentImageFeaturedImage ) {
                                echo wp_get_attachment_image( $contentImageFeaturedImage, $contentImageFeaturedImageSize );
                            }
                        ?>
                    </div>
                    <!-- Background Colored Div -->
                    <div class="contentImage_coloredBackground layout-<?php echo $layout_count; ?>"></div>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
    </div>
    <?php 
        $sectionDecoration = get_sub_field('show_section_decoration');

        if($sectionDecoration) { ?>
            <img class="programsDecoration" src="<?php echo get_template_directory_uri() . '/assets/svgs/programs_decoration.svg'; ?>" alt="Decorative SVG"/>
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