<?php 

/**
 * Flexible content template for CTA Banner.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('cta_banner_settings_custom_html_class');
$custom_id = get_sub_field('cta_banner_settings_custom_html_id');

// Set default values if the fields are empty (optional)
$default_class = 'ctaBanner';
$default_id = 'ctaBanner';

// Check if custom class or ID is provided, otherwise use defaults
$section_class = !empty($custom_class) ? esc_attr($custom_class) : $default_class;
$section_id = !empty($custom_id) ? esc_attr($custom_id) : $default_id;

$showSection = get_sub_field('cta_banner_settings_show_section');
if($showSection) { 
?>

 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> py-20 bg-white font-plus text-secondary">
    <div class="container mx-auto relative">
        <div class="bannerWrapper bg-second-gradient py-20 px-5 rounded-2xl">
            <div class="banner_content relative z-10" style="text-align: <?php echo $alignment_style; ?>;">
                <?php if( have_rows('cta_content_group') ): ?>
                    <?php while( have_rows('cta_content_group') ): the_row(); 
                    
                        $reviewsEditor = get_sub_field('cta_banner_editor');
                        $alignment = get_sub_field('cta_banner_align_content');

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
                    <?php endwhile; ?>
                <?php endif; ?>
                <!-- Button -->
                <?php
                // Get the true/false values
                $add_cta_button = get_sub_field('cta_banner_add_cta_button');
                $add_custom_link = get_sub_field('cta_banner_add_custom_link');

                // Get the Popup Form content and Custom Link
                $popup_form_content = get_sub_field('cta_banner_popup_form_group');
                $custom_link = get_sub_field('cta_banner_custom_link_group');

                if ($add_cta_button || $add_custom_link) {
                    if ($add_cta_button && $popup_form_content) {
                        ?>
                        <button class="bannerButton font-plus text-white rounded-xl text-sm font-bold uppercase tracking-tighter px-7 py-4 mt-5">
                            <a class="programsButton_link" href="#">
                                <?php echo esc_html($popup_form_content['cta_button_name']); ?>
                            </a>
                        </button>
                        <?php
                    }
                    if ($add_custom_link && $custom_link) {
                        ?>
                        <button class="bannerButton font-plus text-white rounded-xl text-sm font-bold uppercase tracking-tighter px-7 py-4 mt-5">
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
        <!-- Banner Decoration -->
        <?php 
        $sectionDecoration = get_sub_field('show_banner_decoration');

        if($sectionDecoration) { ?>
            <img class="bannerDecoration" src="<?php echo get_template_directory_uri() . '/assets/svgs/banner_decoration.svg'; ?>" alt="Decorative SVG"/>
        <?php } ?>
    </div>
 </section>

 <?php } ?>