<?php 
/**
 * Flexible content template for Program Listings.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'pagesProgramListings';
$default_id = 'pagesProgramListings';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
$showShapeDecoration = get_sub_field('show_section_decoration');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_pagesProgramListings($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_pagesProgramListings($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_pagesProgramListings($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_pagesProgramListings($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> relative font-plus">
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
                <div class="pagesEditor pagesTeamCards_wrapper relative mb-24">
                    <!-- Content -->
                    <?php echo $editorContent; ?>
                </div>
            </div>
        </div>
        <!-- Programs Repeater -->
        <div class="programListings_wrapper mx-5 lg:mx-0">
        <?php $cardIndex = 1; ?>
            <?php
                $featuredPages = get_sub_field('add_programs');
                if( $featuredPages ): ?>
                        <?php foreach( $featuredPages as $featuredPage ): 
                            setup_postdata( $featuredPage ); ?>

                        <!-- Featured program card -->
                        <div class="grid md:grid-cols-7 gap-14 lg:gap-4 programListingsGrid-<?php echo $cardIndex; ?>">
                            <!-- Featured Image -->
                            <div class="programListings_featuredImage__wrapper md:col-span-1 md:my-auto ">
                                <!-- Image -->
                                <div class="programListing_image flex justify-center programListing_image-<?php echo $cardIndex; ?> relative mx-auto">
                                    <div class="programListinImage_wrapper programListinImage_wrapper-<?php echo $cardIndex; ?>">
                                        <?php 
                                            $thumbnail_id = get_post_thumbnail_id( $featuredPage->ID );
                                            $alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                                            echo wp_get_attachment_image( $thumbnail_id, 'programs-featured', false, [
                                                'class' => 'programs-featured-image',
                                                'alt'   => $alt_text ? $alt_text : 'Program for gym'
                                            ] ); 
                                        ?>
                                        <div class="programListing_image__deco programListing_image__deco-<?php echo $cardIndex; ?> w-full h-full absolute top-0"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Content -->
                            <div class="programListings_content__wrapper md:col-span-6">
                                <div class="programListings relative p-10 bg-white rounded-3xl my-10" style="text-align: <?php echo $alignment_style; ?>;">
                                    <div class="programListings_wrapper relative my-auto">
                                        <h3><?php echo get_the_title( $featuredPage->ID ); ?></h3>
                                        <div>
                                            <?php 
                                            $pageDescription = get_field('short_page_description', $featuredPage->ID);
                                            ?>
                                            <span><?php echo $pageDescription; ?></span>
                                        </div>
                                        <div class="programsButton_wrapper">
                                            <button class="button-secondary font-plus rounded-xl text-sm font-bold uppercase mt-5 lg:mt-10">
                                                <a class="px-6 py-3 block" href="<?php echo get_permalink( $featuredPage->ID ); ?>">More details</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php 
                        $cardIndex++;
                        endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; 
            ?>
        </div>
    </div>
    <?php if($showShapeDecoration) { ?>
        <svg class="programListingsDeco" width="325" height="627" viewBox="0 0 325 627" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g opacity="0.14" clip-path="url(#clip0_98_4454)">
            <path d="M11.1194 405.86C-7.21912 405.858 -25.1453 400.419 -40.3927 390.229C-55.6401 380.04 -67.524 365.559 -74.5419 348.616C-81.5598 331.674 -83.3964 313.031 -79.8197 295.044C-76.243 277.058 -67.4136 260.536 -54.4476 247.567C-41.4817 234.598 -24.9616 225.765 -6.97598 222.185C11.0096 218.604 29.6531 220.437 46.5972 227.451C63.5413 234.465 78.0253 246.346 88.2177 261.591C98.4102 276.836 103.854 294.761 103.859 313.1C103.844 337.691 94.0677 361.271 76.679 378.659C59.2903 396.048 35.7107 405.824 11.1194 405.84V405.86ZM11.1194 223C-11.3015 222.984 -32.9266 231.31 -49.5479 246.358C-66.1693 261.405 -76.5981 282.099 -78.8053 304.411C-81.0124 326.723 -74.8401 349.058 -61.4891 367.071C-48.1382 385.083 -28.5636 397.485 -6.57407 401.862C15.4154 406.24 38.2471 402.28 57.4784 390.754C76.7097 379.227 90.9651 360.958 97.471 339.502C103.977 318.046 102.268 294.936 92.6764 274.671C83.0849 254.405 66.2971 238.432 45.5794 229.86C34.6413 225.354 22.9294 223.024 11.0995 223H11.1194Z" fill="#586470"/>
            <path d="M11.1096 626.22C-40.3899 626.225 -91.0954 613.527 -136.514 589.25C-181.932 564.973 -220.661 529.867 -249.267 487.044C-277.874 444.22 -295.475 395.001 -300.512 343.749C-305.548 292.496 -297.864 240.793 -278.14 193.22C-262.401 155.232 -239.332 120.716 -210.251 91.6445C-181.17 62.5731 -146.646 39.5153 -108.653 23.7882C-70.6591 8.06107 -29.9395 -0.0273162 11.1806 -0.0150006C52.3006 -0.00268496 93.0154 8.1101 131 23.86C188.194 47.5706 237.076 87.704 271.467 139.188C305.859 190.672 324.216 251.196 324.22 313.11C324.212 396.149 291.221 475.786 232.503 534.503C173.785 593.221 94.149 626.212 11.1096 626.22ZM11.1096 2.63997C-39.957 2.63414 -90.2364 15.2256 -135.273 39.2985C-180.309 63.3714 -218.712 98.1822 -247.078 140.646C-275.443 183.11 -292.896 231.915 -297.889 282.737C-302.881 333.559 -295.26 384.828 -275.7 432C-260.092 469.668 -237.217 503.893 -208.38 532.719C-179.543 561.544 -145.309 584.407 -107.635 600C-69.9607 615.594 -29.5835 623.613 11.1903 623.599C51.9641 623.585 92.3359 615.539 130 599.92C167.668 584.317 201.895 561.447 230.724 532.616C259.554 503.785 282.422 469.557 298.022 431.887C313.623 394.217 321.65 353.844 321.647 313.071C321.643 272.299 313.607 231.927 298 194.26C274.486 137.532 234.68 89.0489 183.615 54.9414C132.55 20.8338 72.5179 2.63294 11.1096 2.63997Z" fill="#586470"/>
            <path d="M11.1993 442.58H10.9993C-23.3383 442.58 -56.2695 428.939 -80.5498 404.659C-104.83 380.379 -118.471 347.448 -118.471 313.11C-118.471 278.772 -104.83 245.841 -80.5498 221.561C-56.2695 197.281 -23.3383 183.64 10.9993 183.64H11.1693C45.5069 183.64 78.4381 197.281 102.718 221.561C126.999 245.841 140.639 278.772 140.639 313.11C140.639 347.448 126.999 380.379 102.718 404.659C78.4381 428.939 45.5069 442.58 11.1693 442.58H11.1993ZM11.1093 439.95H11.1893C44.8242 439.942 77.0787 426.575 100.859 402.789C124.64 379.003 137.999 346.745 137.999 313.11C137.999 279.477 124.641 247.221 100.863 223.435C77.0844 199.649 44.8324 186.281 11.1993 186.27H10.9993C-22.6474 186.27 -54.916 199.636 -78.7078 223.428C-102.5 247.22 -115.866 279.488 -115.866 313.135C-115.866 346.782 -102.5 379.05 -78.7078 402.842C-54.916 426.634 -22.6474 440 10.9993 440L11.1093 439.95Z" fill="#586470"/>
            <path d="M11.4801 479.31H10.74C-33.3389 479.31 -75.6125 461.8 -106.781 430.631C-137.95 399.462 -155.46 357.189 -155.46 313.11C-155.46 269.031 -137.95 226.757 -106.781 195.589C-75.6125 164.42 -33.3389 146.91 10.74 146.91H11.49C55.569 146.91 97.8426 164.42 129.011 195.589C160.18 226.757 177.69 269.031 177.69 313.11C177.69 357.189 160.18 399.462 129.011 430.631C97.8426 461.8 55.569 479.31 11.49 479.31H11.4801ZM11.11 476.67H11.4801C54.7965 476.575 96.3062 459.3 126.902 428.637C157.497 397.974 174.68 356.426 174.68 313.11C174.675 269.795 157.49 228.25 126.896 197.588C96.3015 166.926 54.7948 149.651 11.4801 149.55H10.75C-32.6288 149.55 -74.2309 166.782 -104.904 197.456C-135.578 228.129 -152.81 269.731 -152.81 313.11C-152.81 356.489 -135.578 398.091 -104.904 428.764C-74.2309 459.438 -32.6288 476.67 10.75 476.67H11.11Z" fill="#586470"/>
            <path d="M11.1196 516C-22.2491 516.002 -55.1034 507.774 -84.5329 492.046C-113.962 476.318 -139.059 453.574 -157.599 425.83C-176.139 398.086 -187.551 366.198 -190.824 332.99C-194.096 299.782 -189.128 266.279 -176.36 235.45C-163.59 204.614 -143.412 177.404 -117.613 156.23C-91.8136 135.057 -61.1902 120.573 -28.4559 114.063C4.27844 107.553 38.1132 109.217 70.0508 118.907C101.988 128.598 131.043 146.017 154.64 169.62C192.668 207.688 214.02 259.301 214 313.11C213.97 366.909 192.587 418.496 154.546 456.539C116.505 494.582 64.9187 515.968 11.1196 516ZM11.1196 112.78C-28.4977 112.783 -67.2246 124.533 -100.164 146.545C-133.104 168.556 -158.777 199.841 -173.938 236.443C-189.098 273.045 -193.065 313.32 -185.337 352.176C-177.609 391.033 -158.533 426.725 -130.52 454.74C-107.231 478.035 -78.5543 495.225 -47.0326 504.788C-15.511 514.35 17.8828 515.99 50.1897 509.562C82.4966 503.134 112.719 488.835 138.179 467.935C163.639 447.034 183.551 420.176 196.15 389.74C208.746 359.313 213.647 326.249 210.417 293.477C207.188 260.704 195.928 229.233 177.635 201.85C159.342 174.467 134.58 152.016 105.541 136.485C76.5014 120.954 44.0811 112.823 11.1496 112.81L11.1196 112.78Z" fill="#586470"/>
            <path d="M11.1196 552.77C-28.2938 552.772 -67.0993 543.053 -101.859 524.474C-136.619 505.895 -166.26 479.029 -188.156 446.258C-210.052 413.486 -223.527 375.82 -227.388 336.596C-231.249 297.372 -225.377 257.802 -210.29 221.39C-195.206 184.983 -171.375 152.857 -140.91 127.858C-110.446 102.86 -74.2862 85.7593 -35.6346 78.0718C3.01695 70.3842 42.9679 72.3466 80.6799 83.7853C118.392 95.224 152.701 115.786 180.57 143.65C225.505 188.6 250.755 249.552 250.77 313.11C250.759 376.667 225.507 437.618 180.567 482.56C135.626 527.502 74.6764 552.757 11.1196 552.77ZM11.1196 76.09C-27.8631 76.081 -66.246 85.688 -100.628 104.06C-135.01 122.431 -164.33 149 -185.988 181.412C-207.647 213.824 -220.977 251.079 -224.795 289.874C-228.614 328.669 -222.804 367.807 -207.88 403.82C-195.969 432.58 -178.509 458.711 -156.497 480.721C-134.485 502.732 -108.352 520.191 -79.592 532.1C-50.8316 544.01 -20.0069 550.137 11.1218 550.132C42.2505 550.127 73.0732 543.989 101.83 532.07C130.584 520.158 156.711 502.7 178.719 480.691C200.726 458.681 218.182 432.553 230.092 403.797C242.001 375.042 248.129 344.222 248.127 313.097C248.125 281.973 241.993 251.154 230.08 222.4C212.132 179.092 181.748 142.077 142.767 116.035C103.786 89.9923 57.9592 76.0917 11.0795 76.09H11.1196Z" fill="#586470"/>
            <path d="M11.1095 589.49C-34.3444 589.493 -79.0973 578.284 -119.184 556.858C-159.271 535.431 -193.454 504.447 -218.704 466.652C-243.954 428.856 -259.492 385.416 -263.941 340.181C-268.391 294.945 -261.613 249.31 -244.21 207.32C-230.322 173.788 -209.964 143.32 -184.299 117.656C-158.633 91.9932 -128.164 71.6374 -94.6303 57.7517C-61.0968 43.866 -25.1563 36.7224 11.1384 36.729C47.4332 36.7356 83.3711 43.8921 116.9 57.79C167.395 78.7086 210.554 114.131 240.918 159.577C271.283 205.023 287.49 258.453 287.49 313.11C287.479 386.407 258.357 456.699 206.528 508.528C154.699 560.357 84.4068 589.479 11.1095 589.49ZM11.1095 39.36C-33.9115 39.3565 -78.2382 50.458 -117.943 71.6808C-157.648 92.9037 -191.505 123.593 -216.514 161.028C-241.524 198.464 -256.913 241.49 -261.318 286.295C-265.724 331.1 -259.009 376.3 -241.77 417.89C-228.016 451.103 -207.852 481.28 -182.433 506.699C-157.013 532.118 -126.835 552.281 -93.6215 566.034C-60.4083 579.788 -24.8109 586.864 11.1374 586.858C47.0858 586.853 82.6809 579.765 115.89 566C149.103 552.244 179.281 532.08 204.7 506.659C230.119 481.239 250.281 451.06 264.035 417.845C277.789 384.631 284.865 349.033 284.859 313.084C284.852 277.135 277.765 241.539 264 208.33C243.279 158.313 208.194 115.563 163.182 85.482C118.169 55.4011 65.2483 39.3404 11.1095 39.33V39.36Z" fill="#586470"/>
            </g>
            <defs>
            <clipPath id="clip0_98_4454">
            <rect width="626.22" height="626.22" fill="white" transform="translate(-302)"/>
            </clipPath>
            </defs>
        </svg>
    <?php } ?>
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