<?php 

/**
 * Flexible content template for Get Strong section. 
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homeStrong';
$default_id = 'homeStrong';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');
if ($showSection) { ?>

<section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> py-36 bg-white font-plus">
    <div class="container mx-auto">
        <div class="grid grid-cols-2 gap-14">
        <?php if( have_rows('get_started_content') ): ?>
            <?php while( have_rows('get_started_content') ): the_row(); 
            
                $featuredImage = get_sub_field('get_strong_featured_image');
                $featuredImageSize = 'strong-featured';
                $editorContent = get_sub_field('get_strong_editor');
                $alignment = get_sub_field('get_strong_align_content');
                ?>

                <?php 
                    //Text Alignment 
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
                <!-- Featured Image -->
                <div class="relative my-auto">
                    <div class="getStrong_decobox">
                    </div>
                    <div class="getStrong_image__wrapper">
                        <?php 
                        if( $featuredImage ) {
                            echo wp_get_attachment_image( $featuredImage, $featuredImageSize );
                        }
                        ?>
                    </div>
                </div>
                <!-- Content -->
                <div class="my-auto" style="text-align: <?php echo $alignment_style; ?>;">
                    <?php echo $editorContent; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <!-- Button -->
                <?php get_template_part('partials/form', 'links-button'); ?>
                </div>
        </div>
    </div>
</section>

<?php } ?>