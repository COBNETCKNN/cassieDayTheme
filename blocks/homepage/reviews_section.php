<?php 

/**
 * Flexible content template for Reviews Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homeReviews';
$default_id = 'homeReviews';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
$showSprayDecoration = get_sub_field('show_section_spray_color_decoration');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_reviews($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_reviews($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_reviews($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_reviews($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> bg-section-primary font-plus relative">
    <div class="mx-auto">
        <!-- Content -->
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

        <div class="homeReviews_content md:mx-0" style="text-align: <?php echo $alignment_style; ?>;">
            <?php echo $reviewsEditor; ?>
        </div>
        <!-- Reviews Repeater -->
         <div class="reviewsRepeater_wrapper flex justify-center">
            <div class="owl-carousel">
                <?php if( have_rows('reviews_repeater') ): ?>
                    <?php while( have_rows('reviews_repeater') ): the_row(); ?>
                    <div class="flex justify-center mt-14 md:mt-5">
                        <div class="item grid grid-cols-10 gap-4 my-20 max-w-[1200px] relative">
                            <div class="col-span-1 hidden md:block order-1"></div>
                            <!-- Content -->
                            <div class="reviewsContent_wrapper col-span-10 md:col-span-7 bg-white p-10 lg:p-20 rounded-2xl order-last md:order-2 mx-5 md:mx-0">
                                <div class="grid grid-cols-10">
                                    <div class="col-span-10 md:col-span-8">
                                        <?php if( have_rows('reviews_content') ): ?>
                                            <?php while( have_rows('reviews_content') ): the_row(); 
                                            
                                            $reviewerReview = get_sub_field('reviewer_review');
                                            $reviewerName = get_sub_field('reviewer_name');
                                            ?>

                                            <p class="reviewParagraph"><?php echo $reviewerReview; ?></p>
                                            <div class="reviewerName_wrapper flex justify-start items-center mt-5">
                                                <svg class="quoteSVG" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_78_2469)">
                                                    <path d="M21.3927 0.0458444C15.606 -0.337489 9.9327 1.77584 5.8477 5.86751C1.76103 9.96084 -0.352298 15.6292 0.0493681 21.4225C0.782701 32.0125 10.136 39.9992 21.8044 39.9992H31.666C36.261 39.9992 39.9994 36.2608 39.9994 31.6658V20.5658C39.9994 9.76751 31.8277 0.755844 21.3927 0.0458444ZM18.3327 21.6658C18.3327 25.3425 15.3427 28.3325 11.666 28.3325C10.746 28.3325 9.99936 27.5875 9.99936 26.6658C9.99936 25.7442 10.746 24.9992 11.666 24.9992C13.5044 24.9992 14.9994 23.5042 14.9994 21.6658H12.4994C11.1194 21.6658 9.99936 20.5458 9.99936 19.1658V16.6658C9.99936 14.8242 11.491 13.3325 13.3327 13.3325H15.8327C17.2127 13.3325 18.3327 14.4525 18.3327 15.8325V21.6658ZM29.9994 21.6658C29.9994 25.3425 27.0094 28.3325 23.3327 28.3325C22.411 28.3325 21.666 27.5875 21.666 26.6658C21.666 25.7442 22.411 24.9992 23.3327 24.9992C25.171 24.9992 26.666 23.5042 26.666 21.6658H24.166C22.786 21.6658 21.666 20.5458 21.666 19.1658V16.6658C21.666 14.8242 23.1577 13.3325 24.9994 13.3325H27.4994C28.8794 13.3325 29.9994 14.4525 29.9994 15.8325V21.6658Z"/>
                                                    </g>
                                                    <defs>
                                                    <clipPath id="clip0_78_2469">
                                                    <rect width="40" height="40" fill="white"/>
                                                    </clipPath>
                                                    </defs>
                                                </svg>
                                                <div class="reviewerName ml-5"><?php echo $reviewerName; ?></div>  
                                            </div>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if($showSprayDecoration) { ?>
                                    <!-- Carousel Left Deco -->
                                    <svg class="reviewsCarouselGreenDeco" width="463" height="497" viewBox="0 0 463 497" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.72" filter="url(#filter0_f_78_2451)">
                                        <ellipse cx="214" cy="248.5" rx="125" ry="124.5" fill="#E4F4EC"/>
                                        </g>
                                        <defs>
                                        <filter id="filter0_f_78_2451" x="-35" y="0" width="498" height="497" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                                        <feGaussianBlur stdDeviation="62" result="effect1_foregroundBlur_78_2451"/>
                                        </filter>
                                        </defs>
                                    </svg>
                                    <!-- Carousel Right Deco -->
                                    <svg class="reviewsCarouselPurpleDeco" width="652" height="636" viewBox="0 0 652 636" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g filter="url(#filter0_f_78_2452)">
                                        <ellipse cx="326" cy="318" rx="204" ry="196" fill="#F4F2FF"/>
                                        </g>
                                        <defs>
                                        <filter id="filter0_f_78_2452" x="0" y="0" width="652" height="636" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                                        <feGaussianBlur stdDeviation="61" result="effect1_foregroundBlur_78_2452"/>
                                        </filter>
                                        </defs>
                                    </svg>
                                <?php } ?>
                            </div>
                            <!-- Image -->
                            <div class="reviewImage_wrapper col-span-2 my-auto order-first md:order-last">
                                <?php 
                                    $reviewerImage = get_sub_field('reviewer_image');
                                    $reviewerImageSize = 'reviewer-image';
                                    
                                    if( $reviewerImage ) {
                                        echo wp_get_attachment_image( $reviewerImage, $reviewerImageSize );
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php endwhile; ?>
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