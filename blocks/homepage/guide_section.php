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
            <?php if( have_rows('guide_section_content') ): ?>
                <?php while( have_rows('guide_section_content') ): the_row(); 
                
                $guideFeaturedImage = get_sub_field('guide_featured_image');
                $guideFeaturedImageSize = 'guide-featured';
                ?>
                <!-- Featured Image -->
                <div class="guideFeatured_wrapper col-span-2 my-auto">
                    <?php 
                        if( $guideFeaturedImage ) {
                            echo wp_get_attachment_image( $guideFeaturedImage, $guideFeaturedImageSize );
                        }
                    ?>
                </div>
                <!-- Content -->
                <div class="guideContent_wrapper col-span-3 my-auto">
                    <?php 
                    $guideEditor = get_sub_field('guide_editor');
                    $alignment = get_sub_field('guide_align_content');

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
                <?php endwhile; ?>
            <?php endif; ?>
                    <!-- Button -->
                    <?php
                    // Get the true/false values
                    $add_cta_button = get_sub_field('guide_form_links_add_cta_button');
                    $add_custom_link = get_sub_field('guide_form_links_add_custom_link');

                    // Get the Popup Form content and Custom Link
                    $popup_form_content = get_sub_field('guide_form_links_popup_form_group');
                    $custom_link = get_sub_field('guide_form_links_custom_link_group');

                    if ($add_cta_button || $add_custom_link) {
                        if ($add_cta_button && $popup_form_content) {
                            ?>
                            <button class="cta-button font-plus text-white bg-primary rounded-xl text-base font-bold uppercase tracking-tighter px-10 py-4 mt-10">
                                <a class="programsButton_link" href="#">
                                    <?php echo esc_html($popup_form_content['cta_button_name']); ?>
                                </a>
                            </button>
                            <?php
                        }
                        if ($add_custom_link && $custom_link) {
                            ?>
                            <button class="cta-button font-plus text-white bg-primary rounded-xl text-base font-bold uppercase tracking-tighter px-10 py-4 mt-10">
                                <a class="programsButton_link" href="<?php echo esc_url($custom_link['custom_link_button_link']) ?>">
                                    <?php echo esc_html($custom_link['custom_link_button_name']); ?>
                                </a>
                            </button>
                            <?php
                        }
                    }
                    ?>
                </div>
        </div>
    </div>
 </section>

 <?php } ?>