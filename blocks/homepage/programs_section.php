<?php 

/**
 * Flexible content template for Programs Section.
 */

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class');
$custom_id = get_sub_field('custom_html_id');

$default_class = 'homePrograms';
$default_id = 'homePrograms';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing');

// Fallback function to provide a default value
function get_spacing_value_programs($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_programs($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_programs($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_programs($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>
 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> bg-section-secondary font-plus relative">
    <div class="container mx-auto">
        <!-- Content -->
        <?php 
        $homeStepsEditor = get_sub_field('content_editor');
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


        <div class="homePrograms_content mx-5 md:mx-0" style="text-align: <?php echo $alignment_style; ?>;">
            <?php echo $homeStepsEditor; ?>
        </div>
        <!-- Relationship section for pages -->
        <div class="homeProgramsRelationship_wrapper">
            <?php $programIndex = 1; ?>
            <?php
                $featuredPages = get_sub_field('add_pages');
                if( $featuredPages ): ?>
                        <?php foreach( $featuredPages as $featuredPage ): 
                            setup_postdata( $featuredPage ); ?>

                            <div class="grid md:grid-cols-2 gap-10 lg:gap-32 my-7 md:my-16 lg:my-24 mx-5 md:mx-0">                 
                                <!-- Featured Image -->
                                <div class="homePrograms_featuredImage_wrapper homePrograms_featuredImage_wrapper-<?php echo $programIndex; ?> relative my-auto">
                                    <div class="programsImageContent_image relative z-10 w-full h-full">
                                        <?php 
                                            $thumbnail_id = get_post_thumbnail_id( $featuredPage->ID );
                                            $alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                                            echo wp_get_attachment_image( $thumbnail_id, 'programs-featured', false, [
                                                'class' => 'programs-featured-image',
                                                'alt'   => $alt_text ? $alt_text : 'Program for gym'
                                            ] ); 
                                        ?>
                                    </div>
                                    <!-- Background Colored Div -->
                                    <div class="imageContent_coloredBackground layout-<?php echo $programIndex; ?>"></div>
                                </div>
                                <!-- Content -->
                                <div class="homePrograms_content__wrapper my-auto">
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
                        <?php 
                        $programIndex++;
                        endforeach; ?>
                    <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>

    </div>
    <?php 
        $sectionDecoration = get_sub_field('show_section_decoration');

        if($sectionDecoration) { ?>
            <img class="programsDecoration" src="<?php echo get_template_directory_uri() . '/assets/svgs/programs_decoration.svg'; ?>" alt="Decorative SVG"/>
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