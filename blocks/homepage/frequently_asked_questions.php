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
             <div class="homeFaq_wrapper font-plus">
                <div class="accordion">
                    <?php if( have_rows('faq_questions') ): ?>
                        <?php 
                        $index = 1;
                        while( have_rows('faq_questions') ): the_row(); 
                            $frequentQuestions = get_sub_field('question');
                            $frequentAnswer = get_sub_field('answer');
                            $unique_id = 'faq' . $index;
                        ?>
                            <div class="accordion__item">
                                <div class="accordion__header flex justify-between items-center" data-toggle="#<?php echo $unique_id; ?>">
                                    <span><?php echo esc_html($frequentQuestions); ?></span>
                                    <svg class="accordionDownIcon" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.0981 6.54499C15.9821 6.42883 15.8442 6.33668 15.6925 6.27382C15.5408 6.21095 15.3782 6.17859 15.214 6.17859C15.0498 6.17859 14.8871 6.21095 14.7354 6.27382C14.5837 6.33668 14.4459 6.42883 14.3298 6.54499L10.5081 10.3658C10.43 10.4439 10.324 10.4878 10.2136 10.4878C10.1031 10.4878 9.99711 10.4439 9.91897 10.3658L6.09814 6.54499C5.86375 6.31049 5.54582 6.17871 5.21427 6.17863C4.88272 6.17855 4.56472 6.31019 4.33022 6.54457C4.09573 6.77896 3.96395 7.0969 3.96387 7.42844C3.96379 7.75999 4.09542 8.07799 4.32981 8.31249L8.15147 12.1342C8.42231 12.405 8.74386 12.6199 9.09774 12.7665C9.45163 12.9131 9.83093 12.9885 10.214 12.9885C10.597 12.9885 10.9763 12.9131 11.3302 12.7665C11.6841 12.6199 12.0056 12.405 12.2765 12.1342L16.0981 8.31249C16.3325 8.07808 16.4641 7.76019 16.4641 7.42874C16.4641 7.09728 16.3325 6.7794 16.0981 6.54499Z" fill="#FF63CB"/>
                                    </svg>
                                </div>
                                <div class="accordion__content" id="<?php echo $unique_id; ?>">
                                    <p><?php echo esc_html($frequentAnswer); ?></p>
                                </div>
                            </div>
                        <?php 
                            $index++;
                        endwhile; ?>
                    <?php endif; ?>
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