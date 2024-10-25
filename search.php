<?php get_header(); ?>

<section id="searchResults" class="my-24 font-plus">
    <div class="container mx-auto">
        <div class="searchResultsWrapper pt-5">
            <h1 class="text-3xl font-bold my-6 text-secondary pb-5 mx-5 lg:mx-0">Search Results for: "<?php echo get_search_query(); ?>"</h1>
        </div>
        <!-- Search Query -->
        <div class="grid lg:grid-cols-9 gap-10 mx-5 lg:mx-0">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="blogPostSearchWrapper col-span-3">
                        <a href="<?php echo the_permalink(); ?>">
                            <div class="blogPostSearchImage_wrapper overflow-hidden">
                                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                            </div>
                            <h4 class="blogPostSearchTitle"><?php the_title(); ?></h4>
                            <div class="blogPostSearchCredentials_wrapper flex justify-start my-3">
                                <div class="blogPostSearchCredentialsDate">
                                    <span><?php echo get_the_date('M j'); ?></span>
                                </div>
                                <div class="blogPostSearchCredentialsPublisher flex justify-center items-center">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 10C12.7614 10 15 7.76142 15 5C15 2.23858 12.7614 0 10 0C7.23858 0 5 2.23858 5 5C5 7.76142 7.23858 10 10 10Z" fill="#5CAB85"/>
                                        <path d="M10 11.6666C5.85977 11.6712 2.50461 15.0264 2.5 19.1666C2.5 19.6269 2.87309 19.9999 3.33332 19.9999H16.6666C17.1269 19.9999 17.5 19.6269 17.5 19.1666C17.4954 15.0264 14.1402 11.6712 10 11.6666Z" fill="#5CAB85"/>
                                    </svg>
                                    <span><?php echo get_the_author(); ?></span>
                                </div>
                            </div>
                            <div class="blogPostSearchExcerpt">
                                <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="searchNoResults_wrapper col-span-9">
                <?php else : ?>
                    <div class="lg:col-span-9">
                        <p class="text-secondary text-2xl text-normal">No results found. Please try again with different keywords.</p>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>