<?php 

/**
 * Flexible content template for Get Strong section. 
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('get_strong_custom_html_class');
$custom_id = get_sub_field('get_strong_custom_html_id');

// Set default values if the fields are empty (optional)
$default_class = 'homeGetStrong';
$default_id = 'homeGetStrong';

// Check if custom class or ID is provided, otherwise use defaults
$section_class = !empty($custom_class) ? esc_attr($custom_class) : $default_class;
$section_id = !empty($custom_id) ? esc_attr($custom_id) : $default_id;

$showSection = get_sub_field('get_strong_show_section');
if($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> py-36 bg-white font-plus">
    <div class="container mx-auto">
        <div class="grid grid-cols-2 gap-14">
        <?php if( have_rows('get_started_content') ): ?>
            <?php while( have_rows('get_started_content') ): the_row(); 
            
                $featuredImage = get_sub_field('get_strong_featured_image');
                $featuredImageSize = 'strong-featured';
                $editorContent = get_sub_field('get_strong_editor');
                $alignment = get_sub_field('get_strong_align_content');
                ?>

                <?php 
                    //Text Alignment 
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
                <!-- Featured Image -->
                <div class="relative my-auto">
                    <div class="getStrong_decobox">
                    </div>
                    <div class="getStrong_image__wrapper">
                        <?php 
                        if( $featuredImage ) {
                            echo wp_get_attachment_image( $featuredImage, $featuredImageSize );
                        }
                        ?>
                    </div>
                </div>
                <!-- Content -->
                <div class="my-auto" style="text-align: <?php echo $alignment_style; ?>;">
                    <?php echo $editorContent; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                    <?php
                    //Button
                    // Get the true/false values
                    $add_cta_button = get_sub_field('get_strong_add_cta_button');
                    $add_custom_link = get_sub_field('get_strong_add_custom_link');

                    // Get the Popup Form content and Custom Link
                    $popup_form_content = get_sub_field('get_strong_popup_form');
                    $custom_link = get_sub_field('get_strong_custom_link');

                    if ($add_cta_button || $add_custom_link) {
                        if ($add_cta_button && $popup_form_content) {
                            ?>
                            <button class="cta-button font-plus text-white bg-primary rounded-xl text-base font-bold uppercase tracking-tighter px-10 py-4 mt-10">
                                <a href="#">
                                    <?php echo esc_html($popup_form_content['get_strong_cta_button_name']); ?>
                                </a>
                            </button>
                            <?php
                        }
                        if ($add_custom_link && $custom_link) {
                            ?>
                            <button class="cta-button font-plus text-white bg-primary rounded-xl text-base font-bold uppercase tracking-tighter px-10 py-4 mt-10">
                                <a href="<?php echo esc_url($custom_link['get_strong_custom_link_link']) ?>">
                                    <?php echo esc_html($custom_link['get_strong_custom_button_name']); ?>
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