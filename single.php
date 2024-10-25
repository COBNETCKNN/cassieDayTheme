<?php get_header() ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section id="blogSingle" class="bg-white py-24 font-plus relative">
    <div class="container mx-auto">
        <!-- Single post hero -->
        <div class="singlePostHero my-24 w-full relative">
            <!-- Content -->
             <div class="singlePostHeroContent_wrapper w-[65%] relative z-10 ">
                <div class="singleContentBeforeCoverage w-full h-full relative z-10  px-14 py-24">
                    <h1><?php echo the_title(); ?></h1>
                    <div class="singlePostHeroCredentials_wrapper flex mt-10">
                        <div class="blogPostSingleCredentialsDate w-fit my-auto">
                            <span class="block text-center"><?php echo get_the_date('M'); ?></span>
                            <span class="block text-center"><?php echo get_the_date('j'); ?></span>
                        </div>
                        <div class="blogPostSingleCredentialsPublisher w-fit ml-5 my-auto">
                            <span class="block uppercase text-center">Author:</span>
                            <span class="block text-center"><?php echo get_the_author(); ?></span>
                        </div>
                    </div>
                </div>
                <div class="coverageDiv w-full h-full bg-white absolute top-0 right-0"></div>
             </div>
            <!-- Featured Image -->
             <div class="singlePostHeroFeaturedImage_wrapper w-fit">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('single-blog-featured'); ?>
                <?php endif; ?>
             </div>
        </div>
        <!-- Content -->
         <div class="singlePostContent_wrapper">
            <?php echo the_content(); ?>
         </div>
        <!-- Search Form -->
         <div class="">
            <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $search_query = get_search_query(); // Get the search term

            $blogQueryArgs = array(
                'post_type'      => 'post',
                'posts_per_page' => 8,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'paged'          => $paged, // Add pagination
                's'              => $search_query, // Add search query parameter
            );

            $blogQuery = new WP_Query($blogQueryArgs); 
            $postCounter = 1; // Initialize a counter variable
            ?>
            <?php if ($blogQuery->have_posts()) : ?>
            <!-- Search Form -->
            <div class="search-wrapper my-6 font-plus pt-14">
            <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                <div class="md:flex items-center text-center">
                    <div class="mb-3 md:mb-0">
                        <span class="screen-reader-text"><?php echo _x('Search our blog', 'label') ?></span>
                    </div>
                    <label class="searchFormWrapper flex w-fit h-fit">
                        <input type="search" class="search-field" placeholder="Enter a keyword" value="<?php echo get_search_query(); ?>" name="s" title="<?php _ex('Search for:', 'label') ?>" />
                        
                        <!-- Custom SVG button inside the label -->
                        <button type="submit" class="search-submit px-5 bg-white">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_131_3260)">
                                    <path d="M24.062 21.4452L19.4168 16.7981C22.8926 12.1533 21.9448 5.57034 17.3001 2.09462C12.6553 -1.3811 6.07229 -0.433388 2.59657 4.21139C-0.87915 8.85616 0.0685652 15.4392 4.71334 18.9149C8.44441 21.7069 13.5689 21.7069 17.3001 18.9149L21.9472 23.562C22.5312 24.146 23.478 24.146 24.0619 23.562C24.6459 22.978 24.6459 22.0312 24.0619 21.4472L24.062 21.4452ZM11.0454 18.0179C6.91737 18.0179 3.57096 14.6715 3.57096 10.5435C3.57096 6.41542 6.91737 3.06901 11.0454 3.06901C15.1735 3.06901 18.5199 6.41542 18.5199 10.5435C18.5155 14.6697 15.1717 18.0136 11.0454 18.0179Z" fill="#658692"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_131_3260">
                                        <rect width="24" height="24" fill="white" transform="translate(0.5)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </label>
                </div>
            </form>
            </div>
            <?php wp_reset_postdata(); ?>
            <?php endif; ?>
         </div>
    </div>
</section>

<?php endwhile; endif; ?>

<!-- Banner Section -->
<?php 
if( have_rows('post_banner', 'option') ):
while( have_rows('post_banner', 'option') ): the_row(); 

// Retrieve custom class and ID from the ACF fields
$custom_class = get_sub_field('custom_html_class', 'option');
$custom_id = get_sub_field('custom_html_id', 'option');

$default_class = 'blogBanner';
$default_id = 'blogBanner';

$section_class = $default_class . (!empty($custom_class) ? ' ' . esc_attr($custom_class) : '');
$section_id = $default_id . (!empty($custom_id) ? ' ' . esc_attr($custom_id) : '');

$showSection = get_sub_field('show_section', 'option');

// Get the spacing array from ACF Dimensions plugin
$spacing = get_sub_field('spacing', 'option');

// Fallback function to provide a default value
function get_spacing_value_banner($spacing, $key, $default = '0px 0px 0px 0px') {
    return isset($spacing[$key]) && !empty($spacing[$key]) ? $spacing[$key] : $default;
}

$desktopSpacing = get_spacing_value_banner($spacing, 'desktop', '100px 0px 100px 0px');
$tabletSpacing = get_spacing_value_banner($spacing, 'tablet', '50px 0px 50px 0px');
$mobileSpacing = get_spacing_value_banner($spacing, 'mobile', '30px 0px 30px 0px');

if ($showSection) { ?>

 <section id="<?php echo $section_id; ?>" class="<?php echo $section_class; ?> bg-section-primary font-plus text-secondary">
    <div class="container mx-auto relative">
        <div class="bannerWrapperrounded-2xl mx-3 md:mx-0">
            <div class="banner_content bannerPost_content relative py-20 px-5 " style="text-align: <?php echo $alignment_style; ?>;">
                <?php              
                    $reviewsEditor = get_sub_field('content_editor', 'option');
                    $alignment = get_sub_field('align_content', 'option');

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
                <div class="homeCtaBanner_content__wrapper" style="text-align: <?php echo $alignment_style; ?>;">
                    <!-- Content -->
                    <?php echo $reviewsEditor; ?>
                    <!-- Button -->
                    <div class="bannerButton_wrapper">
                        <?php get_template_part('partials/form', 'links-button'); ?>
                    </div>
                </div>
                <!-- Banner Decoration -->
                <?php 
                $sectionDecoration = get_sub_field('show_section_decoration', 'option');

                if($sectionDecoration) { ?>
                    <img class="bannerDecorationBlog" src="<?php echo get_template_directory_uri() . '/assets/svgs/banner_decoration.svg'; ?>" alt="Decorative SVG"/>
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

<?php endwhile; ?>
<?php endif; ?>
<?php get_footer() ?>