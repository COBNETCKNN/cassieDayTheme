<?php 
/**
 * Flexible content template for Steps Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homeSteps';
$default_id = 'homeSteps';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> font-plus relative">
    <div class="container mx-auto py-28">
        <div class="grid grid-cols-4 gap-6">
        <?php
            $stepsContent = get_sub_field('content_editor');
            $alignment = get_sub_field('align_content');
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
        <div class="my-auto text-secondary" style="text-align: <?php echo $alignment_style; ?>;">
            <!-- Content -->
            <?php echo $stepsContent; ?>
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

            <div class="stepCard_wrapper bg-section-primary px-7 py-10 rounded-2xl relative z-10">
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
                <div class="stepsCard_content font-medium font-plus text-xl text-primary leading-7 mt-10">
                    <?php echo $stepsDescription; ?>
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
