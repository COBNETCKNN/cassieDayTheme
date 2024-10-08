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
if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> h-[90vh] w-full bg-first-gradient">
    <div class="container mx-auto w-full h-full flex justify-center items-center">
        <div class="w-full mx-16">
            <div class="grid grid-cols-2 gap-14 font-plus">
                <?php if( have_rows('home_hero_content_group') ): ?>
                    <?php while( have_rows('home_hero_content_group') ): the_row(); 
                    
                    $editorContent = get_sub_field('content_editor');
                    $alignment = get_sub_field('content_align_content');

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
                    <div class="homeEditorContent my-auto" style="text-align: <?php echo $alignment_style; ?>;">
                        <!-- Content -->
                        <?php echo $editorContent; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <!-- Button -->
                    <?php get_template_part('partials/form', 'links-button'); ?>
                </div>
                <!-- Featured Image --> 
                 <div class="flex justify-end">
                    <?php if( have_rows('home_hero_content_group') ): ?>
                        <?php while( have_rows('home_hero_content_group') ): the_row(); 
                        $featuredImage = get_sub_field('featured_image');
                        $featuredImageSize = 'hero-featured';
                        ?>

                            <div class="homeHero_imageWrapper ">
                                <div class="imageBorderWrapper p-2">
                                    <?php 
                                        if( $featuredImage ) {
                                            echo wp_get_attachment_image( $featuredImage, $featuredImageSize );
                                        }
                                    ?>
                                </div>

                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                 </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>