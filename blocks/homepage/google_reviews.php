<?php 
/**
 * Flexible content template for Team Cards.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homeGoogleReviews';
$default_id = 'homeGoogleReviews';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');
$maxWidthHomeGoogleReview = get_sub_field('width_of_section');

// Fallback function to provide a default value
function get_spacing_value_homeGoogleReviews($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_homeGoogleReviews($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_homeGoogleReviews($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_homeGoogleReviews($spacing, 'mobile', '30px 0px 30px 0px');

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
            <!-- Google Reviews embedded code -->
             <div class="googleReviewsEmbeddedCode_wrapper">
                <?php 
                    $embeddedCode = get_sub_field('embed_code');
                    echo $embeddedCode;
                ?>
             </div>
        </div>
    </div>
</section>

<?php } ?>

<style>
    /* Default styles */
    #<?php echo $section_id; ?> {
        padding: <?php echo $desktopSpacing; ?>;
    }

    /* Tablet styles */
    @media (max-width: 1024px) {
        #<?php echo $section_id; ?> {
            padding: <?php echo $tabletSpacing; ?>;
        }
    }

    /* Mobile styles */
    @media (max-width: 768px) {
        #<?php echo $section_id; ?> {
            padding: <?php echo $mobileSpacing; ?>;
        }
    }

    /* Large screen styles */
    @media (min-width: 1024px) {
        #<?php echo $section_id; ?> .container {
            max-width: <?php echo $maxWidthHomeGoogleReview . 'px'; ?>;
        }
    }
</style>