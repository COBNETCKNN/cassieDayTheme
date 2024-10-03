<?php 

/**
 * Flexible content template for Programs Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('programs_settings_custom_html_class');
$custom_id = get_sub_field('programs_settings_custom_html_id');

// Set default values if the fields are empty (optional)
$default_class = 'homePrograms';
$default_id = 'homePrograms';

// Check if custom class or ID is provided, otherwise use defaults
$section_class = !empty($custom_class) ? esc_attr($custom_class) : $default_class;
$section_id = !empty($custom_id) ? esc_attr($custom_id) : $default_id;

$showSection = get_sub_field('programs_settings_show_section');
if($showSection) { ?>

 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> py-24 bg-white font-plus relative">
    <div class="container mx-auto">
    <!-- Content -->
     <?php if( have_rows('programs_content_group') ): ?>
        <?php while( have_rows('programs_content_group') ): the_row(); 
        
            $homeStepsEditor = get_sub_field('programs_editor');
            $alignment = get_sub_field('programs_align_content');

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

            <div class="homePrograms_content" style="text-align: <?php echo $alignment_style; ?>;">
                <?php echo $homeStepsEditor; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
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
        
        <div class="grid grid-cols-2 gap-14 my-24">
            <div class="programs_imageContent__imageWrapper my-auto relative">
                <div class="relative z-10">
                    <?php 
                        if( $imageContentFeaturedImage ) {
                            echo wp_get_attachment_image( $imageContentFeaturedImage, $imageContentFeaturedImageSize );
                        }
                    ?>
                </div>
                <!-- Background Colored Div -->
                <div class="imageContent_coloredBackground layout-<?php echo $layout_count; ?>"></div>
            </div>
            <div class="programs_imageContent__contentWrapper my-auto">
                <?php if( have_rows('image_content_group') ): ?>
                    <?php while( have_rows('image_content_group') ): the_row(); 
                        $imageContentEditor = get_sub_field('image_content_editor');
                    ?>
                        <?php echo $imageContentEditor; ?>
                        <?php
                        // Get the true/false values
                        $add_cta_button = get_sub_field('image_content_add_cta_button');
                        $add_custom_link = get_sub_field('image_content_add_custom_link');

                        // Get the Popup Form content and Custom Link
                        $popup_form_content = get_sub_field('image_content_popup_form_group');
                        $custom_link = get_sub_field('image_content_custom_link_group');

                        if ($add_cta_button || $add_custom_link) {
                            if ($add_cta_button && $popup_form_content) {
                                ?>
                                <button class="text-secondary bg-senary font-plus text-white rounded-lg text-sm font-bold uppercase tracking-tighter px-5 py-3 mt-10">
                                    <a class="programsButton_link" href="#">
                                        <?php echo esc_html($popup_form_content['cta_button_name']); ?>
                                    </a>
                                </button>
                                <?php
                            }
                            if ($add_custom_link && $custom_link) {
                                ?>
                                <button class="text-secondary bg-senary font-plus text-white rounded-lg text-sm font-bold uppercase tracking-tighter px-5 py-3 mt-10">
                                    <a class="programsButton_link" href="<?php echo esc_url($custom_link['custom_link_link']) ?>">
                                        <?php echo esc_html($custom_link['custom_link_button_name']); ?>
                                    </a>
                                </button>
                                <?php
                            }
                        }
                        ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Content Image Layout -->
        <?php elseif( $layout == 'content_image' ): ?>
            <div class="grid grid-cols-2 gap-14 my-24">
                <!-- Content -->
                <div class="relative">
                    <div class="programs_imageContent__contentWrapper my-auto">
                        <?php if( have_rows('content_image_group') ): ?>
                            <?php while( have_rows('content_image_group') ): the_row(); 
                                $contentImageEditor = get_sub_field('content_image_editor');
                            ?>
                                <?php echo $contentImageEditor; ?>
                                <?php
                                // Get the true/false values
                                $add_cta_button = get_sub_field('content_image_add_cta_button');
                                $add_custom_link = get_sub_field('content_image_add_custom_link');

                                // Get the Popup Form content and Custom Link
                                $popup_form_content = get_sub_field('content_image_popup_form_group');
                                $custom_link = get_sub_field('content_image_custom_link_group');

                                if ($add_cta_button || $add_custom_link) {
                                    if ($add_cta_button && $popup_form_content) {
                                        ?>
                                        <button class="text-secondary bg-senary font-plus text-white rounded-lg text-sm font-bold uppercase tracking-tighter px-5 py-3 mt-10">
                                            <a class="programsButton_link" href="#">
                                                <?php echo esc_html($popup_form_content['cta_button_name']); ?>
                                            </a>
                                        </button>
                                        <?php
                                    }
                                    if ($add_custom_link && $custom_link) {
                                        ?>
                                        <button class="text-secondary bg-senary font-plus text-white rounded-lg text-sm font-bold uppercase tracking-tighter px-5 py-3 mt-10">
                                            <a class="programsButton_link" href="<?php echo esc_url($custom_link['custom_link_link']) ?>">
                                                <?php echo esc_html($custom_link['custom_link_button_name']); ?>
                                            </a>
                                        </button>
                                        <?php
                                    }
                                }
                                ?>
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
                    <div class="relative z-10">
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