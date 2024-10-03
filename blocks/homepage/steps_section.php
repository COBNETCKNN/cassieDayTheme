<?php 
/**
 * Flexible content template for Steps Section.
 */

 // Retrieve custom class and ID from the ACF fields
 $custom_class = get_sub_field('steps_cards_custom_html_class');
 $custom_id = get_sub_field('steps_cards_custom_html_id');
 
 // Set default values if the fields are empty (optional)
 $default_class = 'homeStepsClass';
 $default_id = 'homeStepsID';
 
 // Check if custom class or ID is provided, otherwise use defaults
 $section_class = !empty($custom_class) ? esc_attr($custom_class) : $default_class;
 $section_id = !empty($custom_id) ? esc_attr($custom_id) : $default_id;

$showSection = get_sub_field('steps_cards_show_section');
if($showSection) { ?>

    <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> bg-white font-plus relative">
        <div class="container mx-auto py-28">
            <div class="grid grid-cols-4 gap-6">
            <!-- Heading -->
            <?php 
            $stepsHeading = get_sub_field('steps_section_heading');
            ?>
            <div class="my-auto">
                <?php echo $stepsHeading; ?>
            </div>
            <!-- Card Repeater -->
            <?php 
            $counter = 1;
            
            ?>
            <?php if( have_rows('steps_cards') ): ?>
                <?php while( have_rows('steps_cards') ): the_row(); 
                
                $stepsIcon = get_sub_field('steps_card_icon');
                $stepsIconSize = 'social-media';
                $stepsDescription = get_sub_field('steps_card_description');
                $formatted_number = sprintf('%02d', $counter);
                ?>

                <div class="stepCard_wrapper bg-secondary px-7 py-10 rounded-2xl shadow-lg relative z-10">
                    <div class="numberIcon_wrapper flex justify-between">
                        <span class="stepsCard_span stepCard_counter<?php echo $counter; ?> font-plus font-extrabold leading-none opacity-40 my-auto"><?php echo $formatted_number; ?></span>
                        <div class="iconRounded_wrapper">
                            <?php 
                                if( $stepsIcon ) {
                                    echo wp_get_attachment_image( $stepsIcon, $stepsIconSize );
                                }
                            ?>
                        </div>
                    </div>
                    <div class="stepsCard_content font-medium font-plus text-xl text-primary-light leading-7 mt-10">
                        <?php echo $stepsDescription; ?>
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

                <?php 
                $counter++;
                ?>

                <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
        <?php 
        //Section shape decoration at the bottom of the section
        $sectionDecoration = get_sub_field('show_section_decoration');

        if($sectionDecoration) { ?>
            <img class="cardsSection_decorativeShape" src="<?php echo get_template_directory_uri() . '/assets/svgs/cardsSection_shape.svg'; ?>" alt="Decorative SVG"/>
        <?php } ?>
    </section>

<?php } ?>
