<?php 
/**
 * Flexible content template for Team Cards.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'pagesStartedCards';
$default_id = 'pagesStartedCards';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_started_cards($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_started_cards($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_started_cards($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_started_cards($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> bg-white relative font-plus">
    <div class="container mx-auto w-full h-full">
        <div class="mx-5 lg:mx-0">
            <?php
                $editorContent = get_sub_field('content_editor');
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
            <div class="pagesTeamCards my-auto relative lg:col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
                <div class="pagesEditor pagesTeamCards_wrapper relative mb-10 lg:mb-24">
                    <!-- Content -->
                    <?php echo $editorContent; ?>
                </div>
            </div>
        </div>
        <!-- Cards repeater-->
         <div class="startedCards_wrapper">
            <div class="grid md:grid-cols-3 gap-4 lg:gap-14">
                <?php if( have_rows('started_cards') ): ?>
                    <?php $cardIndex = 1; ?>
                    <?php while( have_rows('started_cards') ): the_row(); 
                        $startedCardsStep = get_sub_field('step');
                        $startedCardsDescription = get_sub_field('description');
                    ?>
                    <!-- Card -->
                    <div class="startedCards_card__wrapper startedCards_card__wrapper-<?php echo $cardIndex; ?> px-4 lg:px-7 py-10">
                        <div class="grid grid-cols-3 h-full">
                            <!-- Number -->
                            <div class="mx-auto">
                                <div class="startedCards_number__wrapper startedCards_number__wrapper-<?php echo $cardIndex; ?> col-span-1 flex justify-center items-center">
                                    <span>
                                        <?php echo sprintf('%02d', $cardIndex); ?>
                                    </span>
                                </div>
                                <!-- Deco line -->
                                <div class="outer outer-<?php echo $cardIndex; ?>">
                                    <div class="inner"></div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="col-span-2">
                                <div class="startedCards_title__wrapper flex justify-start items-center">
                                    <h5 class="startedCards_title"><?php echo $startedCardsStep; ?></h5>
                                </div>
                                <p class="startedCards_description mt-5"><?php echo $startedCardsDescription; ?></p>
                            </div>
                        </div>
                    </div>

                    <?php
                        $cardIndex++;
                    endwhile; ?>
                <?php endif; ?>
            </div>
         </div>
        <!-- Button -->
        <div class="classesPages my-auto relative col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
            <div class="pagesEditor classesPages_wrapper relative">
                <!-- Button -->
                 <div class="mt-5">
                    <?php get_template_part('partials/form', 'links-button'); ?>
                 </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>

<style>
    #<?php echo $default_id; ?> {
        padding: <?php echo $desktopSpacing; ?>;
    }

    @media (max-width: 1024px) {
        #<?php echo $default_id; ?> {
            padding: <?php echo $tabletSpacing; ?>;
        }
    }

    @media (max-width: 768px) {
        #<?php echo $default_id; ?> {
            padding: <?php echo $mobileSpacing; ?>;
        }
    }
</style>