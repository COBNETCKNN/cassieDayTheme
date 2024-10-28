<?php 
/**
 * Flexible content template for Two Column Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'embedCodePagesSection';
$default_id = 'embedCodePagesSection';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_embedCode($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_embedCode($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_embedCode($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_embedCode($spacing, 'mobile', '30px 0px 30px 0px');

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
        <div class="embedCodePages my-auto relative col-span-3" style="text-align: <?php echo $alignment_style; ?>;">
            <div class="pagesEditor embedCodePages_wrapper relative">
                <!-- Content -->
                <?php echo $editorContent; ?>
                <!-- Button -->
                <?php get_template_part('partials/form', 'links-button'); ?>
            </div>
        </div>
        <!-- Embeded Code -->
         <div class="embededCodeWrapper mt-16 mx-5 lg:mx-0">
            <?php
                $embededCode = get_sub_field('embed_code');
                echo $embededCode; 
            ?>            
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