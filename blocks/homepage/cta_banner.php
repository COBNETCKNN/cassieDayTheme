<?php 

/**
 * Flexible content template for CTA Banner.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homeBanner';
$default_id = 'homeBanner';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
if ($showSection) { ?>

 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> pt-32 bg-section-primary font-plus text-secondary">
    <div class="container mx-auto relative">
        <div class="bannerWrapper bg-second-gradient py-20 px-5 rounded-2xl">
            <div class="banner_content relative z-10" style="text-align: <?php echo $alignment_style; ?>;">
                <?php              
                    $reviewsEditor = get_sub_field('content_editor');
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
                <?php echo $reviewsEditor; ?>
                <!-- Button -->
                 <div class="bannerButton_wrapper">
                    <?php get_template_part('partials/form', 'links-button'); ?>
                 </div>
            </div>
        </div>
        <!-- Banner Decoration -->
        <?php 
        $sectionDecoration = get_sub_field('show_section_decoration');

        if($sectionDecoration) { ?>
            <img class="bannerDecoration" src="<?php echo get_template_directory_uri() . '/assets/svgs/banner_decoration.svg'; ?>" alt="Decorative SVG"/>
        <?php } ?>
    </div>
 </section>

 <?php } ?>