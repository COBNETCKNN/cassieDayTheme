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
if ($showSection) { ?>
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
                        <!-- Button -->
                         <div class="programsButton_wrapper">
                            <?php get_template_part('partials/form', 'links-button'); ?>
                         </div>
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
                              
                            <!-- Button -->
                            <div class="programsButton_wrapper">
                                <?php get_template_part('partials/form', 'links-button'); ?>
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