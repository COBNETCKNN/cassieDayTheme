<?php 

/**
 * Flexible content template for CTA Banner.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'pagesBanner';
$default_id = 'pagesBanner';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');
global $post;

// Fallback function to provide a default value
function get_spacing_value_pagesBanner($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_pagesBanner($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_pagesBanner($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_pagesBanner($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> pt-32 bg-section-primary font-plus text-secondary <?php echo $post->post_name; ?>Banner">
    <div class="container mx-auto">
        <div class="bannerWrapper rounded-2xl relative">
            <div class="banner_content relative py-20 px-5 z-10" style="text-align: <?php echo $alignment_style; ?>;">
                <?php              
                    $reviewsEditor = get_sub_field('content_editor');
                    $alignment = get_sub_field('align_content');

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
                <div class="ctaBannerPage_content__wrapper" style="text-align: <?php echo $alignment_style; ?>;">
                    <?php echo $reviewsEditor; ?>
                    <!-- Button -->
                    <div class="bannerButton_wrapper mt-5">
                        <?php get_template_part('partials/form', 'links-button'); ?>
                    </div>
                </div>
                <!-- Banner Decoration -->
                <?php 
                $sectionDecoration = get_sub_field('show_section_decoration');

                if($sectionDecoration) { ?>
                    <img class="bannerDecoration" src="<?php echo get_template_directory_uri() . '/assets/svgs/banner_decoration.svg'; ?>" alt="Decorative SVG"/>
                <?php } ?>
            </div>
            <div class="bannerHideLine w-full h-full absolute top-0 left-0 bg-white"></div>
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