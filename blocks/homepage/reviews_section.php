<?php 

/**
 * Flexible content template for Reviews Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('reviews_settings_custom_html_class');
$custom_id = get_sub_field('reviews_settings_custom_html_id');

// Set default values if the fields are empty (optional)
$default_class = 'homeReviews';
$default_id = 'homeReviews';

// Check if custom class or ID is provided, otherwise use defaults
$section_class = !empty($custom_class) ? esc_attr($custom_class) : $default_class;
$section_id = !empty($custom_id) ? esc_attr($custom_id) : $default_id;

$showSection = get_sub_field('reviews_settings_show_section');
if($showSection) { 

 ?>

 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> bg-white font-plus">
    <div class="container mx-auto">
        <!-- Content -->
        <?php if( have_rows('reviews_content_group') ): ?>
            <?php while( have_rows('reviews_content_group') ): the_row(); 
            
                $reviewsEditor = get_sub_field('reviews_content_editor');
                $alignment = get_sub_field('reviews_align_content');

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

                <div class="homePrograms_content" style="text-align: <?php echo $alignment_style; ?>;">
                    <?php echo $reviewsEditor; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        <!-- Reviews Repeater -->
         <div class="reviewsRepeater_wrapper my-14">
            <div class="owl-carousel owl-theme">
                <?php if( have_rows('reviews_repeater') ): ?>
                    <?php while( have_rows('reviews_repeater') ): the_row(); ?>
                    <div class="item grid grid-cols-10 gap-4 my-10">
                        <div class="col-span-1"></div>
                        <!-- Content -->
                        <div class="col-span-7 bg-white p-20 rounded-2xl shadow-xl">
                            <div class="grid grid-cols-10">
                                <div class="col-span-8">
                                    <?php if( have_rows('reviews_content') ): ?>
                                        <?php while( have_rows('reviews_content') ): the_row(); 
                                        
                                        $reviewerReview = get_sub_field('reviewer_review');
                                        $reviewerName = get_sub_field('reviewer_name');
                                        ?>

                                        <p><?php echo $reviewerReview; ?></p>
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
                                            <h5 class="reviewerName ml-5"><?php echo $reviewerName; ?></h5>  
                                        </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="reviewImage_wrapper col-span-2 my-auto">
                            <?php 
                                $reviewerImage = get_sub_field('reviewer_image');
                                $reviewerImageSize = 'reviewer-image';
                                
                                if( $reviewerImage ) {
                                    echo wp_get_attachment_image( $reviewerImage, $reviewerImageSize );
                                }
                            ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
 </section>

 <?php } ?>