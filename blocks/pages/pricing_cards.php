<?php 
/**
 * Flexible content template for Team Cards.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'pagesPricingCards';
$default_id = 'pagesPricingCards';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_pricing_cards($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_pricing_cards($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_pricing_cards($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_pricing_cards($spacing, 'mobile', '30px 0px 30px 0px');

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
            <div class="pagesPricingCards my-auto relative lg:col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
                <div class="pagesEditor pagesPricingCards_wrapper relative mb-14 lg:mb-24">
                    <!-- Content -->
                    <?php echo $editorContent; ?>
                </div>
            </div>
        </div>
        <!-- Packages Repeater -->
         <div class="pagsPricingCards_packages__wrapper">
            <div class="mx-5 lg:mx-0">
                <div class="grid lg:grid-cols-3 gap-10">
                    <?php if( have_rows('package_cards') ): ?>
                        <?php $packageCardIndex = 1; ?>
                        <?php while( have_rows('package_cards') ): the_row(); 
                        
                        $packageName = get_sub_field('package_name');
                        $classNumbers = get_sub_field('number_of_classes');
                        $packagePrice = get_sub_field('price');
                        $priceSuffix = get_sub_field('price_suffix');
                        $description = get_sub_field('description');
                        $highlight = get_sub_field('highlight');
                        ?>
                            <!-- Package card -->
                            <div class="packageCard_wrapper relative <?php echo $highlight ? 'highlighted' : ''; ?>">
                                <!-- Content -->
                                <div class="packageCardContent_wrapper relative z-10">
                                    <!-- Top Section -->
                                    <div class="packageCard_topSection relative">
                                        <div class="packageCardBackground w-full h-full"></div>
                                        <div class="packageCardTopSectionContent_wrapper packageCardTopSectionContent_wrapper-<?php echo $packageCardIndex; ?> relative p-7">
                                            <h4 class="packageName text-center mb-5"><?php echo $packageName; ?></h4>
                                            <div class="classesWrapper flex justify-center">
                                                <div class="classesNumber w-fit h-fit text-center">
                                                    <?php echo $classNumbers; ?>
                                                    <span class="block classSpan">Classes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Bottom section -->
                                    <div class="packageCard_bottomSection bg-white p-7">
                                        <!-- Price -->
                                        <div class="priceWrapper flex justify-center items-end mb-7 mt-3">
                                            <span class="packagePrice packagePrice-<?php echo $packageCardIndex; ?>"><?php echo $packagePrice; ?></span>
                                            <span class="priceSuffix">/<?php echo $priceSuffix; ?></span>
                                        </div>
                                        <!-- Package Features -->
                                        <div class="">
                                            <ul class="packageFeatures packageFeatures-<?php echo $packageCardIndex; ?>">
                                                <?php if( have_rows('features_repeater') ): ?>
                                                    <?php while( have_rows('features_repeater') ): the_row(); 
                                                    $packageFeature = get_sub_field('feature');
                                                    ?>
                                                    <li class="packageFeatures_item flex justify-start items-start mb-1">
                                                        <svg class="packageFeatureIcon" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.9434 0.5C6.32636 0.5 0.943359 5.883 0.943359 12.5C0.943359 19.117 6.32636 24.5 12.9434 24.5C19.5604 24.5 24.9434 19.117 24.9434 12.5C24.9434 5.883 19.5604 0.5 12.9434 0.5ZM19.1434 11.012L14.7174 15.357C13.9344 16.125 12.9264 16.508 11.9174 16.508C10.9194 16.508 9.92136 16.132 9.14136 15.379L7.24236 13.512C6.84836 13.125 6.84336 12.492 7.23036 12.098C7.61636 11.703 8.25136 11.698 8.64436 12.086L10.5374 13.947C11.3134 14.697 12.5384 14.693 13.3184 13.929L17.7434 9.585C18.1364 9.197 18.7674 9.204 19.1574 9.598C19.5444 9.992 19.5384 10.625 19.1434 11.012Z" fill="#5CAB85"/>
                                                        </svg>
                                                        <?php echo $packageFeature; ?>
                                                    </li>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <!-- Description Wrapper -->
                                        <div class="packageCardDescriptionWrapper text-center mt-5">
                                            <?php echo $description; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="packageCardsBorderDiv packageCardsBorderDiv-<?php echo $packageCardIndex; ?> w-full h-full absolute top-0 left-0"></div>
                            </div>
                        <?php 
                        $packageCardIndex++;
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