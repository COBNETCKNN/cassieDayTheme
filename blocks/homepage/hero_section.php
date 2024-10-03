<?php 
/**
 * Flexible content template for Homepage Hero Section.
 */

  // Retrieve custom class and ID from the ACF fields
  $custom_class = get_sub_field('home_hero_section_content_group_custom_html_class');
  $custom_id = get_sub_field('home_hero_section_content_group_custom_html_id');
  
  // Set default values if the fields are empty (optional)
  $default_class = 'heroHome';
  $default_id = 'heroHome';
  
  // Check if custom class or ID is provided, otherwise use defaults
  $section_class = !empty($custom_class) ? esc_attr($custom_class) : $default_class;
  $section_id = !empty($custom_id) ? esc_attr($custom_id) : $default_id;
 
 $showSection = get_sub_field('home_hero_section_content_group_show_section');
 if($showSection) { ?>

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
                        <!-- Button -->
                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php
                    // Get the true/false values
                    $add_cta_button = get_sub_field('home_hero_add_cta_button');
                    $add_custom_link = get_sub_field('home_hero_add_custom_link');

                    // Get the Popup Form content and Custom Link
                    $popup_form_content = get_sub_field('home_hero_popup_content');
                    $custom_link = get_sub_field('home_hero_custom_link_content');

                    if ($add_cta_button || $add_custom_link) {
                        if ($add_cta_button && $popup_form_content) {
                            ?>
                            <button class="cta-button font-plus text-white bg-primary rounded-xl text-base font-bold uppercase tracking-tighter px-10 py-4 mt-10">
                                <a href="#">
                                    <?php echo esc_html($popup_form_content['form_links_popup_form_button_name']); ?>
                                </a>
                            </button>
                            <?php
                        }
                        if ($add_custom_link && $custom_link) {
                            ?>
                            <button class="cta-button font-plus text-white bg-primary rounded-xl text-base font-bold uppercase tracking-tighter px-10 py-4 mt-10">
                                <a href="<?php echo esc_url($custom_link['custom_link_link']) ?>">
                                    <?php echo esc_html($custom_link['custom_link_button_name']); ?>
                                </a>
                            </button>
                            <?php
                        }

                    }
                    ?>
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