<?php 

/**
 * Flexible content template for Guide Section
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homeGuide';
$default_id = 'homeGuide';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
if ($showSection) { ?>

 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> py-24 bg-white font-plus">
    <div class="container mx-auto">
        <div class="grid grid-cols-5 gap-4 mx-14">
            <?php
                $guideFeaturedImage = get_sub_field('guide_featured_image');
                $guideFeaturedImageSize = 'guide-featured';
            ?>
            <!-- Featured Image -->
            <div class="guideFeatured_wrapper col-span-2 my-auto">
            <?php
                $featuredImage = get_sub_field('featured_image');
                if( $featuredImage ):

                // Image variables.
                $url = $featuredImage['url'];
                $alt = $featuredImage['alt'];
                $size = 'guide-featured';
                $thumb = $featuredImage['sizes'][ $size ]; ?>

                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />

                <?php endif; ?>
            </div>
            <!-- Content -->
            <div class="guideContent_wrapper col-span-3 my-auto">
                <?php 
                $guideEditor = get_sub_field('content_editor');
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
                <!-- Content -->
                <?php echo $guideEditor; ?>
                <!-- Button -->
                <?php get_template_part('partials/form', 'links-button'); ?>
            </div>
        </div>
    </div>
 </section>

 <?php } ?>