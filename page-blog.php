<?php get_header(); ?>

<?php
  if( have_rows('site_builder_pages') ):
      while ( have_rows('site_builder_pages') ) : the_row();
            include 'blocks/pages/' . get_row_layout() . '.php';
      endwhile;
  endif; 
?>

<!-- Popup Modal Structure -->
<div id="form-popup" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white py-7 lg:py-10 px-5 lg:px-10 rounded-xl max-w-[22.5rem] lg:max-w-[35.625rem]">
        <div class="relative w-fit h-fit">
            <button id="close-popup" class="absolute -top-4 lg:-top-5 -right-3 lg:-right-5">
            <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.5 0C8.5745 0 0.5 8.0745 0.5 18C0.5 27.9255 8.5745 36 18.5 36C28.4255 36 36.5 27.9255 36.5 18C36.5 8.0745 28.4255 0 18.5 0ZM24.0605 21.4395C24.647 22.026 24.647 22.974 24.0605 23.5605C23.768 23.853 23.384 24 23 24C22.616 24 22.232 23.853 21.9395 23.5605L18.5 20.121L15.0605 23.5605C14.768 23.853 14.384 24 14 24C13.616 24 13.232 23.853 12.9395 23.5605C12.353 22.974 12.353 22.026 12.9395 21.4395L16.379 18L12.9395 14.5605C12.353 13.974 12.353 13.026 12.9395 12.4395C13.526 11.853 14.474 11.853 15.0605 12.4395L18.5 15.879L21.9395 12.4395C22.526 11.853 23.474 11.853 24.0605 12.4395C24.647 13.026 24.647 13.974 24.0605 14.5605L20.621 18L24.0605 21.4395Z" fill="#D5DFE2"/>
            </svg>
            </button>
            <div id="form-content">
                <!-- AJAX-loaded form content with iframe will be inserted here -->
            </div>
        </div>
    </div>
</div>

<!-- Blog post query -->
 <section id="blogPosts" class="mt-24 font-plus relative">
    <div class="container mx-auto">
        <div class="blogArchiveGrid grid lg:grid-cols-12 gap-10 mx-5 lg:mx-0">
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
                <?php while ($blogQuery->have_posts()) : $blogQuery->the_post(); ?>
                    <div class="blogPostWrapper blog-post-<?php echo $postCounter; ?>">
                        <a href="<?php echo the_permalink(); ?>">
                            <!-- Image -->
                            <div class="blogPostImage_wrapper overflow-hidden">
                                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                            </div>
                            <!-- Title -->
                            <h4 class="blogPostTitle blogPostTitle-<?php echo $postCounter; ?>"><?php the_title(); ?></h4>
                            <!-- Credentials -->
                            <div class="blogPostCredentials_wrapper flex justify-start my-3">
                                <div class="blogPostCredentialsDate">
                                    <span><?php echo get_the_date('M j'); ?></span>
                                </div>
                                <div class="blogPostCredentialsPublisher flex justify-center items-center">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 10C12.7614 10 15 7.76142 15 5C15 2.23858 12.7614 0 10 0C7.23858 0 5 2.23858 5 5C5 7.76142 7.23858 10 10 10Z" fill="#5CAB85"/>
                                        <path d="M10 11.6666C5.85977 11.6712 2.50461 15.0264 2.5 19.1666C2.5 19.6269 2.87309 19.9999 3.33332 19.9999H16.6666C17.1269 19.9999 17.5 19.6269 17.5 19.1666C17.4954 15.0264 14.1402 11.6712 10 11.6666Z" fill="#5CAB85"/>
                                    </svg>
                                    <span><?php echo get_the_author(); ?></span>
                                </div>
                            </div>
                            <!-- Post Excerpt -->
                            <div class="blogPostExcerpt">
                                <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                            </div>
                        </a>
                    </div>
                    <?php $postCounter++; ?>
                <?php endwhile; ?>
        </div>
        <!-- Pagination -->
        <div class="w-full">
            <div class="pagination pt-14 w-full h-full flex justify-center items-center">
                <?php 
                    $pagination_links = paginate_links(array(
                        'total'   => $blogQuery->max_num_pages,
                        'current' => max(1, get_query_var('paged')),
                        'format'  => '?paged=%#%',
                        'type'    => 'array', // Get links as an array for customization
                    ));

                    if ($pagination_links) {
                        echo '<ul class="pagination-list">';
                
                        foreach ($pagination_links as $index => $link) {
                            $li_class = 'page-item'; // Default class for page numbers
                
                            // Detect previous and next links using more accurate checks
                            if (strpos($link, 'prev') !== false) {
                                $li_class = 'prev-item';
                            } elseif (strpos($link, 'next') !== false) {
                                $li_class = 'next-item';
                            } elseif (strpos($link, 'current') !== false) {
                                $li_class = 'current-list';
                            }
                
                            // Output the <li> with the assigned class
                            echo '<li class="' . $li_class . '">' . $link . '</li>';
                        }
                
                        echo '</ul>';
                    }
                ?>
            </div>
        </div>
        <?php else : ?>
            <p>No post was found.</p>
        <?php endif; ?>

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
    </div>
 </section>

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



<?php get_footer(); ?>