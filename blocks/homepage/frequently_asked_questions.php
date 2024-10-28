<?php 
/**
 * Flexible content template for Team Cards.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homeFaq';
$default_id = 'homeFaq';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_homeFaq($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_homeFaq($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_homeFaq($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_homeFaq($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> py-24 relative font-plus">
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
            <div class="pagesFaq my-auto relative lg:col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
                <div class="pagesFaq_wrapper relative mb-14 text-secondary">
                    <!-- Content -->
                    <?php echo $editorContent; ?>
                    <!-- Button -->
                    <?php get_template_part('partials/form', 'links-button'); ?>
                </div>
            </div>
            <!-- Questions repeater -->
             <div id="faqContainer" class="font-plus">
                <?php if( have_rows('faq_questions') ): ?>
                    <?php 
                        $index = 1;
                        while( have_rows('faq_questions') ): the_row(); 
                        $frequentQuestions = get_sub_field('question');
                        $frequentAnswer = get_sub_field('answer');
                        $unique_id = 'id' . $index;
                    ?>

                        <div class="accordion_item__wrapper w-[100%] lg:w-[48%] m-2" id="<?php echo $unique_id; ?>">
                            <div class="accordion accordion__item px-5 flex justify-between items-center">
                                <span>
                                    <?php echo $frequentQuestions; ?>
                                </span>
                                <svg class="accordionIcon" width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.41385 0.5H12.5859C12.7836 0.500042 12.9769 0.558714 13.1413 0.668598C13.3057 0.778482 13.4339 0.934646 13.5095 1.11735C13.5852 1.30005 13.605 1.50108 13.5664 1.69503C13.5279 1.88898 13.4327 2.06715 13.2929 2.207L7.70685 7.793C7.51932 7.98047 7.26501 8.08579 6.99985 8.08579C6.73469 8.08579 6.48038 7.98047 6.29285 7.793L0.706849 2.207C0.56704 2.06715 0.471833 1.88898 0.433266 1.69503C0.394698 1.50108 0.414502 1.30005 0.490172 1.11735C0.565842 0.934646 0.693981 0.778482 0.858391 0.668598C1.0228 0.558714 1.2161 0.500042 1.41385 0.5Z" fill="#9388CA"/>
                                </svg>
                            </div>
                            <div class="panel">
                                <p><?php echo $frequentAnswer; ?></p>
                            </div>
                        </div>

                        <?php 
                        $index++;
                    endwhile; ?>
                <?php endif; ?>
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