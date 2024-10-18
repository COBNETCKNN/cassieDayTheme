<?php 
/**
 * Flexible content template for Homepage Hero Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'schedulePages';
$default_id = 'schedulePages';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
$showSprayDecoration = get_sub_field('show_section_spray_color_decoration');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_schedule($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_schedule($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_schedule($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_schedule($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> font-plus relative">
    <div class="container mx-auto w-full h-full">
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
        <div class="schdulePages my-auto relative mb-5 lg:mb-0" style="text-align: <?php echo $alignment_style; ?>;">
            <div class="pagesEditor schdulePages_wrapper relative mx-5 lg:mx-0">
                <!-- Content -->
                <?php echo $editorContent; ?>
                <!-- Button -->
                <?php get_template_part('partials/form', 'links-button'); ?>
            </div>
        </div>
        <!-- Table -->
         <div class="scheduleTable flex justify-center items-center relative">
            <?php 
            $scheduleSelect = get_sub_field('embed_code_or_table');

            // Check if the value is 'addtable'
            if ($scheduleSelect === 'addtable') { 
                ?>
                <div class="tableWrapper my-14 bg-white w-full rounded-3xl overflow-x-auto">
                    <table class="scheduleTable w-full border-collapse border-spacing-0">
                        <thead>
                            <tr class="daysTable_wrapepr text-xl font-plus font-bold">
                                <th class="px-5 py-5 text-center">Time</th>
                                <th class="px-5 py-5 text-center">Monday</th>
                                <th class="px-5 py-5 text-center">Tuesday</th>
                                <th class="px-5 py-5 text-center">Wednesday</th>
                                <th class="px-5 py-5 text-center">Thursday</th>
                                <th class="px-5 py-5 text-center">Friday</th>
                                <th class="px-5 py-5 text-center">Saturday</th>
                                <th class="px-5 py-5 text-center">Sunday</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (have_rows('schedule_table')): ?>
                                <?php while (have_rows('schedule_table')): the_row(); 
                                    $tableTime = get_sub_field('time');
                                    $tableMonday = get_sub_field('table_monday');
                                    $tableTuesday = get_sub_field('table_tuesday');
                                    $tableWednesday = get_sub_field('table_wednesday');
                                    $tableThursday = get_sub_field('table_thursday');
                                    $tableFriday = get_sub_field('table_friday');
                                    $tableSaturday = get_sub_field('table_saturday');
                                    $tableSunday = get_sub_field('table_sunday');
                                ?>
                                <tr class="text-primary-light text-xl font-plus font-medium">
                                    <td class="px-5 py-5 text-center"><?php echo $tableTime; ?></td>
                                    <td class="px-5 py-5 text-center"><?php echo $tableMonday; ?></td>
                                    <td class="px-5 py-5 text-center"><?php echo $tableTuesday; ?></td>
                                    <td class="px-5 py-5 text-center"><?php echo $tableWednesday; ?></td>
                                    <td class="px-5 py-5 text-center"><?php echo $tableThursday; ?></td>
                                    <td class="px-5 py-5 text-center"><?php echo $tableFriday; ?></td>
                                    <td class="px-5 py-5 text-center"><?php echo $tableSaturday; ?></td>
                                    <td class="px-5 py-5 text-center"><?php echo $tableSunday; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
            // Check if the value is 'addcode'
            elseif ($scheduleSelect === 'addcode') {

                $tableCode = get_sub_field('past_code_here');
                ?>
                <div class="custom-code my-14">
                    <?php echo $tableCode; ?>
                </div>
                <?php
            }
            // Check if the value is 'image'
            elseif ($scheduleSelect === 'image') { 
                
                $tableFeaturedImage = get_sub_field('table_image');

                // Image variables.
                $url = $tableFeaturedImage['url'];
                $alt = $tableFeaturedImage['alt'];
                $size = 'large';
                $thumb = $tableFeaturedImage['sizes'][ $size ];
                ?>

                <div class="tableImageWrapper flex justify-center items-center my-14">
                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
                </div>

            <?php
            }
            // Check if the value is 'dont'
            elseif ($scheduleSelect === 'dont') {
            }
            ?>
         </div>
    </div>
    <!-- Section Decorations -->
    <?php if ($showSprayDecoration) {?>
        <svg class="schedulePagesPurpleDeco" width="612" height="785" viewBox="0 0 612 785" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_f_88_3302)">
            <ellipse cx="129" cy="306" rx="143" ry="139" fill="#CCCAE8"/>
            </g>
            <defs>
            <filter id="filter0_f_88_3302" x="-354" y="-173" width="966" height="958" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
            <feGaussianBlur stdDeviation="170" result="effect1_foregroundBlur_88_3302"/>
            </filter>
            </defs>
        </svg>
        <svg class="schedulePagesGreenDeco" width="280" height="505" viewBox="0 0 280 505" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g opacity="0.3" filter="url(#filter0_f_78_2311)">
            <ellipse cx="11.5" cy="239" rx="111.5" ry="109" fill="#A2D3BA"/>
            </g>
            <defs>
            <filter id="filter0_f_78_2311" x="-257" y="-27" width="537" height="532" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
            <feGaussianBlur stdDeviation="78.5" result="effect1_foregroundBlur_78_2311"/>
            </filter>
            </defs>
        </svg>
    <?php 
    } 
    ?>
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